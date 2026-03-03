<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Notification;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification as MidtransNotification;

class MidtransCallbackController extends Controller
{
    public function handle(Request $request)
    {
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = false;

        $notification = new MidtransNotification();

        $transactionStatus = $notification->transaction_status;
        $orderId = $notification->order_id;
        $fraudStatus = $notification->fraud_status;

        $donation = Donation::where('order_id', $orderId)->first();

        if (!$donation) {
            return response()->json(['message' => 'Donation not found'], 404);
        }

        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'accept') {
                $donation->status = 'success';
            }
        } elseif ($transactionStatus == 'settlement') {
            $donation->status = 'success';
        } elseif ($transactionStatus == 'pending') {
            $donation->status = 'pending';
        } elseif (
            $transactionStatus == 'deny' ||
            $transactionStatus == 'expire' ||
            $transactionStatus == 'cancel'
        ) {
            $donation->status = 'failed';
        }

        $donation->save();

        /*
        |--------------------------------------------------------------------------
        | CREATE NOTIFICATION
        |--------------------------------------------------------------------------
        */

        Notification::create([
            'user_id' => $donation->campaign->user_id, // pengelola campaign
            'title' => 'Update Donasi',
            'message' => "Donasi sebesar Rp " . number_format($donation->amount) .
                " untuk campaign {$donation->campaign->title} berstatus {$donation->status}.",
            'type' => 'donation',
        ]);

        return response()->json(['message' => 'Callback handled']);
    }
}
