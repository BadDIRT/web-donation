<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Payout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PayoutController extends Controller
{
    public function store(Request $request, Campaign $campaign)
    {
        $request->validate([
            'amount' => 'required|integer|min:10000'
        ]);

        $balance = $campaign->available_balance;

        if ($request->amount > $balance) {
            return back()->with('error','Saldo tidak mencukupi');
        }

        $user = $campaign->user;

        $referenceId = 'PAYOUT-' . Str::uuid();

        $response = Http::withBasicAuth(
            config('services.midtrans.server_key'),
            ''
        )->post('https://api.sandbox.midtrans.com/v2/disbursement', [

            "reference" => $referenceId,
            "amount" => $request->amount,
            "bank_code" => $user->bank_name,
            "account_number" => $user->bank_account,
            "beneficiary_name" => $user->name,
            "remark" => "Payout campaign {$campaign->title}"

        ]);

        $result = $response->json();

        Payout::create([
            'campaign_id' => $campaign->id,
            'user_id' => $user->id,
            'amount' => $request->amount,
            'bank_name' => $user->bank_name,
            'bank_account' => $user->bank_account,
            'bank_holder' => $user->name,
            'reference_id' => $referenceId,
            'status' => $result['status'] == 'success' ? 'success' : 'pending'
        ]);

        return back()->with('success','Payout diproses');
    }
}