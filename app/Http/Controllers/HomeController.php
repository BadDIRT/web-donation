<?php

namespace App\Http\Controllers;

use App\Models\Campaign;

class HomeController extends Controller
{
    public function index()
{
    $campaigns = Campaign::with('category') // eager loading
        ->where('status', 'approved')
        ->latest()
        ->take(6)
        ->get();

    return view('home.index', compact('campaigns'));
}

}
