<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Campaign;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengelolaController extends Controller
{
    public function terms()
    {
        return view('pengelola.terms');
    }

    public function showForm()
    {
        $banks = Bank::all();

        return view('pengelola.form', compact('banks'));
    }

    public function submit(Request $request)
    {
        $user = Auth::user();

        // ✅ ATURAN VALIDASI DINAMIS
        $rules = [
            'ktp'             => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'bank_id'         => 'required|exists:banks,id',
            'account_number'  => 'required|string|max:100',
        ];

        // Hanya validasi phone jika user BELUM punya nomor HP
        if (!$user->phone) {
            $rules['phone'] = 'required|string|unique:users,phone|min:10|max:15';
        }

        $request->validate($rules, [
            'ktp.required'            => 'Foto KTP wajib diunggah.',
            'bank_id.required'        => 'Bank wajib dipilih.',
            'account_number.required' => 'Nomor rekening wajib diisi.',
            'phone.required'          => 'Nomor handphone wajib diisi.',
            'phone.unique'            => 'Nomor handphone sudah terdaftar.',
        ]);

        // ✅ JIKA SUDAH PUNYA NO HP, ISI MANUAL KE REQUEST AGAR VALIDASI UNIQUE LOLOS
        if ($user->phone) {
            $request->merge(['phone' => $user->phone]);
        }

        // 🚫 CEK SUDAH PERNAH AJUAN
        if ($user->ktp_path && $user->is_approved === false) {
            return back()->withErrors(['Anda sudah mengajukan permohonan.']);
        }

        // 🚫 CEK DUPLIKASI REKENING GLOBAL
        $isExist = UserBank::where('account_number', $request->account_number)->exists();

        if ($isExist) {
            return back()->withErrors(['Nomor rekening sudah terdaftar.']);
        }

        // 📁 SIMPAN KTP
        $ktpPath = $request->file('ktp')->store('ktp');

        // 🔄 UPDATE USER
        $userData = [
            'ktp_path'     => $ktpPath,
            'role'         => 'pengelola',
            'is_approved'  => false,
        ];

        // Hanya update phone jika user belum punya dan ada inputan baru
        if (!$user->phone && $request->phone) {
            $userData['phone'] = $request->phone;
        }

        $user->update($userData);

        // 💳 SIMPAN KE PIVOT
        UserBank::create([
            'user_id'        => $user->id,
            'bank_id'        => $request->bank_id, // 🔥 langsung pakai ini
            'account_number' => $request->account_number,
            'balance'        => 0,
            'is_primary'     => true,
        ]);

        // 🔔 NOTIF
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            Notification::create([
                'user_id'  => $admin->id,         // penerima (admin)
                'actor_id' => $user->id,          // yang melakukan (user submit)
                'title'    => 'Pengajuan Pengelola Baru',
                'message'  => "{$user->name} (ID: {$user->id}) mengajukan sebagai pengelola.",
                'type'     => 'pengelola_request',
            ]);
        }

        // 🔔 NOTIFIKASI KE USER (DIRI SENDIRI)
        Notification::create([
            'user_id'  => $user->id,
            'actor_id' => $user->id,
            'title'    => 'Pengajuan Pengelola Berhasil',
            'message'  => "Pengajuan Anda sebagai pengelola sedang diproses. Estimasi verifikasi maksimal 3x24 jam.",
            'type'     => 'pengelola_submitted',
        ]);

        return redirect()->route('pengelola.success');
    }

    public function createCampaign()
    {
        return view('campaign.create');
    }

    public function indexCampaignPengelola(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $query = Campaign::where('user_id', auth()->id());

        // Filter pencarian judul
        if (!empty($search)) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        // Filter status
        if (!empty($status)) {
            $query->where('status', $status);
        }

        $campaigns = $query->latest()
            ->paginate(10)
            ->withQueryString(); // ← INI PENTING! Biar pagination bawa filter

        return view('pengelola.campaigns.index', compact('campaigns'));
    }
}
