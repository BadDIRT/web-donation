<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Payout;
use App\Models\User;
use App\Models\UserBank;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PayoutSeeder extends Seeder
{
    public function run(): void
    {
        $penggelolas = User::where('role', 'pengelola')->where('is_approved', true)->get();
        $campaigns = Campaign::where('status', 'approved')->where('current_amount', '>', 0)->get();

        if ($penggelolas->isEmpty() || $campaigns->isEmpty()) {
            $this->command->warn('⚠️ Tidak ada data yang diperlukan, skip PayoutSeeder');
            return;
        }

        $count = 0;

        foreach ($campaigns as $campaign) {
            // Buat 1-3 payout per campaign yang sudah ada dananya
            $numPayouts = rand(0, 3);
            $totalPayout = 0;

            for ($i = 0; $i < $numPayouts; $i++) {
                $maxAmount = $campaign->current_amount - $totalPayout;
                if ($maxAmount <= 0) break;

                $amount = rand(1, min(30, floor($maxAmount / 1000000))) * 1000000;
                if ($amount > $maxAmount) $amount = $maxAmount;

                if ($amount <= 0) break;

                $statuses = ['success', 'pending', 'failed'];
                $status = $i === 0 ? 'success' : $statuses[array_rand($statuses)];

                // Ambil user bank pengelola
                $userBank = UserBank::where('user_id', $campaign->user_id)->first();

                Payout::create([
                    'campaign_id' => $campaign->id,
                    'user_id' => $campaign->user_id,
                    'amount' => $amount,
                    'bank_name' => $userBank ? $userBank->bank->name : 'BCA',
                    'bank_account' => $userBank ? $userBank->account_number : '10987654321',
                    'bank_holder' => $campaign->user->name,
                    'reference_id' => 'PO-' . now()->format('Ymd') . '-' . Str::random(8),
                    'status' => $status,
                    'created_at' => now()->subDays(rand(1, 20)),
                ]);

                $totalPayout += $amount;
                $count++;
            }
        }

        $this->command->info("✅ Berhasil menambahkan {$count} payout");
    }
}
