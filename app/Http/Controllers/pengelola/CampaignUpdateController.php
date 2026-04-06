<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\CampaignUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CampaignUpdateController extends Controller
{
    public function create(Campaign $campaign)
    {
        if ($campaign->user_id !== auth()->id()) {
            abort(403);
        }

        $updates = $campaign->updates()->get();

        return view('pengelola.campaigns.updates.create', compact('campaign', 'updates'));
    }

    public function store(Request $request, Campaign $campaign)
    {
        if ($campaign->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('updates', 'public');
        }

        $campaign->updates()->create($validated);

        return back()->with('success', 'Kabar terbaru berhasil dipublikasikan.');
    }

    public function destroy(Campaign $campaign, CampaignUpdate $update)
    {
        if ($campaign->user_id !== auth()->id()) {
            abort(403);
        }

        if ($update->image) {
            Storage::disk('public')->delete($update->image);
        }

        $update->delete();

        return back()->with('success', 'Kabar terbaru berhasil dihapus.');
    }
}
