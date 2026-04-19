<?php

namespace Database\Seeders;

use App\Models\CampaignUpdate;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $updates = CampaignUpdate::all();
        $users = User::where('role', 'donatur')->get();

        if ($updates->isEmpty()) {
            $this->command->warn('⚠️ Tidak ada campaign update, skip CommentSeeder');
            return;
        }

        $comments = [
            'Semangat terus!',
            'Barakallahu fiikum',
            'MasyaAllah, sangat menginspirasi',
            'Semoga program ini berhasil',
            'Terima kasih sudah berbagi',
            'Saya senang bisa membantu',
            'Semoga dana cepat terkumpul',
            'Jangan lupa update terus ya',
            'Laporan yang sangat transparan',
            'Bangga bisa jadi bagian dari ini',
            'Semoga Allah membalas kebaikan semua donatur',
            'Keep up the good work!',
            'Sungguh menyentuh hati',
            'Semoga penerima manfaat diberi kesabaran',
            'Keren banget programnya',
            'Mudah-mudahan lancar sampai akhir',
            'Ini yang namanya bergerak bersama',
            'Semoga jadi amal jariyah',
            'Very inspiring campaign!',
            'Patut diapresiasi',
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
        ];

        $count = 0;

        foreach ($updates as $update) {
            $numComments = rand(0, 8);

            for ($i = 0; $i < $numComments; $i++) {
                $user = $users->isNotEmpty() ? (rand(0, 2) === 0 ? $users->random() : null) : null;
                $content = $comments[array_rand($comments)];

                if (!$content) continue;

                Comment::create([
                    'campaign_update_id' => $update->id,
                    'user_id' => $user?->id,
                    'name' => $user ? null : $this->generateRandomName(),
                    'content' => $content,
                    'created_at' => $update->created_at->addHours(rand(1, 72)),
                ]);
                $count++;
            }
        }

        $this->command->info("✅ Berhasil menambahkan {$count} komentar");
    }

    private function generateRandomName()
    {
        $firstNames = ['Ahmad', 'Budi', 'Citra', 'Dewi', 'Eka', 'Fajar', 'Gita', 'Hadi', 'Ika', 'Joko', 'Kartika', 'Lina', 'Maya', 'Nurul', 'Omar', 'Putri', 'Qori', 'Rina', 'Sari', 'Tono', 'Umi', 'Vina', 'Wati', 'Xena', 'Yuni', 'Zahra'];
        $lastNames = ['Pratama', 'Sari', 'Wijaya', 'Lestari', 'Santoso', 'Permana', 'Hidayat', 'Nugroho', 'Safitri', 'Kurniawan', 'Anggraeni', 'Setiawan', 'Marlina', 'Hermawan', 'Yuliani', 'Saputra', 'Maharani', 'Arya', 'Permata', 'Putri'];

        return $firstNames[array_rand($firstNames)] . ' ' . $lastNames[array_rand($lastNames)];
    }
}
