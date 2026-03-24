<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPayoutController extends Controller
{
    public function withdraw(Request $request, Campaign $campaign)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'bank_name' => 'required|in:BCA,BRI,BNI,Mandiri,CIMB,BTN,BSI',
            'bank_account' => 'required|string'
        ]);

        DB::beginTransaction();

        try {

            $user = $campaign->user;
            $amount = $request->amount;

            // VALIDASI SALDO
            if (empty($campaign->current_amount_rd) || $campaign->current_amount_rd <= 0 || $amount > $campaign->current_amount_rd) {
                return redirect()
                    ->route('admin.campaign.show', $campaign->id)
                    ->with('error', '❌ Gagal! Saldo campaign tidak mencukupi.');
            }

            // VALIDASI STATUS (biar lebih aman)
            if ($campaign->status !== 'approved') {
                return redirect()
                    ->route('admin.campaign.show', $campaign->id)
                    ->with('error', '❌ Campaign belum aktif / tidak bisa ditarik.');
            }

            // PROSES
            $campaign->current_amount_rd -= $amount;
            $campaign->save();

            $user->wallet = ($user->wallet ?? 0) + $amount;
            $user->total_withdrawal = ($user->total_withdrawal ?? 0) + $amount;

            $user->wallet += $amount;
            $user->total_withdrawal += $amount;
            $user->save();

            DB::commit();

            // Ambil semua admin
            $admins = User::where('role', 'admin')->get();

            foreach ($admins as $admin) {
                Notification::create([
                    'user_id' => $admin->id,
                    'title'   => 'informasi penarikan',
                    'message' => "{$admin->name} berhasil menarik dana sebesar {$amount}",
                    'type'    => 'withdrawal',
                ]);
            }

            return redirect()
                ->route('admin.campaign.show', $campaign->id)
                ->with(
                    'success',
                    '✅ Penarikan berhasil sebesar Rp ' .
                        number_format($amount, 0, ',', '.') .
                        ' ke bank ' . $request->bank_name
                );
        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                '❌ Terjadi kesalahan sistem: ' . $e->getMessage()
            );
        }
    }
}
