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
            ->where('status', 'approved')
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
            'bank_id'     => 'required|exists:user_banks,id',
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

        // SIMPAN REQUEST
        $withdraw = Withdraw::create([
            'user_id'     => $user->id,
            'campaign_id' => $campaign->id,
            'amount'      => $request->amount,
            'description' => $request->description,
            'bank_id'     => $request->bank_id,
            'status'      => 'pending',
        ]);

        // =========================
        // 🔔 NOTIFIKASI KE ADMIN
        // =========================
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'title'   => 'Pengajuan Penarikan Dana',
                'message' => "{$user->name} mengajukan penarikan Rp " . number_format($request->amount, 0, ',', '.') . " dari campaign \"{$campaign->title}\".",
                'type'    => 'withdraw_request',
            ]);
        }

        return redirect()
            ->route('dashboard')
            ->with('success', '✅ Pengajuan penarikan berhasil dikirim, menunggu persetujuan admin.');
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
            'admin_bank_id' => 'required|exists:user_banks,id',
        ]);

        $withdraw = Withdraw::with(['campaign', 'user', 'bank'])->findOrFail($id);

        $adminBank = UserBank::findOrFail($request->admin_bank_id);

        // VALIDASI SALDO ADMIN
        if ($adminBank->balance < $withdraw->amount) {
            return back()->withErrors(['Saldo admin tidak mencukupi.']);
        }

        DB::transaction(function () use ($withdraw, $adminBank) {

            if ($withdraw->campaign->current_amount_rd_pengelola < $withdraw->amount) {
                throw new \Exception('Saldo campaign tidak mencukupi.');
            }

            // 1. KURANGI SALDO ADMIN
            $adminBank->decrement('balance', $withdraw->amount);

            // 2. TAMBAH SALDO USER (REKENING YANG DIA PILIH)
            $userBank = UserBank::findOrFail($withdraw->bank_id);
            $userBank->increment('balance', $withdraw->amount);

            // 3. KURANGI SALDO PENGELOLA (campaign)
            $withdraw->campaign->decrement('current_amount_rd_pengelola', $withdraw->amount);

            // 4. UPDATE STATUS
            $withdraw->update([
                'status' => 'approved',
            ]);

            // 5. NOTIFIKASI
            Notification::create([
                'user_id' => $withdraw->user_id,
                'title'   => 'Withdraw Disetujui',
                'message' => 'Pengajuan penarikan kamu sudah disetujui admin sebesar Rp '
                    . number_format($withdraw->amount, 0, ',', '.') .
                    '. Dana sudah masuk ke rekening kamu.',
                'type'    => 'withdraw_approved'
            ]);
        });

        return redirect()->route('admin.withdrawals')
            ->with('success', '✅ Withdraw berhasil di-approve');
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

            // ❗ BALIKIN SALDO PENGELOLA (karena sebelumnya "dikunci")
            $withdraw->campaign->increment('current_amount_rd_pengelola', $withdraw->amount);

            // UPDATE STATUS + SIMPAN ALASAN
            $withdraw->update([
                'status' => 'rejected',
                'reason' => $request->reason
            ]);

            // NOTIFIKASI KE USER
            Notification::create([
                'user_id' => $withdraw->user_id,
                'title'   => 'Penarikan Ditolak',
                'message' => 'Pengajuan penarikan kamu ditolak admin. Alasan: ' . $request->reason,
                'type'    => 'withdraw_rejected'
            ]);
        });

        return redirect()->route('admin.withdrawals')
            ->with('success', '❌ Withdraw berhasil ditolak');
    }
}
