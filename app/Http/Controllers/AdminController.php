<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Campaign;
use App\Models\Donation;

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
        $users = User::where('role','donatur')
            ->where('is_approved',false)
            ->get();

        return view('admin.pengelola',compact('users'));
    }

    public function approvePengelola(User $user)
    {
        $user->update([
            'role'=>'pengelola',
            'is_approved'=>true
        ]);

        return back()->with('success','Pengelola disetujui');
    }

    public function campaignList()
    {
        $campaigns = Campaign::where('status','pending')->get();
        return view('admin.campaign',compact('campaigns'));
    }

    public function approveCampaign(Campaign $campaign)
    {
        $campaign->update(['status'=>'approved']);

        return back()->with('success','Campaign disetujui');
    }
}

