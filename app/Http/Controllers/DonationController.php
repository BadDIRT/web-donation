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
        // 1. CEK LIMIT CAMPAIGN
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

        // 2. VALIDASI DINAMIS
        $user = auth()->user();

        $rules = [
            'amount'    => 'required|integer|min:1000',
            'anonymous' => 'boolean',
            'message'   => 'nullable|string|max:255',
        ];

        // Jika User Belum Login, wajibkan Nama & Email
        if (!$user) {
            $rules['donor_name'] = 'required|string|max:100';
            $rules['email']       = 'required|email|max:100';
        }

        $request->validate($rules);

        // 3. SIAPKAN DATA VARIABEL
        // Tentukan Nama & Email yang akan dikirim ke Midtrans & Database
        $donorNameDisplay = ''; // Untuk Midtrans
        $donorNameDb      = ''; // Untuk Database
        $donorEmail       = '';
        $userId           = $user ? $user->id : null;

        if ($user) {
            // Jika Sudah Login: Ambil dari Auth User
            $donorNameDisplay = $user->name;
            $donorNameDb      = $user->name; // Nanti dicek lagi kondisi anonim di bawah
            $donorEmail       = $user->email;
        } else {
            // Jika Belum Login: Ambil dari Input Form
            $donorNameDisplay = $request->donor_name;
            $donorNameDb      = $request->donor_name; // Nanti dicek lagi kondisi anonim di bawah
            $donorEmail       = $request->email;
        }

        // Cek kondisi Anonim
        $isAnonymous = $request->boolean('anonymous');

        // Jika Anonim, nama di Database jadi NULL, tapi nama di Midtrans tetap ada (misal: Hamba Allah)
        if ($isAnonymous) {
            $donorNameDb = null;
            $midtransName = 'Hamba Allah'; // Nama yang muncul di invoice/payment page
        } else {
            $midtransName = $donorNameDisplay;
        }

        // 4. KONFIGURASI MIDTRANS
        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $orderId = 'DON-' . uniqid();

        $snapToken = \Midtrans\Snap::getSnapToken([
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => (int) $request->amount,
            ],
            'item_details' => [[
                'id'       => $campaign->id,
                'price'    => (int) $request->amount,
                'quantity' => 1,
                'name'     => $campaign->title,
            ]],
            'customer_details' => [
                'first_name' => $midtransName,
                'email'      => $donorEmail,
                'phone'      => $user?->phone ?? '081234567890',
            ],
        ]);

        // 5. SIMPAN KE DATABASE
        Donation::create([
            'user_id'    => $userId,
            'campaign_id' => $campaign->id,
            'order_id'   => $orderId,
            'amount'     => $request->amount,
            'donor_name' => $donorNameDb, // Sudah dihandle null jika anonim
            'anonymous'  => $isAnonymous,
            'message'    => $request->message,
            'status'     => 'pending',
        ]);

        return response()->json([
            'snapToken' => $snapToken
        ]);
    }
}
