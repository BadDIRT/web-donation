<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

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

        if ($status == 'settlement' || $status == 'capture') {

            if ($donation->status !== 'success') {

                $donation->status = 'success';
                $donation->save();

                $campaign = $donation->campaign;
                // update progress campaign
                $campaign->increment('current_amount', $donation->amount);
                $campaign->increment('current_amount_rd', $donation->amount);
                $campaign->increment('current_amount_rd_pengelola', $donation->amount);

                // 🔥 AMBIL SEMUA ADMIN
            $admins = User::where('role', 'admin')->get();

            // 🔥 KIRIM NOTIF KE SEMUA ADMIN
            foreach ($admins as $admin) {
                Notification::create([
                    'user_id' => $admin->id,
                    'actor_id' => null, // system
                    'title'   => 'Donasi Masuk',
                    'message' => 'Donasi sebesar Rp ' . number_format($donation->amount, 0, ',', '.') .
                        ' masuk ke campaign "' . $campaign->title . '".',
                    'type'    => 'donation_success'
                ]);
            }

                // AUTO CLOSE CAMPAIGN
                if ($campaign->current_amount >= $campaign->target_amount) {

                    $campaign->update([
                        'status' => 'closed'
                    ]);
                }
            }
        } elseif ($status == 'pending') {

            $donation->status = 'pending';
            $donation->save();
        } elseif (in_array($status, ['expire', 'cancel', 'deny'])) {

            $donation->status = 'failed';
            $donation->save();
        }

        $donation->save();

        return response()->json(['message' => 'Callback processed']);
    }
}
