<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

class DonationController extends Controller
{
    public function donate(Request $request, Campaign $campaign)
    {
        // 🔒 CEK LIMIT CAMPAIGN
        if ($campaign->current_amount >= $campaign->target_amount) {
            return response()->json([
                'error' => 'Campaign sudah mencapai target'
            ], 422);
        }

        if (($campaign->current_amount + $request->amount) > $campaign->target_amount) {
            return response()->json([
                'error' => 'Donasi melebihi target campaign'
            ], 422);
        }

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

        // 🔥 AMBIL DATA USER SECARA AMAN (MENGGUNAKAN NULL SAFE OPERATOR ?->)
        $user = auth()->user();

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
                'email'      => $user?->email ?? 'guest@gmail.com', // ✅ AMAN UNTUK GUEST
                'phone'      => $user?->phone ?? '081234567890',   // ✅ AMAN UNTUK GUEST
            ],
        ]);

        // ✅ SIMPAN KE DATABASE DULU SEBELUM MIDTRANS
        Donation::create([
            'user_id'    => $user?->id, // ✅ AMAN UNTUK GUEST (AKAN NULL)
            'campaign_id' => $campaign->id,
            'order_id'   => $orderId,
            'amount'     => $request->amount,
            'donor_name' => $request->boolean('anonymous') ? null : $request->donor_name,
            'anonymous'  => $request->boolean('anonymous'),
            'message'    => $request->message,
            'status'     => 'pending',
        ]);

        // KIRIM SNAP TOKEN KE FRONTEND
        return response()->json([
            'snapToken' => $snapToken
        ]);
    }
}
