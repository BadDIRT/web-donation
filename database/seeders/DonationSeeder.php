<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DonationSeeder extends Seeder
{
    public function run(): void
    {
        $donaturs = User::where('role', 'donatur')->get();
        $campaigns = Campaign::where('status', 'approved')->get();

        if ($donaturs->isEmpty() || $campaigns->isEmpty()) {
            $this->command->warn('⚠️ Tidak ada donatur atau campaign, skip DonationSeeder');
            return;
        }

        $messages = [
            'Semoga bermanfaat!',
            'Semoga cepat terkumpul!',
            'Semoga sukses!',
            'Bantu semampunya',
            'Semoga menjadi amal jariyah',
            'Sedikit untuk berbagi',
            'Semoga Allah membalas kebaikan kalian',
            'Inspirasi sekali campaign-nya',
            'Terus semangat!',
            'Barakallahu fiikum',
            'Semoga lekas capai target',
            'Happy to help!',
            'Kebagian rezeki nih',
            'Sinergi untuk kebaikan',
            null,
            null,
            null,
            null,
            null,
        ];

        $donations = [];
        $orderCount = 0;

        foreach ($campaigns as $campaign) {
            // Hitung berapa donasi yang sudah ada untuk campaign ini
            $existingTotal = Donation::where('campaign_id', $campaign->id)
                ->where('status', 'success')
                ->sum('amount');

            $targetDonations = rand(5, 25);
            $remainingAmount = $campaign->current_amount - $existingTotal;

            if ($remainingAmount <= 0) {
                continue;
            }

            for ($i = 0; $i < $targetDonations; $i++) {
                $orderCount++;
                $donatur = $donaturs->random();
                $isAnonymous = (bool) rand(0, 3); // 25% anonymous
                $status = rand(0, 10) < 8 ? 'success' : (rand(0, 1) ? 'pending' : 'failed');
                $amount = min(
                    $remainingAmount,
                    rand(1, 50) * 10000 // 10.000 - 500.000
                );

                if ($amount <= 0) continue;

                $remainingAmount -= $amount;

                $donations[] = [
                    'user_id' => $donatur->id,
                    'campaign_id' => $campaign->id,
                    'order_id' => 'ORDER-' . now()->format('Ymd') . '-' . str_pad($orderCount, 6, '0', STR_PAD_LEFT) . Str::random(3),
                    'amount' => $amount,
                    'donor_name' => $isAnonymous ? null : $donatur->name,
                    'anonymous' => $isAnonymous,
                    'message' => $messages[array_rand($messages)],
                    'status' => $status,
                    'paid_at' => $status === 'success' ? now()->subDays(rand(0, 10)) : null,
                    'created_at' => now()->subDays(rand(0, 10)),
                    'updated_at' => now(),
                ];
            }
        }

        // Insert dalam chunks untuk menghindari memory issues
        foreach (array_chunk($donations, 500) as $chunk) {
            Donation::insert($chunk);
        }

        $this->command->info('✅ Berhasil menambahkan ' . count($donations) . ' donasi');
    }
}
