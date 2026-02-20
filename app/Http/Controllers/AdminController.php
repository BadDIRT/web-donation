<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Support\Facades\Request;

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
        $users = User::where('role', 'donatur')
            ->where('is_approved', false)
            ->get();

        return view('admin.pengelola', compact('users'));
    }

    public function approvePengelola(User $user)
    {
        $user->update([
            'role' => 'pengelola',
            'is_approved' => true
        ]);

        return back()->with('success', 'Pengelola disetujui');
    }

    public function campaignList()
    {
        $campaigns = Campaign::where('status', 'pending')->get();
        return view('admin.campaign', compact('campaigns'));
    }

    public function approveCampaign(Campaign $campaign)
    {
        $campaign->update(['status' => 'approved']);

        return back()->with('success', 'Campaign disetujui');
    }

    public function showPengelola(User $user)
    {
        return view('admin.pengelola-detail', compact('user'));
    }

    public function rejectPengelola(Request $request, User $user)
    {
        $request->validate([
            'reason' => 'required|min:10'
        ]);

        $user->update([
            'role' => 'donatur',
            'is_approved' => false,
            'reject_reason' => $request->reason
        ]);

        return back()->with('success', 'Pengajuan pengelola berhasil ditolak.');
    }
}
