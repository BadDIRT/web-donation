<?php

namespace App\Http\Controllers;

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

        /*
        |--------------------------------------------------------------------------
        | CREATE NOTIFICATION
        |--------------------------------------------------------------------------
        */

        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'title' => 'Update Donasi',
                'message' => "Donasi sebesar Rp " . number_format($donation->amount) .
                    " untuk campaign {$donation->campaign->title} berstatus {$donation->status}.",
                'type' => 'donation',
            ]);
        }

        return response()->json(['message' => 'Callback processed']);
    }
}
