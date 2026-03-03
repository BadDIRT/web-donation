<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

class DonationController extends Controller
{
    public function donate(Request $request, Campaign $campaign)
    {
        $request->validate([
            'amount' => 'required|integer|min:1000',
            'donor_name' => 'nullable|string|max:100',
            'anonymous' => 'boolean',
            'message' => 'nullable|string|max:255',
        ]);

        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $orderId = 'DON-' . uniqid();

        $snapToken = \Midtrans\Snap::getSnapToken([
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $request->amount,
            ],
            'item_details' => [[
                'id' => $campaign->id,
                'price' => (int) $request->amount,
                'quantity' => 1,
                'name' => $campaign->title,
            ]],
            'customer_details' => [
                'first_name' => $request->donor_name ?? 'Donatur',
                'email'            => $request->user()->email ?? null,
                'phone'            => $request->user()->phone ?? null,
            ],
        ]);

        Donation::create([
            'campaign_id' => $campaign->id,
            'order_id' => $orderId,
            'amount' => $request->amount,
            'donor_name' => $request->boolean('anonymous') ? null : $request->donor_name,
            'anonymous' => $request->boolean('anonymous'),
            'message' => $request->message,
            'status' => 'pending',
        ]);

        return response()->json([
            'snapToken' => $snapToken
        ]);
    }
}
