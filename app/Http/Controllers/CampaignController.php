<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\CampaignUpdate;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Donation;
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
            ->with(['category', 'user'])

            // 🔥 FILTER STATUS (DINAMIS)
            ->when($request->status, function ($q) use ($request) {
                $q->where('status', $request->status);
            }, function ($q) {
                // Default jika tidak ada filter status
                $q->where('status', 'approved');
            })

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
        // 🔥 IZINKAN AKSES JIKA STATUSNYA APPROVED ATAU ENDED
        if (!in_array($campaign->status, ['approved', 'ended'])) {
            abort(404);
        }

        $campaign->load(['user', 'category', 'updates']);

        $topDonors = $campaign->donations()
            ->where('status', 'success')
            ->selectRaw('user_id, donor_name, SUM(amount) as total')
            ->groupBy('user_id', 'donor_name')
            ->orderByDesc('total')
            ->take(5)
            ->with('user')
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

        return back()->with('success', 'Status campaign berhasil diubah');
    }

    public function createCampaignForAdmin()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.campaigns.create', compact('categories'));
    }

    public function storeCampaignForAdmin(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'required|string|max:500',
            'article'       => 'required|string',
            'target_amount' => 'required|numeric|min:100000',
            'image'         => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'category_id'   => 'nullable|exists:categories,id',
        ], [
            'title.required'         => 'Judul campaign wajib diisi.',
            'title.max'              => 'Judul maksimal 255 karakter.',
            'description.required'   => 'Deskripsi singkat wajib diisi.',
            'description.max'        => 'Deskripsi maksimal 500 karakter.',
            'article.required'       => 'Konten artikel wajib diisi.',
            'target_amount.required' => 'Target donasi wajib diisi.',
            'target_amount.min'      => 'Target donasi minimal Rp 100.000.',
            'image.required'         => 'Gambar cover wajib diupload.',
            'image.image'            => 'File harus berupa gambar.',
            'image.mimes'            => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'image.max'              => 'Ukuran gambar maksimal 5MB.',
            'category_id.exists'     => 'Kategori tidak valid.',
        ]);

        $imagePath = $request->file('image')->store('campaigns', 'public');

        Campaign::create([
            'user_id'       => auth()->id(),
            'category_id'   => $request->category_id,
            'title'         => $validated['title'],
            'description'   => $validated['description'],
            'article'       => $validated['article'],
            'target_amount' => $validated['target_amount'],
            'current_amount' => 0,
            'image'         => $imagePath,
            'slug'          => str()->slug($validated['title']) . '-' . uniqid(),
            'status'        => 'approved',
        ]);

        Notification::create([
            'user_id'  => auth()->id(),
            'actor_id' => auth()->id(),
            'title'    => 'Campaign Dibuat',
            'message'  => "Campaign \"{$validated['title']}\" berhasil dibuat dan langsung aktif!",
            'type'     => 'campaign_created'
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Campaign berhasil dibuat dan langsung aktif!');
    }

    public function showCampaignPengelola(Campaign $campaign)
    {
        if ($campaign->user_id !== auth()->id()) {
            abort(403);
        }

        return view('pengelola.campaigns.show', compact('campaign'));
    }

    public function update(Request $request, Campaign $campaign)
    {
        if ($campaign->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = [];

        // Mapping label update_type
        $typeLabels = [
            'title'       => 'Judul',
            'description' => 'Deskripsi Singkat',
            'article'     => 'Konten Artikel',
        ];

        switch ($request->update_type) {
            case 'title':
                $request->validate([
                    'title' => 'required|string|max:255',
                ]);
                $validated['title'] = $request->title;
                break;

            case 'description':
                $request->validate([
                    'description' => 'nullable|string|max:500',
                ]);
                $validated['description'] = $request->description;
                break;

            case 'article':
                $request->validate([
                    'article' => 'nullable|string',
                ]);
                $validated['article'] = $request->article;
                break;

            default:
                return back()->with('error', 'Tipe pembaruan tidak valid.');
        }

        $oldValue = $campaign->getOriginal($request->update_type);
        $newValue = $validated[$request->update_type] ?? null;
        $updateLabel = $typeLabels[$request->update_type] ?? $request->update_type;

        $campaign->update($validated);

        // ============================================
        // KIRIM NOTIFIKASI
        // ============================================
        $actor = auth()->user();

        // Ambil semua donatur (termasuk yang donate anonim tapi punya akun)
        $donorIds = $campaign->donations()
            ->where('status', 'success')
            ->whereNotNull('user_id')
            ->where('user_id', '!=', $actor->id)
            ->pluck('user_id')
            ->unique();

        // 1. Notifikasi ke semua Admin
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            Notification::create([
                'user_id'  => $admin->id,
                'actor_id' => $actor->id,
                'title'    => 'Campaign Diperbarui',
                'message'  => "{$actor->name} mengubah {$updateLabel} campaign \"{$campaign->title}\".",
                'type'     => 'campaign_updated',
            ]);
        }

        // 2. Notifikasi ke Pemilik Campaign (diri sendiri)
        Notification::create([
            'user_id'  => $campaign->user_id,
            'actor_id' => $actor->id,
            'title'    => 'Campaign Berhasil Diperbarui',
            'message'  => "{$updateLabel} campaign \"{$campaign->title}\" berhasil diperbarui.",
            'type'     => 'campaign_updated',
        ]);

        // 3. Notifikasi ke semua Donatur (termasuk yang donate anonim tapi login)
        foreach ($donorIds as $donorId) {
            Notification::create([
                'user_id'  => $donorId,
                'actor_id' => $actor->id,
                'title'    => 'Update Campaign yang Kamu Dukung',
                'message'  => "Campaign \"{$campaign->title}\" telah memperbarui {$updateLabel}nya. Yuk cek info terbarunya!",
                'type'     => 'campaign_updated',
            ]);
        }

        return back()->with('success', 'Campaign berhasil diperbarui.');
    }

    public function incomeHistory(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $campaignId = $request->input('campaign');

        $query = Donation::whereHas('campaign', function ($q) {
            $q->where('user_id', auth()->id());
        })->with('campaign');

        if (!empty($status)) {
            $query->where('status', $status);
        }

        if (!empty($campaignId)) {
            $query->where('campaign_id', $campaignId);
        }

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('donor_name', 'like', '%' . $search . '%')
                    ->orWhereHas('campaign', function ($q2) use ($search) {
                        $q2->where('title', 'like', '%' . $search . '%');
                    });
            });
        }

        $donations = $query->latest()->paginate(10)->withQueryString();

        $campaigns = Campaign::where('user_id', auth()->id())
            ->where('status', 'approved')
            ->orderBy('title')
            ->pluck('title', 'id');

        $totalIncome = Donation::whereHas('campaign', function ($q) {
            $q->where('user_id', auth()->id());
        })
            ->where('status', 'success')
            ->sum('amount');

        return view('pengelola.income.index', compact('donations', 'campaigns', 'totalIncome'));
    }

    public function updatesIndex(Campaign $campaign)
    {
        // Pastikan campaign bisa dilihat publik
        if (!in_array($campaign->status, ['approved', 'ended'])) {
            abort(404);
        }

        $campaign->load(['user', 'category', 'updates']);

        $updates = $campaign->updates()->latest()->paginate(6)->withQueryString();

        return view('campaign.updates.index', compact('campaign', 'updates'));
    }

    public function updateShow(Campaign $campaign, CampaignUpdate $update)
    {
        if ($update->campaign_id !== $campaign->id) {
            abort(404);
        }

        if (!in_array($campaign->status, ['approved', 'ended'])) {
            abort(404);
        }

        $campaign->load(['user', 'category']);

        $update->load('comments.user');

        $prevUpdate = CampaignUpdate::where('campaign_id', $campaign->id)
            ->where('id', '<', $update->id)
            ->latest()
            ->first();

        $nextUpdate = CampaignUpdate::where('campaign_id', $campaign->id)
            ->where('id', '>', $update->id)
            ->oldest()
            ->first();

        return view('campaign.updates.show', compact('campaign', 'update', 'prevUpdate', 'nextUpdate'));
    }

    // 1. Update method commentStore agar mengambil user yang sedang login (jika ada)
    public function commentStore(Request $request, Campaign $campaign, CampaignUpdate $update)
    {
        if ($update->campaign_id !== $campaign->id) {
            abort(404);
        }

        // 1. VALIDASI
        $rules = [
            'content' => 'required|string|max:1000',
        ];

        // Validasi 'name' HANYA jika user belum login (Guest)
        if (!auth()->check()) {
            $rules['name'] = 'required|string|max:255';
        }

        $request->validate($rules);

        // 2. PERSIAPAN DATA
        $commentData = [
            'content' => $request->content,
            'user_id' => auth()->id(), // Akan NULL jika guest, berisi ID jika login
        ];

        // 3. LOGIKA PENENTUAN NAMA
        if (auth()->check()) {
            // KONDISI LOGIN: Ambil nama dari data user
            $commentData['name'] = auth()->user()->name;
        } else {
            // KONDISI GUEST: Ambil nama dari input form
            $commentData['name'] = $request->name;
        }

        // Simpan komentar
        $update->comments()->create($commentData);

        // ============================================
        // KIRIM NOTIFIKASI KE PENGELOLA CAMPAIGN
        // ============================================

        // Cek apakah yang berkomentar BUKAN pemilik campaign
        if ($campaign->user_id !== auth()->id()) {
            $actor = auth()->user();

            // Tentukan nama untuk notifikasi
            // Jika login ambil dari user, jika guest ambil dari request
            $actorName = $actor ? $actor->name : $request->name;

            Notification::create([
                'user_id'  => $campaign->user_id,
                'actor_id' => $actor ? $actor->id : null,
                'title'    => 'Komentar Baru pada Update',
                'message'  => "{$actorName} berkomentar pada update \"{$update->title}\" di campaign \"{$campaign->title}\".",
                'type'     => 'comment_update',
            ]);
        }

        return redirect()->route('campaign.updates.show', ['campaign' => $campaign->slug, 'update' => $update->id])
            ->with('success', 'Komentar berhasil ditambahkan.');
    }

    // 2. Tambahkan method baru untuk Update (Edit) Komentar
    public function commentUpdate(Request $request, Campaign $campaign, CampaignUpdate $update, Comment $comment)
    {
        // Validasi keamanan: Pastikan komentar milik update yang benar
        if ($comment->campaign_update_id !== $update->id) {
            abort(404);
        }

        // Validasi: Hanya pemilik komentar yang bisa edit
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki izin mengedit komentar ini.');
        }

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment->update([
            'content' => $request->content,
        ]);

        return redirect()->route('campaign.updates.show', ['campaign' => $campaign->slug, 'update' => $update->id])->with('success', 'Komentar berhasil diperbarui.');
    }

    // 3. Update method commentDestroy untuk mengecek kepemilikan
    public function commentDestroy(Campaign $campaign, CampaignUpdate $update, Comment $comment)
    {
        if ($comment->campaign_update_id !== $update->id) {
            abort(404);
        }

        // Validasi: Hanya pemilik komentar yang bisa hapus
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki izin menghapus komentar ini.');
        }

        $comment->delete();

        return redirect()->route('campaign.updates.show', ['campaign' => $campaign->slug, 'update' => $update->id])->with('success', 'Komentar berhasil dihapus.');
    }
}
