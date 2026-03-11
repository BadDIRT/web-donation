<?php

namespace App\Http\Controllers;

use App\Models\Payout;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AdminPayoutController extends Controller
{

    public function store(Request $request, Campaign $campaign)
    {

        $user = $campaign->user; // pengelola

        $amount = $campaign->current_amount;

        if ($amount <= 0) {
            return back()->with('error', 'Dana kosong');
        }

        $reference = 'PAYOUT-' . Str::uuid();

        $response = Http::withBasicAuth(
            config('services.midtrans.server_key'),
            ''
        )->post(
            'https://api.sandbox.midtrans.com/v2/disbursement',
            [
                "bank" => $user->bank_name,
                "account" => $user->bank_account,
                "amount" => $amount,
                "remark" => "Payout campaign {$campaign->title}",
                "reference" => $reference
            ]
        );

        if ($response->successful()) {

            Payout::create([
                'campaign_id' => $campaign->id,
                'user_id' => $user->id,
                'amount' => $amount,
                'bank_name' => $user->bank_name,
                'bank_account' => $user->bank_account,
                'recipient_name' => $user->name,
                'reference' => $reference,
                'status' => 'processing'
            ]);

            return back()->with('success', 'Payout diproses');
        }

        return back()->with('error', 'Payout gagal');
    }
}
