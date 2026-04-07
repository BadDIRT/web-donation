<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\CampaignUpdate;

class HomeController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::with(['category', 'user']) // 🔥 tambah user
            ->where('status', 'approved')
            ->latest()
            ->take(6)
            ->get();

        // AMBIL KABAR TERBARU
        $updates = CampaignUpdate::with(['campaign.user', 'campaign.category'])
            ->whereHas('campaign', function ($q) {
                $q->where('status', 'approved');
            })
            ->latest()
            ->take(6)
            ->get();

        return view('home.index', compact('campaigns', 'updates'));
    }
}
