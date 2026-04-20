<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Category;
use App\Models\Donation;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserBank;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // ambil semua bank milik user login + relasi bank
        $userBanks = UserBank::with('bank')
            ->where('user_id', $user->id)
            ->get();

        // total saldo user login
        $totalBankBalance = $userBanks->sum('balance');

        return view('dashboard.admin', [
            'totalUsers' => User::count(),
            'totalCampaigns' => Campaign::count(),
            'totalDonations' => Campaign::sum('current_amount'),
            'userBanks' => $userBanks,
            'totalBankBalance' => $totalBankBalance,

            // --- PENDING DATA (BADGE) ---
            'pendingWithdraws'  => Withdraw::where('status', 'pending')->count(),
            'pendingPengelola'  => User::where('role', 'pengelola')->where('is_approved', false)->count(),
            'pendingCampaigns'   => Campaign::where('status', 'pending')->count(),

            // 🟢 DATA BARU UNTUK DASHBOARD
            'recentDonations' => Donation::with(['user', 'campaign'])
                ->where('status', 'success')
                ->latest()
                ->take(5)
                ->get(),
            'latestUsers' => User::latest()->take(5)->get(),
        ]);
    }

    public function pengelolaList(Request $request)
    {
        $search = $request->query('q');

        $users = User::where('role', 'pengelola')
            ->where('is_approved', false)
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('id', $search);
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.pengelola', compact('users', 'search'));
    }

    public function approvePengelola(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'role' => 'pengelola',
            'is_approved' => true
        ]);

        $user->notifications()->create([
            'user_id'  => $user->id,
            'actor_id' => auth()->id(),
            'title'    => 'Pengajuan Disetujui',
            'message'  => "{$user->name} telah disetujui sebagai pengelola.",
            'type'     => 'pengelola_approve'
        ]);

        return redirect()->route('admin.pengelola')->with('success', 'Pengelola disetujui');
    }

    public function campaignList(Request $request)
    {
        $search = $request->query('q');

        $campaigns = Campaign::with('user') // 🔥 FIX
            ->where('status', 'pending')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('id', $search)
                        ->orWhereHas('user', function ($u) use ($search) {
                            $u->where('name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%");
                        });
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.campaign', compact('campaigns', 'search'));
    }

    public function showCampaign(Campaign $campaign)
    {
        return view('admin.campaign-detail', compact('campaign'));
    }

    public function rejectCampaign(Request $request, Campaign $campaign)
    {
        $request->validate([
            'reason' => 'required|string|min:5'
        ]);

        $campaign->update(['status' => 'rejected']);

        $actor = auth()->user();
        $target = $campaign->user;

        $target->notifications()->create([
            'user_id'  => $target->id, // optional (sudah otomatis sebenarnya)
            'actor_id' => $actor->id,  // 🔥 admin yang reject
            'title'    => 'Campaign Ditolak',
            'message'  => "{$actor->name} menolak campaign \"{$campaign->title}\". Alasan: {$request->reason}",
            'type'     => 'campaign_reject',
        ]);

        return redirect()->route('admin.campaign')->with('success', 'Campaign ditolak');
    }

    public function approveCampaign(Campaign $campaign)
    {
        $campaign->update(['status' => 'approved']);

        $actor = auth()->user();
        $target = $campaign->user;

        $target->notifications()->create([
            'user_id'  => $target->id, // optional (karena pakai relasi)
            'actor_id' => $actor->id,  // 🔥 admin yang approve
            'title'    => 'Campaign Disetujui',
            'message'  => "{$actor->name} menyetujui campaign \"{$campaign->title}\" dan sekarang sudah aktif.",
            'type'     => 'campaign_approve',
        ]);

        return redirect()->route('admin.campaign')->with('success', 'Campaign disetujui');
    }

    public function showPengelola(User $user)
    {
        return view('admin.pengelola-detail', compact('user'));
    }

    public function rejectPengelola(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|min:5'
        ]);

        $user = User::findOrFail($id);

        // 🗑️ HAPUS FILE KTP
        if ($user->ktp_path && Storage::disk('local')->exists($user->ktp_path)) {
            Storage::disk('local')->delete($user->ktp_path);
        }

        // 🗑️ HAPUS SEMUA REKENING (pivot)
        UserBank::where('user_id', $user->id)->delete();

        // 🔄 RESET USER
        $user->update([
            'role'        => 'donatur',
            'is_approved' => false,
            'ktp_path'    => null,
        ]);

        $user->notifications()->create([
            'user_id'  => $user->id,          // 🔥 target (yang menerima notif)
            'actor_id' => auth()->id(),       // 🔥 admin yang melakukan aksi
            'title'    => 'Pengajuan Ditolak',
            'message'  => 'Pengajuan Anda ditolak oleh admin. Alasan: ' . $request->reason,
            'type'     => 'pengelola_reject'
        ]);

        return redirect()->route('admin.pengelola')->with('success', 'Pengajuan berhasil ditolak.');
    }

    public function viewKtp(User $user)
    {
        if (!$user->ktp_path || !Storage::disk('local')->exists($user->ktp_path)) {
            abort(404);
        }

        $path = storage_path('app/private/' . $user->ktp_path);

        return response()->file($path);
    }

    public function active(Request $request)
    {
        $query = Campaign::with('user');

        /*
    |--------------------------------------------------------------------------
    | STATUS FILTER
    |--------------------------------------------------------------------------
    */
        if ($request->status) {
            $query->where('status', $request->status);
        } else {
            $query->where('status', 'approved'); // default aktif
        }

        /*
    |--------------------------------------------------------------------------
    | SEARCH
    |--------------------------------------------------------------------------
    */
        if ($request->q) {
            $query->where(function ($q) use ($request) {

                $q->where('title', 'like', '%' . $request->q . '%')
                    ->orWhere('id', $request->q)
                    ->orWhereHas('user', function ($u) use ($request) {
                        $u->where('name', 'like', '%' . $request->q . '%');
                    });
            });
        }

        /*
    |--------------------------------------------------------------------------
    | SORT
    |--------------------------------------------------------------------------
    */
        switch ($request->sort) {

            case 'target':
                $query->orderBy('target_amount', 'desc');
                break;

            case 'donation':
                $query->orderBy('current_amount', 'desc');
                break;

            case 'oldest':
                $query->oldest();
                break;

            default:
                $query->latest();
                break;
        }

        $campaigns = $query
            ->paginate(10)
            ->withQueryString();

        return view('admin.active-campaign', compact('campaigns'));
    }

    public function activities(Request $request)
    {
        $query = Notification::with(['user', 'actor'])->latest();

        // SEARCH
        if ($request->q) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->q . '%')
                    ->orWhere('message', 'like', '%' . $request->q . '%');
            });
        }

        // FILTER TYPE
        if ($request->type) {
            $query->where('type', $request->type);
        }

        $notifications = $query->paginate(10)->withQueryString();

        return view('activities.index', compact('notifications'));
    }

    public function activityDetail($id)
    {
        $notification = Notification::with(['user', 'actor'])
            ->findOrFail($id);

        return view('activities.show', compact('notification'));
    }

    // =========================================================================
    // KELOLA USER (CRUD)
    // =========================================================================

    public function usersIndex(Request $request)
    {
        $query = User::query();

        // SEARCH
        if ($request->q) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->q . '%')
                    ->orWhere('email', 'like', '%' . $request->q . '%');
            });
        }

        // FILTER ROLE
        if ($request->role) {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->paginate(10)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function usersCreate()
    {
        return view('admin.users.create');
    }

    public function usersStore(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role'     => 'required|in:donatur,pengelola,admin',
        ], [
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // Tentukan status approve: True jika role admin, False jika selain itu
        $isApproved = ($request->role === 'admin') ? true : false;

        $user = User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            'role'        => $request->role,
            'is_approved' => $isApproved, // <--- TAMBAHKAN INI
        ]);

        // 🔔 NOTIFIKASI KE ADMIN SENDIRI
        Notification::create([
            'user_id'  => auth()->id(),
            'actor_id' => auth()->id(),
            'title'    => 'User Baru Ditambahkan',
            'message'  => "Anda berhasil menambahkan user baru: {$user->name} ({$user->email}) dengan role {$user->role}.",
            'type'     => 'user_created',
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function usersEdit(User $user)
    {
        // Cegah admin mengedit akunnya sendiri di halaman ini (opsional, untuk keamanan)
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak bisa mengedit akun sendiri dari halaman ini.');
        }

        return view('admin.users.edit', compact('user'));
    }

    public function usersUpdate(Request $request, User $user)
    {
        $rules = [
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role'  => 'required|in:donatur,pengelola,admin',
        ];

        // Password opsional saat edit
        if ($request->filled('password')) {
            $rules['password'] = 'string|min:6|confirmed';
        }

        $request->validate($rules);

        $data = $request->only('name', 'email', 'role');

        // --- LOGIKA BARU: ATUR is_approved BERDASARKAN ROLE BARU ---
        // Jika role diubah menjadi admin, maka status approved = true.
        // Jika role diubah menjadi selain admin (donatur/pengelola), maka status approved = false.
        if ($request->role === 'admin') {
            $data['is_approved'] = true;
        } else {
            $data['is_approved'] = false;
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Simpan role lama untuk cek apakah ada perubahan
        $oldRole = $user->role;

        $user->update($data);

        // 🔔 NOTIFIKASI KE ADMIN SENDIRI
        Notification::create([
            'user_id'  => auth()->id(),
            'actor_id' => auth()->id(),
            'title'    => 'Data User Diperbarui',
            'message'  => "Anda berhasil memperbarui data user: {$user->name} ({$user->email}).",
            'type'     => 'user_updated',
        ]);

        // 🔔 NOTIFIKASI KE USER YANG DIEDIT (JIKA ROLE-NYA BERUBAH)
        if ($oldRole !== $user->role) {
            Notification::create([
                'user_id'  => $user->id,
                'actor_id' => auth()->id(),
                'title'    => 'Role Akun Anda Diubah',
                'message'  => "Admin telah mengubah role akun Anda dari '{$oldRole}' menjadi '{$user->role}'.",
                'type'     => 'role_changed',
            ]);
        }

        return redirect()->route('admin.users.index')->with('success', 'Data user berhasil diperbarui.');
    }

    public function usersDestroy(User $user)
    {
        // Cegah hapus diri sendiri
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $userName = $user->name;

        // Hapus semua relasi terkait SESUAI URUTAN (child → parent)
        $user->notifications()->delete();      // Notifikasi user
        $user->userBanks()->delete();          // Rekening bank
        $user->donations()->delete();          // Donasi yang dibuat
        $user->campaigns()->delete();          // Campaign yang dibuat ← INI YANG KURANG

        // Jika ada relasi lain, tambahkan di sini:
        // $user->withdrawals()->delete();
        // $user->comments()->delete();

        // Baru hapus user
        $user->delete();

        // 🔔 NOTIFIKASI KE ADMIN SENDIRI
        Notification::create([
            'user_id'  => auth()->id(),
            'actor_id' => auth()->id(),
            'title'    => 'User Dihapus',
            'message'  => "Anda berhasil menghapus user: {$userName}.",
            'type'     => 'user_deleted',
        ]);

        return redirect()->route('admin.users.index')->with('success', "User '{$userName}' berhasil dihapus.");
    }

    public function createCampaignForAdmin()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.create-campaign', compact('categories'));
    }

    public function userDetail(User $user)
    {
        // Ambil semua relasi yang dibutuhkan di halaman detail
        $user->load(['userBanks.bank', 'donations.campaign', 'campaigns']);

        return view('admin.users.show', compact('user'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:donatur,pengelola,admin',
        ]);

        // Cegah admin mengubah role dirinya sendiri
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak dapat mengubah role akun sendiri.');
        }

        $oldRole = $user->role;
        $newRole = $request->role;

        $user->role = $newRole;

        // --- LOGIKA BARU ---
        // Jika role diubah menjadi Admin, status approved otomatis true.
        // Jika role diubah menjadi selain Admin (Donatur/Pengelola), status approved otomatis false.
        if ($newRole === 'admin') {
            $user->is_approved = true;
        } else {
            $user->is_approved = false;
        }

        $user->save();

        return back()->with('success', "Role berhasil diubah dari {$oldRole} menjadi {$newRole}.");
    }

    public function donationsIndex(Request $request)
    {
        $query = Donation::with(['user', 'campaign']);

        // SEARCH
        if ($request->q) {
            $query->where(function ($q) use ($request) {
                $q->where('donor_name', 'like', '%' . $request->q . '%')
                    ->orWhereHas('user', function ($user) use ($request) {
                        $user->where('name', 'like', '%' . $request->q . '%')
                            ->orWhere('email', 'like', '%' . $request->q . '%');
                    })
                    ->orWhereHas('campaign', function ($campaign) use ($request) {
                        $campaign->where('title', 'like', '%' . $request->q . '%');
                    });
            });
        }

        // FILTER STATUS
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // FILTER ANONIM
        if ($request->has('anonymous') && $request->anonymous !== '') {
            $query->where('anonymous', $request->anonymous === '1');
        }

        // SORT
        $sort = $request->get('sort', 'latest');
        if ($sort === 'oldest') {
            $query->oldest();
        } elseif ($sort === 'highest') {
            $query->orderByDesc('amount');
        } elseif ($sort === 'lowest') {
            $query->orderBy('amount');
        } else {
            $query->latest();
        }

        $donations = $query->paginate(15)->withQueryString();

        // Stats untuk sidebar
        $totalNominal = Donation::sum('amount');
        $totalTransaksi = Donation::count();
        $pendingCount = Donation::where('status', 'pending')->count();
        $failedCount = Donation::where('status', 'failed')->count();

        return view('admin.donations.index', compact(
            'donations',
            'totalNominal',
            'totalTransaksi',
            'pendingCount',
            'failedCount'
        ));
    }

    public function donationDetail(Donation $donation)
    {
        $donation->load(['user', 'campaign']);
        return view('admin.donations.show', compact('donation'));
    }
}
