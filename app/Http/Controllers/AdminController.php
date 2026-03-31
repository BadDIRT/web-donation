<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserBank;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            'totalBankBalance'  => UserBank::sum('balance'),
            'userBanks'         => UserBank::with('bank')->get(),

            // 🔥 TAMBAHAN
            'pendingWithdraws'  => Withdraw::where('status', 'pending')->count(),

            // 🔥 INI YANG DIPAKE
            'userBanks' => $userBanks,
            'totalBankBalance' => $totalBankBalance,
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

        return back()->with('success', 'Pengelola disetujui');
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

        return back()->with('success', 'Campaign ditolak');
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

        return back()->with('success', 'Campaign disetujui');
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
            'phone'       => null,
            'ktp_path'    => null,
        ]);

        $user->notifications()->create([
            'user_id'  => $user->id,          // 🔥 target (yang menerima notif)
            'actor_id' => auth()->id(),       // 🔥 admin yang melakukan aksi
            'title'    => 'Pengajuan Ditolak',
            'message'  => 'Pengajuan Anda ditolak oleh admin. Alasan: ' . $request->reason,
            'type'     => 'pengelola_reject'
        ]);

        return back()->with('success', 'Pengajuan berhasil ditolak.');
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
}
