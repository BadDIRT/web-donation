<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::where('status', 'approved')->paginate(9);
        return view('campaign.index', compact('campaigns'));
    }

    public function show(Campaign $campaign)
    {
        if ($campaign->status !== 'approved') {
            abort(404);
        }

        return view('campaign.show', compact('campaign'));
    }

    public function create()
    {
        return view('campaign.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'target_amount' => 'required|numeric',
            'image' => 'required|image'
        ]);

        $imagePath = $request->file('image')->store('campaigns','public');

        Campaign::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'target_amount' => $request->target_amount,
            'image' => $imagePath,
            'status' => 'pending'
        ]);

        return redirect()->route('dashboard')
            ->with('success','Campaign menunggu approval admin');
    }
}

