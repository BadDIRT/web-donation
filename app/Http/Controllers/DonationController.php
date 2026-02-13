<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class DonationController extends Controller
{
    public function donate(Request $request, Campaign $campaign)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000'
        ]);

        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $orderId = 'DON-' . uniqid();

        Donation::create([
            'user_id' => auth()->id(),
            'campaign_id' => $campaign->id,
            'midtrans_order_id' => $orderId,
            'amount' => $request->amount,
            'status' => 'pending'
        ]);

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $request->amount,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json(['snap_token' => $snapToken]);
    }
}
