<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPayoutController extends Controller
{
    public function withdraw(Request $request, Campaign $campaign)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'user_bank_id' => 'required|exists:user_banks,id',
        ]);

        DB::beginTransaction();

        try {
            $amount = $request->amount;
            $admin = auth()->user(); // 🔥 executor

            // 🔒 LOCK campaign
            $campaign = Campaign::lockForUpdate()->find($campaign->id);

            // VALIDASI SALDO
            if (!$campaign->current_amount_rd || $amount > $campaign->current_amount_rd) {
                return back()->with('error', '❌ Saldo campaign tidak mencukupi.');
            }

            // VALIDASI STATUS
            if ($campaign->status !== 'approved') {
                return back()->with('error', '❌ Campaign belum aktif.');
            }

            // 🔒 AMBIL USER BANK (TANPA BATAS USER)
            $userBank = UserBank::with('user', 'bank')
                ->lockForUpdate()
                ->find($request->user_bank_id);

            if (!$userBank) {
                return back()->with('error', '❌ Rekening tidak ditemukan.');
            }

            // ========================
            // 💰 PROSES TRANSAKSI
            // ========================

            // Kurangi saldo campaign
            $campaign->current_amount_rd -= $amount;
            $campaign->save();

            // Tambah saldo ke rekening tujuan
            $userBank->balance += $amount;
            $userBank->save();

            // Update total withdrawal PEMILIK REKENING
            $receiver = $userBank->user;
            $receiver->total_withdrawal = ($receiver->total_withdrawal ?? 0) + $amount;
            $receiver->save();

            DB::commit();

            // ========================
            // 🔔 NOTIFIKASI
            // ========================

            // ke admin
            Notification::create([
                'user_id' => $admin->id,
                'title'   => 'Withdraw Berhasil',
                'message' => "Anda menarik Rp " . number_format($amount, 0, ',', '.') .
                    " ke {$userBank->bank->name} - {$userBank->account_number}",
                'type'    => 'withdrawal',
            ]);

            // // ke penerima dana
            // Notification::create([
            //     'user_id' => $receiver->id,
            //     'title'   => 'Dana Masuk',
            //     'message' => "Dana Rp " . number_format($amount, 0, ',', '.') .
            //         " masuk ke rekening {$userBank->bank->name}",
            //     'type'    => 'income',
            // ]);

            return back()->with(
                'success',
                '✅ Penarikan Rp ' . number_format($amount, 0, ',', '.') .
                    ' ke ' . $userBank->bank->name .
                    ' - ' . $userBank->account_number
            );
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with(
                'error',
                '❌ System error: ' . $e->getMessage()
            );
        }
    }
}
