<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Bank;
use App\Models\UserBank;

class UserBankSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where(function ($query) {
            $query->where('role', 'admin')
                ->orWhere(function ($q) {
                    $q->where('role', 'pengelola')
                        ->where('is_approved', true);
                });
        })->get();

        $banks = Bank::all();

        // 🔒 Guard biar gak error
        if ($banks->isEmpty()) {
            $this->command->warn('⚠️ Banks table kosong, skip UserBankSeeder');
            return;
        }

        foreach ($users as $user) {

            // max random = jumlah bank yang tersedia
            $randomCount = min($banks->count(), rand(1, 3));
            $randomBanks = $banks->random($randomCount);

            foreach ($randomBanks as $index => $bank) {
                UserBank::create([
                    'user_id' => $user->id,
                    'bank_id' => $bank->id,
                    'account_number' => $this->generateAccountNumber(),
                    'balance' => rand(50000, 1000000),
                    'is_primary' => $index === 0,
                ]);
            }
        }
    }

    private function generateAccountNumber()
    {
        return '10' . rand(10000000, 99999999);
    }
}
