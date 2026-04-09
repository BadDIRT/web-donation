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

        // Menghitung jumlah user unik yang pernah berdonasi, mengecualikan user_id null (donatur tamu)
        $uniqueDonorsCount = \App\Models\Donation::whereNotNull('user_id')
            ->distinct('user_id')
            ->count('user_id');

        // Hanya ambil donasi yang SUKSES untuk keperluan Stats & Badge
        $donations = Donation::where('user_id', $user->id)
            ->where('status', 'success') // <--- TAMBAHKAN INI
            ->get();

        $campaigns = $user->campaigns()
            ->latest()
            ->with('category')
            ->get();

        $withdraws = Withdraw::where('user_id', auth()->id())
            ->with('campaign')
            ->latest()
            ->get();

        // Semua donasi untuk stats
        $allDonations = Donation::where('user_id', $user->id)->get();

        // Riwayat donasi dibatasi 5 terbaru
        $recentDonations = Donation::where('user_id', $user->id)
            ->with('campaign')
            ->latest()
            ->take(5)
            ->get();

        // Tambahkan ini di method dashboard pengelola
        $recentIncome = Donation::whereHas('campaign', function ($q) {
            $q->where('user_id', auth()->id());
        })
            ->with('campaign')
            ->where('status', 'success')
            ->latest()
            ->take(5)
            ->get();

        $totalIncome = Donation::whereHas('campaign', function ($q) {
            $q->where('user_id', auth()->id());
        })
            ->where('status', 'success')
            ->sum('amount');

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
            'myDonations',
            'donations',
            'uniqueDonorsCount',
            'allDonations', // 🔥 DIUBAH
            'recentDonations', // 🔥 DIUBAH
            'recentIncome', // 🔥 DIUBAH
            'totalIncome'
        ));
    }

    public function donaturDashboard()
    {
        $user = auth()->user();

        // Hanya ambil donasi yang SUKSES untuk keperluan Stats & Badge
        $allDonations = Donation::where('user_id', $user->id)
            ->where('status', 'success') // <--- TAMBAHKAN INI
            ->get();

        // Riwayat donasi dibatasi 5 terbaru
        $recentDonations = Donation::where('user_id', $user->id)
            ->with('campaign')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.donatur', [
            'donations' => $allDonations,        // Untuk stats & sidebar
            'recentDonations' => $recentDonations, // Untuk tabel riwayat
        ]);
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
