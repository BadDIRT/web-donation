<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            ['name' => 'Pendidikan', 'slug' => 'pendidikan'],
            ['name' => 'Kesehatan', 'slug' => 'kesehatan'],
            ['name' => 'Lingkungan', 'slug' => 'lingkungan'],
            ['name' => 'Sosial', 'slug' => 'sosial'],
            ['name' => 'Kemanusiaan', 'slug' => 'kemanusiaan'],
            ['name' => 'Agama', 'slug' => 'agama'],
            ['name' => 'Hewan', 'slug' => 'hewan'],
            ['name' => 'Teknologi', 'slug' => 'teknologi'],
            ['name' => 'Seni dan Budaya', 'slug' => 'seni-dan-budaya'],
            ['name' => 'Olahraga', 'slug' => 'olahraga'],
            ['name' => 'Ekonomi', 'slug' => 'ekonomi'],
            ['name' => 'Lainnya', 'slug' => 'lainnya'],
            ['name' => 'Bencana Alam', 'slug' => 'bencana-alam'],
        ]);
    }
}
