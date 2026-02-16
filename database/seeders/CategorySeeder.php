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
        Category::create([
            ['name' => 'Pendidikan', 'slug' => 'pendidikan'],
            ['name' => 'Kesehatan', 'slug' => 'kesehatan'],
            ['name' => 'Lingkungan', 'slug' => 'lingkungan'],
            ['name' => 'Sosial', 'slug' => 'sosial'],
            ['name' => 'Kemanusiaan', 'slug' => 'kemanusiaan'],
        ]);
    }
}
