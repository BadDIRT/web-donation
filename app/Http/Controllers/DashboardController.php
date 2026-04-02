<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Withdraw;
use Illuminate\Support\Facades\Request;

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

        // 🔥 DIUBAH: Mengambil total saldo RD pengelola dari seluruh campaign miliknya
        $totalWithdrawable = $user->campaigns()->sum('current_amount_rd_pengelola');

        $myDonations = Donation::where('user_id', $user->id)
            ->with('campaign')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.pengelola', compact(
            'campaigns',
            'totalCampaign',
            'approvedCampaign',
            'pendingCampaign',
            'userBanks',
            'totalWithdrawable', // 🔥 DIUBAH
            'withdraws',
            'myDonations'
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

    public function myDonations(Request $request)
    {
        $user = auth()->user();

        $query = Donation::where('user_id', $user->id)
            ->with('campaign')
            ->latest();

        // 🔥 LOGIC FILTER STATUS (MENGGUNAKAN HELPER GLOBAL)
        if (request('status')) {
            $query->where('status', request('status'));
        }

        // 🔥 LOGIC SEARCH JUDUL CAMPAIGN (MENGGUNAKAN HELPER GLOBAL)
        if (request('search')) {
            $query->whereHas('campaign', function ($q) {
                $q->where('title', 'like', '%' . request('search') . '%');
            });
        }

        $donations = $query->paginate(10)->withQueryString();

        // Total nominal untuk ditampilkan di stats
        $totalDonated = Donation::where('user_id', $user->id)->where('status', 'success')->sum('amount');

        return view('dashboard.my-donations', compact('donations', 'totalDonated'));
    }   
}
