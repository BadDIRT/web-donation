<?php

namespace App\Http\Controllers;

use App\Models\Donation;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'pengelola') {
            return view('dashboard.pengelola');
        }

        $donations = Donation::where('user_id',$user->id)
            ->latest()
            ->get();

        return view('dashboard.donatur',compact('donations'));
    }
}

