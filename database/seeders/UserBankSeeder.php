<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\User;
use App\Models\UserBank;
use Illuminate\Database\Seeder;

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

        if ($banks->isEmpty()) {
            $this->command->warn('⚠️ Banks table kosong, skip UserBankSeeder');
            return;
        }

        $count = 0;

        foreach ($users as $user) {
            $randomCount = min($banks->count(), rand(1, 3));
            $randomBanks = $banks->random($randomCount);

            foreach ($randomBanks as $index => $bank) {
                $exists = UserBank::where('user_id', $user->id)
                    ->where('bank_id', $bank->id)
                    ->exists();

                if (!$exists) {
                    UserBank::create([
                        'user_id' => $user->id,
                        'bank_id' => $bank->id,
                        'account_number' => $this->generateAccountNumber($bank->name),
                        'is_primary' => $index === 0,
                    ]);
                    $count++;
                }
            }
        }

        // Tambahkan bank untuk beberapa donatur juga
        $donaturs = User::where('role', 'donatur')->take(10)->get();
        foreach ($donaturs as $donatur) {
            $bank = $banks->random();
            $exists = UserBank::where('user_id', $donatur->id)
                ->where('bank_id', $bank->id)
                ->exists();

            if (!$exists) {
                UserBank::create([
                    'user_id' => $donatur->id,
                    'bank_id' => $bank->id,
                    'account_number' => $this->generateAccountNumber($bank->name),
                    'is_primary' => true,
                ]);
                $count++;
            }
        }

        $this->command->info("✅ Berhasil menambahkan {$count} rekening bank");
    }

    private function generateAccountNumber($bankName)
    {
        $prefixes = [
            'BCA' => '10',
            'BRI' => '20',
            'BNI' => '30',
            'Mandiri' => '40',
            'BSI' => '45',
            'CIMB' => '50',
            'Danamon' => '60',
        ];

        $prefix = $prefixes[$bankName] ?? rand(10, 99);

        return $prefix . rand(10000000, 99999999);
    }
}
