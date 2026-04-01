<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Category;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    /**
     * HALAMAN PUBLIK - LIST CAMPAIGN
     * hanya campaign yang APPROVED
     */
    public function index(Request $request)
    {
        $campaigns = Campaign::query()
            ->with(['category', 'user']) // 🔥 FIX
            ->where('status', 'approved')

            // SEARCH
            ->when($request->search, function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%');
            })

            // FILTER KATEGORI
            ->when($request->category, function ($q) use ($request) {
                $q->whereHas('category', function ($c) use ($request) {
                    $c->where('slug', $request->category);
                });
            })

            // SORTING
            ->when($request->sort, function ($q) use ($request) {
                match ($request->sort) {
                    'newest'       => $q->latest(),
                    'oldest'       => $q->oldest(),
                    'target_high'  => $q->orderBy('target_amount', 'desc'),
                    'target_low'   => $q->orderBy('target_amount', 'asc'),
                    'popular'      => $q->orderBy('current_amount', 'desc'),
                    default        => $q->latest(),
                };
            }, fn($q) => $q->latest())

            ->paginate(6)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('campaign.index', compact('campaigns', 'categories'));
    }



    /**
     * HALAMAN DETAIL CAMPAIGN
     * hanya bisa diakses jika APPROVED
     */
    public function show(Campaign $campaign)
    {
        if ($campaign->status !== 'approved') {
            abort(404);
        }

        $campaign->load(['user', 'category']); // 🔥 FIX

        $topDonors = $campaign->donations()
            ->where('status', 'success')
            ->selectRaw('donor_name, SUM(amount) as total')
            ->groupBy('donor_name')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        return view('campaign.show', compact('campaign', 'topDonors'));
    }

    /**
     * FORM BUAT CAMPAIGN
     */
    public function createCampaign()
    {
        $categories = Category::all();
        return view('campaign.create', compact('categories'));
    }

    /**
     * SIMPAN CAMPAIGN BARU
     * status default = PENDING
     */

    public function storeCampaign(Request $request)
    {
        $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'required|string',
            'article'       => 'required|string',
            'target_amount' => 'required|numeric|min:1000',
            'image'         => 'required|image|max:5120',
            'category_id'   => 'nullable|exists:categories,id',
        ], [
            'title.required'       => 'Judul campaign wajib diisi.',
            'description.required' => 'Deskripsi campaign wajib diisi.',
            'article.required'     => 'Artikel campaign wajib diisi.',
            'target_amount.required' => 'Target donasi wajib diisi.',
            'target_amount.numeric'  => 'Target donasi harus berupa angka.',
            'target_amount.min'      => 'Target donasi minimal Rp 1.000.',
            'image.required'       => 'Gambar campaign wajib diunggah.',
            'image.image'          => 'File yang diunggah harus berupa gambar.',
            'image.max'            => 'Ukuran gambar tidak boleh lebih dari 5MB.',
            'category_id.exists'   => 'Kategori yang dipilih tidak valid.',
        ]);

        $imagePath = $request->file('image')->store('campaigns', 'public');

        $campaign = Campaign::create([
            'user_id'        => auth()->id(),
            'category_id'    => $request->category_id,
            'title'          => $request->title,
            'description'    => $request->description,
            'article'        => $request->article,
            'target_amount'  => $request->target_amount,
            'current_amount' => 0,
            'image'          => $imagePath,
            'slug'           => str()->slug($request->title) . '-' . uniqid(),
            'status'         => 'pending',
        ]);

        $admins = User::where('role', 'admin')->get();

        $actor = auth()->user();

        // 🔔 KE ADMIN
        foreach ($admins as $admin) {
            Notification::create([
                'user_id'  => $admin->id,
                'actor_id' => $actor->id,
                'title'    => 'Pengajuan Campaign Baru',
                'message'  => "{$actor->name} mengajukan campaign \"{$campaign->title}\" untuk disetujui.",
                'type'     => 'campaign_request',
            ]);
        }

        // 🔔 KE PENGELOLA (DIRI SENDIRI)
        Notification::create([
            'user_id'  => $actor->id,
            'actor_id' => $actor->id,
            'title'    => 'Pengajuan Campaign Berhasil',
            'message'  => "Campaign \"{$campaign->title}\" berhasil diajukan dan sedang menunggu persetujuan admin. Proses verifikasi maksimal 3x24 jam.",
            'type'     => 'campaign_submitted',
        ]);

        return redirect()->route('campaign.success');
    }

    public function changeStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,closed,ended',
            'reason' => 'required|string|min:5'
        ]);

        $campaign = Campaign::with('user')->findOrFail($id);

        $oldStatus = $campaign->status;

        if ($campaign->status === $request->status) {
            return back()->withErrors(['Status sudah sama.']);
        }

        // mapping status biar user-friendly
        $statusLabel = [
            'approved' => 'Aktif',
            'closed'   => 'Ditutup',
            'ended'    => 'Berakhir',
        ];

        // update status
        $campaign->update([
            'status' => $request->status
        ]);

        // notifikasi ke pengelola
        Notification::create([
            'user_id' => $campaign->user_id,
            'actor_id' => auth()->id(),
            'title'   => 'Status Campaign Diubah',
            'message' => 'Campaign "' . $campaign->title . '" sekarang berstatus '
                . $statusLabel[$request->status] .
                '. Alasan: ' . $request->reason,
            'type'    => 'campaign_status_changed'
        ]);

        return back()->with('success', '✅ Status campaign berhasil diubah');
    }
}
