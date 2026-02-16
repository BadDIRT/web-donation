<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pengelola = User::where('role', 'pengelola')
            ->where('is_approved', true)
            ->first();

        if (! $pengelola) {
            return;
        }

        Campaign::insert([
            [
            'user_id' => $pengelola->id,
            'title' => 'Bantu Pembangunan Masjid',
            'description' => 'Penggalangan dana untuk pembangunan masjid desa.',
            'target_amount' => 50000000,
            'status' => 'approved',
            ],
            [
            'user_id' => $pengelola->id,
            'title' => 'Bantuan Bencana Alam',
            'description' => 'Donasi untuk korban bencana alam di daerah kami.',
            'target_amount' => 100000000,
            'status' => 'approved',
            ],
             [
            'user_id' => $pengelola->id,
            'title' => 'Pendidikan Anak Kurang Mampu',
            'description' => 'Bantuan biaya pendidikan untuk anak-anak kurang mampu.',
            'target_amount' => 75000000,
            'status' => 'approved',
            ],
             [
            'user_id' => $pengelola->id,
            'title' => 'Bantuan Kesehatan Masyarakat',
            'description' => 'Penggalangan dana untuk fasilitas kesehatan masyarakat.',
            'target_amount' => 60000000,
            'status' => 'approved',
            ],
            [
            'user_id' => $pengelola->id,
            'title' => 'Bantuan Hewan Ternak',
            'description' => 'Donasi untuk peternak yang kehilangan hewan ternak akibat bencana.',
            'target_amount' => 30000000,
            'status' => 'approved',
            ]
        ]);

        Campaign::create([
            'user_id' => $pengelola->id,
            'title' => 'Santunan Anak Yatim',
            'description' => 'Donasi untuk anak yatim piatu.',
            'target_amount' => 25000000,
            'status' => 'pending',
        ]);
    }
}
