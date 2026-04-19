<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\User;
use App\Models\UserBank;
use App\Models\Withdraw;
use Illuminate\Database\Seeder;

class WithdrawSeeder extends Seeder
{
    public function run(): void
    {
        $penggelolas = User::where('role', 'pengelola')->where('is_approved', true)->get();
        $campaigns = Campaign::where('status', 'approved')->where('current_amount', '>', 5000000)->get();

        if ($penggelolas->isEmpty() || $campaigns->isEmpty()) {
            $this->command->warn('⚠️ Tidak ada data yang diperlukan, skip WithdrawSeeder');
            return;
        }

        $descriptions = [
            'Dana untuk pembelian material bangunan tahap 1',
            'Biaya operasional program selama 1 bulan',
            'Pembayaran honor tenaga ahli',
            'Distribusi bantuan langsung ke penerima manfaat',
            'Biaya transportasi dan logistik',
            'Pembelian perlengkapan medis',
            'Biaya sewa alat berat',
            'Pembayaran kontraktor',
            'Dana darurat untuk kebutuhan mendesak',
            'Biaya dokumentasi dan publikasi',
        ];

        $count = 0;

        foreach ($campaigns->take(10) as $campaign) {
            $numWithdraws = rand(0, 2);

            for ($i = 0; $i < $numWithdraws; $i++) {
                $userBank = UserBank::where('user_id', $campaign->user_id)->first();

                if (!$userBank) continue;

                $amount = rand(1, 20) * 1000000;
                if ($amount > $campaign->current_amount) {
                    $amount = $campaign->current_amount;
                }

                if ($amount <= 0) continue;

                $statuses = ['pending', 'approved', 'rejected'];
                $statusWeights = [2, 5, 1]; // lebih banyak approved
                $status = $this->weightedRandom($statuses, $statusWeights);

                Withdraw::create([
                    'bank_id' => $userBank->bank_id,
                    'user_id' => $campaign->user_id,
                    'campaign_id' => $campaign->id,
                    'user_bank_id' => $userBank->id,
                    'amount' => $amount,
                    'transfer_proof' => $status !== 'pending' ? 'withdraw/proof_' . rand(1, 100) . '.jpg' : null,
                    'description' => $descriptions[array_rand($descriptions)],
                    'status' => $status,
                    'created_at' => now()->subDays(rand(1, 15)),
                ]);

                $count++;
            }
        }

        $this->command->info("✅ Berhasil menambahkan {$count} withdraw");
    }

    private function weightedRandom($items, $weights)
    {
        $total = array_sum($weights);
        $rand = mt_rand(1, $total);

        foreach ($items as $i => $item) {
            $rand -= $weights[$i];
            if ($rand <= 0) {
                return $item;
            }
        }

        return $items[0];
    }
}
