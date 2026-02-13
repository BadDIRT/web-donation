<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        $donation = Donation::where(
            'midtrans_order_id',
            $request->order_id
        )->first();

        if (!$donation) return response()->json(['message'=>'Not found']);

        if ($request->transaction_status == 'settlement') {

            $donation->update(['status'=>'success']);

            $donation->campaign->increment(
                'collected_amount',
                $donation->amount
            );
        }

        return response()->json(['message'=>'OK']);
    }
}
