<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MidtransCallbackController extends Controller
{
    public function handle(Request $request)
    {
        $serverKey = config('services.midtrans.server_key');

        $signature = hash(
            'sha512',
            $request->order_id .
                $request->status_code .
                $request->gross_amount .
                $serverKey
        );

        if ($signature !== $request->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $donation = Donation::where('order_id', $request->order_id)->first();

        if (!$donation) {
            return response()->json(['message' => 'Donation not found'], 404);
        }

        $status = $request->transaction_status;

        // 🔥 BUNGKUS SEMUA DALAM TRANSACTION
        try {
            DB::beginTransaction();

            if ($status == 'settlement' || $status == 'capture') {

                if ($donation->status !== 'success') {

                    $donation->status = 'success';
                    $donation->save();

                    $campaign = $donation->campaign;

                    // update progress campaign
                    $campaign->increment('current_amount', $donation->amount);
                    $campaign->increment('current_amount_rd_pengelola', $donation->amount);

                    // 🔥 REFRESH AGAR AUTO CLOSE AKURAT
                    $campaign->refresh();

                    // 🔥 AMBIL SEMUA ADMIN
                    $admins = User::where('role', 'admin')->get();

                    // 🔥 KIRIM NOTIF KE SEMUA ADMIN
                    foreach ($admins as $admin) {
                        Notification::create([
                            'user_id'  => $admin->id,
                            'actor_id' => null,
                            'title'    => 'Donasi Masuk',
                            'message'  => 'Donasi sebesar Rp ' . number_format($donation->amount, 0, ',', '.') .
                                ' masuk ke campaign "' . $campaign->title . '".',
                            'type'     => 'donation_success'
                        ]);
                    }

                    // 🔥 KIRIM NOTIF KE PEMILIK CAMPAIGN (PENGELOLA)
                    Notification::create([
                        'user_id'  => $campaign->user_id,
                        'actor_id' => $donation->user_id, // Akan null jika donatur anonim/tamu
                        'title'    => 'Donasi Baru Masuk',
                        'message'  => 'Donasi sebesar Rp ' . number_format($donation->amount, 0, ',', '.') .
                            ' berhasil masuk ke campaign Anda "' . $campaign->title . '".',
                        'type'     => 'donation_success'
                    ]);

                    // AUTO CLOSE CAMPAIGN
                    if ($campaign->current_amount >= $campaign->target_amount) {

                        $campaign->update([
                            'status' => 'ended'
                        ]);

                        // NOTIF KE PENGELOLA
                        Notification::create([
                            'user_id'  => $campaign->user_id,
                            'actor_id' => null,
                            'title'    => 'Campaign Berakhir Otomatis',
                            'message'  => "Campaign \"{$campaign->title}\" telah berakhir otomatis karena telah berhasil mencapai target donasi.",
                            'type'     => 'campaign_ended_auto'
                        ]);

                        // NOTIF KE SEMUA ADMIN
                        foreach ($admins as $admin) {
                            Notification::create([
                                'user_id'  => $admin->id,
                                'actor_id' => null,
                                'title'    => 'Campaign Berakhir Mencapai Target',
                                'message'  => "Campaign \"{$campaign->title}\" oleh {$campaign->user->name} telah berakhir otomatis.",
                                'type'     => 'campaign_ended_auto'
                            ]);
                        }
                    }
                }
            } elseif ($status == 'pending') {
                $donation->status = 'pending';
                $donation->save();
            } elseif (in_array($status, ['expire', 'cancel', 'deny'])) {
                $donation->status = 'failed';
                $donation->save();
            }

            // JIKA SEMUA BERHASIL, COMMIT KE DATABASE
            DB::commit();
        } catch (\Exception $e) {
            // JIKA ADA ERROR (NOTIF GAGAL, DB ERROR, DLL), BATALKAN SEMUA
            DB::rollBack();

            // CATAT ERROR DI LOG LARAVEL UNTUK DEBUGGING
            Log::error('Midtrans Callback Error: ' . $e->getMessage());

            // KIRIM 500 AGAR MIDTRANS MELAKUKAN RETRY
            return response()->json(['message' => 'Server error, please retry'], 500);
        }

        return response()->json(['message' => 'Callback processed']);
    }
}
