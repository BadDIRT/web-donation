<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    public function run(): void
    {
        $banks = [
            'BCA', 'BRI', 'BNI', 'Mandiri', 'CIMB', 'BTN', 'BSI'
        ];

        foreach ($banks as $bank) {
            Bank::firstOrCreate(['name' => $bank]);
        }
    }
}
