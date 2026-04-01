<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Withdraw;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return match ($user->role) {
            'admin'     => redirect()->route('admin.dashboard'),
            'pengelola' => redirect()->route('dashboard.pengelola'),
            default     => redirect()->route('dashboard.donatur'),
        };
    }

    public function pengelolaDashboard()
    {
        $user = auth()->user();

        $campaigns = $user->campaigns()
            ->latest()
            ->with('category')
            ->get();

        $withdraws = Withdraw::where('user_id', auth()->id())
            ->with('campaign')
            ->latest()
            ->get();

        $totalCampaign    = $campaigns->count();
        $approvedCampaign = $campaigns->where('status', 'approved')->count();
        $pendingCampaign  = $campaigns->where('status', 'pending')->count();

        $userBanks = $user->userBanks()->with('bank')->get();
        $totalBalance = $userBanks->sum('balance');

        return view('dashboard.pengelola', compact(
            'campaigns',
            'totalCampaign',
            'approvedCampaign',
            'pendingCampaign',
            'userBanks',
            'totalBalance',
            'withdraws'
        ));
    }

    public function donaturDashboard()
    {
        $user = auth()->user();

        $donations = Donation::where('user_id', $user->id)
            ->with('campaign')
            ->latest()
            ->get();

        return view('dashboard.donatur', compact('donations'));
    }
}
