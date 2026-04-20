<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * HALAMAN EDIT PROFILE
     */
    public function edit()
    {
        $user = Auth::user();

        return view('profile.edit', compact('user'));
    }

    /**
     * UPDATE DATA PROFILE
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone' => [
                'nullable',
                'string',
                'max:15',
                Rule::unique('users')->ignore($user->id),
            ],
        ], [
            'name.required'  => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'email.unique'   => 'Email sudah terdaftar.',
            'phone.unique'   => 'Nomor telepon sudah terdaftar.',
        ]);

        // Simpan data lama untuk cek perubahan
        $oldName  = $user->name;
        $oldEmail = $user->email;
        $oldPhone = $user->phone;

        $user->update($validated);

        // =============================================
        // 🔔 NOTIFIKASI KE DIRI SENDIRI
        // =============================================
        $changes = [];

        if ($oldName !== $user->name) {
            $changes[] = "nama menjadi \"{$user->name}\"";
        }
        if ($oldEmail !== $user->email) {
            $changes[] = "email menjadi \"{$user->email}\"";
        }
        if ($oldPhone !== $user->phone) {
            $changes[] = "nomor telepon menjadi \"{$user->phone}\"";
        }

        if (count($changes) > 0) {
            $changesText = implode(', ', $changes);

            Notification::create([
                'user_id'  => $user->id,
                'actor_id' => $user->id,
                'title'    => 'Profile Diperbarui',
                'message'  => "Anda berhasil memperbarui {$changesText}.",
                'type'     => 'profile_updated',
            ]);
        }

        return back()->with('success', 'Profile berhasil diperbarui.');
    }

    /**
     * UPDATE FOTO PROFILE
     */
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'photo.required' => 'Foto wajib dipilih.',
            'photo.image'    => 'File harus berupa gambar.',
            'photo.mimes'    => 'Format gambar harus jpg, jpeg, png, atau webp.',
            'photo.max'      => 'Ukuran gambar maksimal 2MB.',
        ]);

        $user = Auth::user();

        // Hapus foto lama jika ada
        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        // Simpan foto baru
        $path = $request->file('photo')->store('profile-photos', 'public');

        $user->update([
            'profile_photo_path' => $path,
        ]);

        // =============================================
        // 🔔 NOTIFIKASI KE DIRI SENDIRI
        // =============================================
        Notification::create([
            'user_id'  => $user->id,
            'actor_id' => $user->id,
            'title'    => 'Foto Profile Diperbarui',
            'message'  => 'Anda berhasil mengganti foto profile Anda.',
            'type'     => 'profile_photo_updated',
        ]);

        return back()->with('success', 'Foto profile berhasil diperbarui.');
    }

    /**
     * HAPUS FOTO PROFILE
     */
    public function removePhoto()
    {
        $user = Auth::user();

        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);

            $user->update([
                'profile_photo_path' => null,
            ]);

            // =============================================
            // 🔔 NOTIFIKASI KE DIRI SENDIRI
            // =============================================
            Notification::create([
                'user_id'  => $user->id,
                'actor_id' => $user->id,
                'title'    => 'Foto Profile Dihapus',
                'message'  => 'Anda berhasil menghapus foto profile Anda.',
                'type'     => 'profile_photo_removed',
            ]);
        }

        return back()->with('success', 'Foto profile berhasil dihapus.');
    }

    /**
     * UPDATE PASSWORD
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'current_password'      => 'required|current_password',
            'new_password'          => 'required|string|min:8|confirmed',
            'new_password_confirmation' => 'required|string|min:8',
        ], [
            'current_password.required'      => 'Password saat ini wajib diisi.',
            'current_password.current_password' => 'Password saat ini tidak cocok.',
            'new_password.required'          => 'Password baru wajib diisi.',
            'new_password.min'               => 'Password baru minimal 8 karakter.',
            'new_password.confirmed'         => 'Konfirmasi password baru tidak cocok.',
            'new_password_confirmation.required' => 'Konfirmasi password baru wajib diisi.',
        ]);

        $user->update([
            'password' => Hash::make($validated['new_password']),
        ]);

        // =============================================
        // 🔔 NOTIFIKASI KE DIRI SENDIRI
        // =============================================
        Notification::create([
            'user_id'  => $user->id,
            'actor_id' => $user->id,
            'title'    => 'Password Diubah',
            'message'  => 'Anda berhasil mengubah password akun Anda.',
            'type'     => 'password_changed',
        ]);

        return back()->with('success', 'Password berhasil diubah.');
    }

    /**
     * HAPUS AKUN
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();

        // Validasi password untuk konfirmasi
        $request->validate([
            'password' => 'required|current_password',
        ], [
            'password.required' => 'Password wajib diisi untuk konfirmasi.',
            'password.current_password' => 'Password yang Anda masukkan tidak cocok.',
        ]);

        // Cegah admin hapus akun sendiri dari halaman ini
        if ($user->role === 'admin') {
            return back()->withErrors(['Admin tidak dapat menghapus akun sendiri dari halaman ini.']);
        }

        DB::beginTransaction();

        try {
            $userName = $user->name;
            $userEmail = $user->email;
            $userRole = $user->role;

            // =============================================
            // KIRIM NOTIFIKASI KE SEMUA ADMIN SEBELUM HAPUS
            // =============================================
            $admins = User::where('role', 'admin')
                ->where('id', '!=', $user->id)
                ->get();

            $roleLabel = ucfirst($userRole);
            $message = "Akun dengan nama \"{$userName}\" ({$userEmail}) dengan role {$roleLabel} telah dihapus oleh pemilik akun sendiri.";

            // Jika pengelola, tambahkan info tentang dana campaign
            if ($userRole === 'pengelola') {
                $activeCampaigns = $user->campaigns()
                    ->whereIn('status', ['approved', 'ended'])
                    ->count();

                $totalDana = $user->campaigns()
                    ->whereIn('status', ['approved', 'ended'])
                    ->sum('current_amount_rd_pengelola');

                if ($activeCampaigns > 0 || $totalDana > 0) {
                    $message .= " Akun ini memiliki {$activeCampaigns} campaign aktif dengan sisa dana pengelola sebesar Rp " . number_format($totalDana, 0, ',', '.') . " yang perlu disalurkan ke campaign lain.";
                }
            }

            foreach ($admins as $admin) {
                Notification::create([
                    'user_id'  => $admin->id,
                    'actor_id' => $user->id,
                    'title'    => 'Akun User Dihapus Sendiri',
                    'message'  => $message,
                    'type'     => 'user_self_deleted',
                ]);
            }


            // =============================================
            // HAPUS SEMUA DATA TERKAIT USER (URUTAN PENTING)
            // =============================================

            // 1. Hapus notifikasi user
            $user->notifications()->delete();

            // 2. Hapus komentar user
            $user->comments()->delete();

            // 3. Hapus rekening bank user
            $user->userBanks()->delete();

            // 4. Hapus withdraw user (yang pending akan otomatis gagal)
            $user->withdraws()->delete();

            // 5. Hapus payout user
            $user->payouts()->delete();

            // 6. Hapus donasi user
            $user->donations()->delete();

            // 7. Hapus campaign updates milik campaign user
            foreach ($user->campaigns as $campaign) {
                // Hapus file gambar campaign
                if ($campaign->image) {
                    Storage::disk('public')->delete($campaign->image);
                }
                // Hapus updates
                foreach ($campaign->updates as $update) {
                    if ($update->image) {
                        Storage::disk('public')->delete($update->image);
                    }
                    $update->comments()->delete();
                    $update->delete();
                }
            }

            // 8. Hapus campaign user
            $user->campaigns()->delete();

            // 9. Hapus foto profile
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            // 10. Hapus KTP
            if ($user->ktp_path) {
                Storage::disk('local')->delete($user->ktp_path);
            }

            // 11. Hapus user
            $user->delete();

            DB::commit();

            // Logout & redirect
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('home')
                ->with('account_deleted', "Akun \"{$userName}\" telah berhasil dihapus. Semua data terkait telah dihapus secara permanen.");
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors([
                'Terjadi kesalahan saat menghapus akun: ' . $e->getMessage()
            ]);
        }
    }
}
