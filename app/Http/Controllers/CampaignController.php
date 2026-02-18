<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Category;
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
        ->with('category') // ✅ EAGER LOADING
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
        }, fn ($q) => $q->latest())

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

        return view('campaign.show', compact('campaign'));
    }

    /**
     * FORM BUAT CAMPAIGN
     */
    public function create()
    {
        $categories = Category::all();
        return view('campaign.create', compact('categories'));
    }

    /**
     * SIMPAN CAMPAIGN BARU
     * status default = PENDING
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'required',
            'target_amount' => 'required|numeric|min:1000',
            'category_id'   => 'required|exists:categories,id',
            'image'         => 'required|image|max:2048',
        ]);

        $imagePath = $request->file('image')
            ->store('campaigns', 'public');

        Campaign::create([
            'user_id'       => auth()->id(),
            'category_id'   => $request->category_id,
            'title'         => $request->title,
            'description'   => $request->description,
            'target_amount' => $request->target_amount,
            'image'         => $imagePath,
            'status'        => 'pending', // ⬅️ PENTING
        ]);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Campaign berhasil dibuat & menunggu approval admin');
    }
}
