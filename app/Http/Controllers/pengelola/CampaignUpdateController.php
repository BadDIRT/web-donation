<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\CampaignUpdate;
use App\Models\Notification;
use App\Models\User;
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

        $update = $campaign->updates()->create($validated);

        // ============================================
        // KIRIM NOTIFIKASI
        // ============================================
        $actor = auth()->user();
        $adminIds = User::where('role', 'admin')->pluck('id');
        $donorIds = $campaign->donations()
            ->where('status', 'success')
            ->whereNotNull('user_id')
            ->where('user_id', '!=', $actor->id)
            ->pluck('user_id')
            ->unique();

        // 1. Notifikasi ke semua Admin
        foreach ($adminIds as $adminId) {
            Notification::create([
                'user_id'  => $adminId,
                'actor_id' => $actor->id,
                'title'    => 'Kabar Terbaru Campaign',
                'message'  => "{$actor->name} memposting kabar terbaru \"{$update->title}\" di campaign \"{$campaign->title}\".",
                'type'     => 'campaign_update',
            ]);
        }

        // 2. Notifikasi ke Pemilik Campaign (diri sendiri)
        Notification::create([
            'user_id'  => $campaign->user_id,
            'actor_id' => $actor->id,
            'title'    => 'Kabar Terbaru Dipublikasikan',
            'message'  => "Kabar terbaru \"{$update->title}\" untuk campaign \"{$campaign->title}\" berhasil dipublikasikan.",
            'type'     => 'campaign_update',
        ]);

        // 3. Notifikasi ke semua Donatur campaign tersebut
        foreach ($donorIds as $donorId) {
            Notification::create([
                'user_id'  => $donorId,
                'actor_id' => $actor->id,
                'title'    => 'Update dari Campaign yang Kamu Dukung',
                'message'  => "Campaign \"{$campaign->title}\" memiliki kabar terbaru: \"{$update->title}\". Yuk cek perkembangannya!",
                'type'     => 'campaign_update',
            ]);
        }

        return back()->with('success', 'Kabar terbaru berhasil dipublikasikan.');
    }

    public function destroy(Campaign $campaign, CampaignUpdate $update)
    {
        if ($campaign->user_id !== auth()->id()) {
            abort(403);
        }

        $updateTitle = $update->title;

        if ($update->image) {
            Storage::disk('public')->delete($update->image);
        }

        $update->delete();

        // ============================================
        // KIRIM NOTIFIKASI
        // ============================================
        $actor = auth()->user();
        $adminIds = User::where('role', 'admin')->pluck('id');
        $donorIds = $campaign->donations()
            ->where('status', 'success')
            ->whereNotNull('user_id')
            ->where('user_id', '!=', $actor->id)
            ->pluck('user_id')
            ->unique();

        // 1. Notifikasi ke semua Admin
        foreach ($adminIds as $adminId) {
            Notification::create([
                'user_id'  => $adminId,
                'actor_id' => $actor->id,
                'title'    => 'Kabar Terbaru Dihapus',
                'message'  => "{$actor->name} menghapus kabar terbaru \"{$updateTitle}\" dari campaign \"{$campaign->title}\".",
                'type'     => 'campaign_update_deleted',
            ]);
        }

        // 2. Notifikasi ke Pemilik Campaign (diri sendiri)
        Notification::create([
            'user_id'  => $campaign->user_id,
            'actor_id' => $actor->id,
            'title'    => 'Kabar Terbaru Dihapus',
            'message'  => "Kabar terbaru \"{$updateTitle}\" dari campaign \"{$campaign->title}\" berhasil dihapus.",
            'type'     => 'campaign_update_deleted',
        ]);

        // 3. Notifikasi ke semua Donatur campaign tersebut
        foreach ($donorIds as $donorId) {
            Notification::create([
                'user_id'  => $donorId,
                'actor_id' => $actor->id,
                'title'    => 'Kabar Campaign Dihapus',
                'message'  => "Salah satu kabar terbaru dari campaign \"{$campaign->title}\" telah dihapus oleh pengelola.",
                'type'     => 'campaign_update_deleted',
            ]);
        }

        return back()->with('success', 'Kabar terbaru berhasil dihapus.');
    }
}
