<?php

namespace App\Http\Controllers;

use App\Models\UserBank;
use App\Models\Campaign;
use App\Models\Notification;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
