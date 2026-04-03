<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserBank;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WithdrawController extends Controller
{
    public function create()
    {
        $user = Auth::user();

        $campaigns = Campaign::where('user_id', $user->id)
            ->whereNotIn('status', ['pending', 'rejected']) // Mengambil approved, closed, ended
            ->get();

        $userBanks = $user->userBanks()->with('bank')->get();

        return view('withdraw.create', compact('campaigns', 'userBanks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'campaign_id' => 'required|exists:campaigns,id',
            'amount'      => 'required|numeric|min:10000',
            'description' => 'required|string|min:5',
            'user_bank_id' => 'required|exists:user_banks,id',
        ]);

        $user = Auth::user();

        $campaign = Campaign::where('id', $request->campaign_id)
            ->where('user_id', $user->id)
            ->first();

        if (!$campaign) {
            return back()->withErrors(['Campaign tidak valid.']);
        }

        // VALIDASI SALDO PENGELOLA (BUKAN current_amount)
        if ($request->amount > $campaign->current_amount_rd_pengelola) {
            return back()->withErrors(['Saldo pengelola tidak mencukupi.']);
        }

        $userBank = UserBank::with('bank')
            ->where('id', $request->user_bank_id)
            ->where('user_id', $user->id)
            ->first();

        if (!$userBank) {
            return back()->withErrors(['Rekening tidak valid.']);
        }

        // SIMPAN REQUEST
        $withdraw = Withdraw::create([
            'user_id'     => $user->id,
            'user_bank_id' => $userBank->id,
            'campaign_id' => $campaign->id,
            'amount'      => $request->amount,
            'description' => $request->description,
            'bank_id'     => $userBank->bank_id, // ✅ FIX
            'status'      => 'pending',
        ]);

        // =========================
        // 🔔 NOTIFIKASI KE ADMIN
        // =========================
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            Notification::create([
                'user_id'  => $admin->id,
                'actor_id' => $user->id,
                'title'    => 'Pengajuan Penarikan Dana',
                'message'  => "{$user->name} mengajukan penarikan sebesar Rp "
                    . number_format($withdraw->amount, 0, ',', '.')
                    . " dari campaign \"{$campaign->title}\" ke rekening {$userBank->bank->name} ({$userBank->account_number}).",
                'type'     => 'withdraw_request',
            ]);
        }

        // =========================
        // 🔔 NOTIFIKASI KE PENGELOLA
        // =========================
        Notification::create([
            'user_id'  => $user->id,
            'actor_id' => $user->id,
            'title'    => 'Pengajuan Penarikan Berhasil',
            'message'  => "Pengajuan penarikan dana sebesar Rp "
                . number_format($withdraw->amount, 0, ',', '.')
                . " dari campaign \"{$campaign->title}\" sedang diproses. Estimasi verifikasi maksimal 3x24 jam.",
            'type'     => 'withdraw_submitted',
        ]);

        return redirect()->route('withdraw.success');
    }

    public function adminIndex(Request $request)
    {
        $query = Withdraw::with(['user', 'campaign', 'bank'])
            ->where('status', 'pending');

        // 🔍 SEARCH
        if ($request->q) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('user', function ($u) use ($request) {
                    $u->where('name', 'like', '%' . $request->q . '%');
                })
                    ->orWhereHas('campaign', function ($c) use ($request) {
                        $c->where('title', 'like', '%' . $request->q . '%');
                    });
            });
        }

        $withdraws = $query->latest()->paginate(10);

        return view('withdrawals.index', compact('withdraws'));
    }

    public function approve(Request $request, $id)
    {
        $request->validate([
            'transfer_proof' => 'required|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        $withdraw = Withdraw::with(['campaign', 'user', 'bank'])->findOrFail($id);

        // upload bukti transfer
        $path = $request->file('transfer_proof')->store('transfer_proofs', 'public');

        try {
            DB::transaction(function () use ($withdraw, $path) {

                if ($withdraw->campaign->current_amount_rd_pengelola < $withdraw->amount) {
                    throw new \Exception('Saldo campaign tidak mencukupi.');
                }

                $withdraw->campaign->decrement('current_amount_rd_pengelola', $withdraw->amount);

                $withdraw->update([
                    'status' => 'approved',
                    'transfer_proof' => $path,
                ]);

                Notification::create([
                    'user_id'  => $withdraw->user_id,
                    'actor_id' => auth()->id(),
                    'title'    => 'Penarikan Disetujui',
                    'message'  => "Penarikan dana sebesar Rp "
                        . number_format($withdraw->amount, 0, ',', '.')
                        . " telah ditransfer.",
                    'type'     => 'withdraw_approved',
                ]);
            });
        } catch (\Exception $e) {
            return back()->withErrors([$e->getMessage()]);
        }

        return redirect()
            ->route('admin.withdrawals')
            ->with('success', 'Penarikan berhasil di-approve & bukti transfer diupload.');
    }

    public function adminShow($id)
    {
        $adminBanks = UserBank::where('user_id', auth()->id())
            ->with('bank')
            ->get();
        $withdraw = Withdraw::with(['user', 'campaign', 'bank'])->findOrFail($id);

        return view('withdrawals.show', compact('withdraw', 'adminBanks'));
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|min:5'
        ]);

        $withdraw = Withdraw::with(['campaign', 'user'])->findOrFail($id);

        DB::transaction(function () use ($withdraw, $request) {

            // UPDATE STATUS + SIMPAN ALASAN
            $withdraw->update([
                'status' => 'rejected',
                'reason' => $request->reason
            ]);

            Notification::create([
                'user_id'  => $withdraw->user_id,   // penerima (pengelola)
                'actor_id' => auth()->id(),         // 🔥 admin sebagai pelaku
                'title'    => 'Penarikan Ditolak',
                'message'  => "Pengajuan penarikan dana sebesar Rp "
                    . number_format($withdraw->amount, 0, ',', '.')
                    . " dari campaign \"{$withdraw->campaign->title}\" ditolak oleh admin. Alasan: {$request->reason}",
                'type'     => 'withdraw_rejected',
            ]);
        });

        return redirect()->route('admin.withdrawals')
            ->with('success', 'Withdraw berhasil ditolak');
    }

    public function history(Request $request)
    {
        $user = Auth::user();

        $query = Withdraw::with('campaign')
            ->where('user_id', $user->id)
            ->latest();

        // 🔎 FILTER STATUS (optional)
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // 🔎 SEARCH CAMPAIGN
        if ($request->search) {
            $query->whereHas('campaign', function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%');
            });
        }

        $withdraws = $query->paginate(10)->withQueryString();

        return view('withdraw.history', compact('withdraws'));
    }

    public function show($id)
    {
        $withdraw = Withdraw::with(['campaign', 'bank'])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('withdraw.show', compact('withdraw'));
    }
}
