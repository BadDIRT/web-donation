<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('dashboard.admin', [
            'totalUsers' => User::count(),
            'totalCampaigns' => Campaign::count(),
            'totalDonations' => Donation::sum('amount'),
        ]);
    }

    public function pengelolaList()
    {
        $users = User::where('role', 'pengelola')
            ->where('is_approved', false)
            ->get();

        return view('admin.pengelola', compact('users'));
    }

    public function approvePengelola(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'role' => 'pengelola',
            'is_approved' => true
        ]);

        $user->notifications()->create([
            'title' => 'Pengajuan Disetujui',
            'message' => 'Selamat! Pengajuan Anda sebagai pengelola telah disetujui.',
            'type' => 'pengelola_approve'
        ]);

        return back()->with('success', 'Pengelola disetujui');
    }

    public function campaignList()
    {
        $campaigns = Campaign::where('is_approved', false)->get();

        return view('admin.campaign', compact('campaigns'));
    }

    public function approveCampaign(Campaign $campaign)
    {
        $campaign->update(['is_approved' => true]);

        $campaign->user->notifications()->create([
            'title' => 'Campaign Disetujui',
            'message' => "Campaign Anda '{$campaign->title}' telah disetujui dan sekarang live!",
            'type' => 'campaign_approve'
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

        if ($user->ktp_path && Storage::disk('local')->exists($user->ktp_path)) {
            Storage::disk('local')->delete($user->ktp_path);
        }

        // Reset data user
        $user->update([
            'role'         => 'donatur',
            'is_approved'  => false,
            'phone'        => null,
            'ktp_path'     => null,
            'bank_account' => null,
        ]);

        // Kirim notifikasi
        $user->notifications()->create([
            'title'   => 'Pengajuan Ditolak',
            'message' => $request->reason,
            'type'    => 'pengelola_reject'
        ]);

        return back()->with('success', 'Pengajuan berhasil ditolak.');
    }
}
