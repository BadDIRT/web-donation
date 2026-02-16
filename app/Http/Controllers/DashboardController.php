<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Campaign;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'pengelola') {
            $campaigns = Campaign::where('user_id', $user->id)->get();
            return view('dashboard.pengelola', compact('campaigns'));
        }

        // DONATUR
        $donations = Donation::where('user_id', $user->id)
            ->latest()
            ->get();

        return view('dashboard.donatur', compact('donations'));
    }
}


