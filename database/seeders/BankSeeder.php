<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banks = ['BCA', 'BRI', 'BNI', 'Mandiri', 'CIMB', 'BTN', 'BSI'];

        foreach ($banks as $bank) {
            Bank::create([
                'name' => $bank
            ]);
        }
    }
}
