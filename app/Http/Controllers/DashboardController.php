<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Campaign;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return match ($user->role) {
            'admin'     => redirect()->route('admin.dashboard'),
            'pengelola' => $this->pengelolaDashboard($user),
            default     => $this->donaturDashboard($user),
        };
    }

    protected function pengelolaDashboard($user)
    {
        $campaigns = Campaign::where('user_id', $user->id)->latest()->get();

        return view('dashboard.pengelola', compact('campaigns'));
    }

    protected function donaturDashboard($user)
    {
        $donations = Donation::where('user_id', $user->id)
            ->latest()
            ->get();

        return view('dashboard.donatur', compact('donations'));
    }
}


