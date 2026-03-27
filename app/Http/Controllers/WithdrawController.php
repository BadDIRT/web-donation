<?php

namespace App\Http\Controllers;

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

        // Ambil campaign milik user yang approved
        $campaigns = Campaign::where('user_id', $user->id)
            ->where('status', 'approved')
            ->get();

        return view('withdraw.create', compact('campaigns'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'campaign_id' => 'required|exists:campaigns,id',
            'amount'      => 'required|numeric|min:10000',
            'description' => 'required|string|min:5',
        ]);

        $user = Auth::user();

        $campaign = Campaign::where('id', $request->campaign_id)
            ->where('user_id', $user->id)
            ->first();

        if (!$campaign) {
            return back()->withErrors(['Campaign tidak valid.']);
        }

        // VALIDASI SALDO
        if ($request->amount > $campaign->current_amount) {
            return back()->withErrors(['Saldo campaign tidak mencukupi.']);
        }

        // SIMPAN REQUEST
        $withdraw = Withdraw::create([
            'user_id'     => $user->id,
            'campaign_id' => $campaign->id,
            'amount'      => $request->amount,
            'description' => $request->description,
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
