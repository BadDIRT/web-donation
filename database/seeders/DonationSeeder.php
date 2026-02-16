<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $donatur = User::where('role', 'donatur')->first();
        $campaign = Campaign::where('status', 'approved')->first();

        if (! $donatur || ! $campaign) {
            return;
        }

        Donation::insert([
            [
            'user_id' => $donatur->id,
            'campaign_id' => $campaign->id,
            'midtrans_order_id' => 'ORDER-' . uniqid(),
            'amount' => 100000,
            'status' => 'success',
            ],
            [
            'user_id' => $donatur->id,
            'campaign_id' => $campaign->id,
            'midtrans_order_id' => 'ORDER-' . uniqid(),
            'amount' => 200000,
            'status' => 'pending',
            ],
            [
            'user_id' => $donatur->id,
            'campaign_id' => $campaign->id,
            'midtrans_order_id' => 'ORDER-' . uniqid(),
            'amount' => 150000,
            'status' => 'failed',
            ],
            [
            'user_id' => $donatur->id,
            'campaign_id' => $campaign->id,
            'midtrans_order_id' => 'ORDER-' . uniqid(),
            'amount' => 250000,
            'status' => 'success',
            ]
        ]);
    }
}
