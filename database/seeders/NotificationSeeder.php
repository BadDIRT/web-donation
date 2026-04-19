<?php

namespace Database\Seeders;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $admins = User::where('role', 'admin')->get();
        $penggelolas = User::where('role', 'pengelola')->where('is_approved', true)->get();
        $donaturs = User::where('role', 'donatur')->get();

        if ($users->isEmpty()) {
            $this->command->warn('⚠️ Tidak ada user, skip NotificationSeeder');
            return;
        }

        $notifications = [];

        // ==================== NOTIFIKASI UNTUK ADMIN ====================
        $adminNotifications = [
            [
                'title' => 'Pengajuan Pengelola Baru',
                'message' => '{actor_name} mengajukan permohonan menjadi pengelola.',
                'type' => 'pengelola_request',
                'actor_role' => 'pengelola_pending',
            ],
            [
                'title' => 'Campaign Baru Menunggu Persetujuan',
                'message' => 'Campaign "{meta_title}" menunggu review Anda.',
                'type' => 'campaign_pending',
                'actor_role' => 'pengelola',
            ],
            [
                'title' => 'Permintaan Penarikan Dana Baru',
                'message' => '{actor_name} mengajukan penarikan dana sebesar Rp {meta_amount}.',
                'type' => 'withdraw_request',
                'actor_role' => 'pengelola',
            ],
            [
                'title' => 'Donasi Berhasil',
                'message' => 'Donasi sebesar Rp {meta_amount} berhasil dari {actor_name} untuk campaign "{meta_title}".',
                'type' => 'donation_success',
                'actor_role' => 'donatur',
            ],
        ];

        foreach ($admins as $admin) {
            // 5-10 notifikasi untuk setiap admin
            for ($i = 0; $i < rand(5, 10); $i++) {
                $notif = $adminNotifications[array_rand($adminNotifications)];
                $actor = $this->getActor($notif['actor_role'], $penggelolas, $donaturs);

                if (!$actor) continue;

                $notifications[] = [
                    'user_id' => $admin->id,
                    'actor_id' => $actor->id,
                    'title' => $notif['title'],
                    'message' => $this->parseMessage($notif['message'], $actor, null),
                    'type' => $notif['type'],
                    'meta' => null,
                    'is_read' => (bool) rand(0, 1),
                    'created_at' => now()->subDays(rand(0, 30)),
                ];
            }
        }

        // ==================== NOTIFIKASI UNTUK PENGELOLA ====================
        $pengelolaNotifications = [
            [
                'title' => 'Pengajuan Disetujui',
                'message' => 'Selamat! Pengajuan Anda sebagai pengelola telah disetujui.',
                'type' => 'pengelola_approved',
                'actor_role' => 'admin',
            ],
            [
                'title' => 'Campaign Disetujui',
                'message' => 'Campaign "{meta_title}" Anda telah disetujui dan dapat menerima donasi.',
                'type' => 'campaign_approved',
                'actor_role' => 'admin',
            ],
            [
                'title' => 'Campaign Ditolak',
                'message' => 'Campaign "{meta_title}" Anda ditolak. Silakan periksa kembali dan ajukan ulang.',
                'type' => 'campaign_rejected',
                'actor_role' => 'admin',
            ],
            [
                'title' => 'Donasi Masuk',
                'message' => '{actor_name} mendonasikan Rp {meta_amount} untuk campaign Anda.',
                'type' => 'donation_received',
                'actor_role' => 'donatur',
            ],
            [
                'title' => 'Penarikan Dana Disetujui',
                'message' => 'Penarikan dana sebesar Rp {meta_amount} telah disetujui dan sedang diproses.',
                'type' => 'withdraw_approved',
                'actor_role' => 'admin',
            ],
            [
                'title' => 'Penarikan Dana Ditolak',
                'message' => 'Penarikan dana sebesar Rp {meta_amount} ditolak. Silakan hubungi admin.',
                'type' => 'withdraw_rejected',
                'actor_role' => 'admin',
            ],
            [
                'title' => 'Komentar Baru',
                'message' => '{actor_name} berkomentar pada update campaign Anda.',
                'type' => 'new_comment',
                'actor_role' => 'donatur',
            ],
        ];

        foreach ($penggelolas as $pengelola) {
            for ($i = 0; $i < rand(8, 15); $i++) {
                $notif = $pengelolaNotifications[array_rand($pengelolaNotifications)];
                $actor = $this->getActor($notif['actor_role'], $admins, $donaturs);

                if (!$actor) continue;

                $notifications[] = [
                    'user_id' => $pengelola->id,
                    'actor_id' => $actor->id,
                    'title' => $notif['title'],
                    'message' => $this->parseMessage($notif['message'], $actor, ['amount' => rand(50, 500) * 10000]),
                    'type' => $notif['type'],
                    'meta' => null,
                    'is_read' => (bool) rand(0, 2),
                    'created_at' => now()->subDays(rand(0, 30)),
                ];
            }
        }

        // ==================== NOTIFIKASI UNTUK DONATUR ====================
        $donaturNotifications = [
            [
                'title' => 'Donasi Berhasil',
                'message' => 'Donasi Anda sebesar Rp {meta_amount} untuk campaign "{meta_title}" berhasil.',
                'type' => 'donation_success',
                'actor_role' => null,
            ],
            [
                'title' => 'Update Campaign',
                'message' => 'Ada update baru dari campaign "{meta_title}" yang Anda donasi.',
                'type' => 'campaign_update',
                'actor_role' => 'pengelola',
            ],
            [
                'title' => 'Pengajuan Pengelola Ditolak',
                'message' => 'Maaf, pengajuan Anda sebagai pengelola ditolak.',
                'type' => 'pengelola_rejected',
                'actor_role' => 'admin',
            ],
            [
                'title' => 'Donasi Gagal',
                'message' => 'Donasi Anda sebesar Rp {meta_amount} gagal diproses. Silakan coba lagi.',
                'type' => 'donation_failed',
                'actor_role' => null,
            ],
        ];

        foreach ($donaturs as $donatur) {
            for ($i = 0; $i < rand(3, 8); $i++) {
                $notif = $donaturNotifications[array_rand($donaturNotifications)];
                $actor = $notif['actor_role'] ? $this->getActor($notif['actor_role'], $admins, $penggelolas) : null;

                $notifications[] = [
                    'user_id' => $donatur->id,
                    'actor_id' => $actor?->id,
                    'title' => $notif['title'],
                    'message' => $this->parseMessage($notif['message'], $actor, ['amount' => rand(10, 200) * 10000]),
                    'type' => $notif['type'],
                    'meta' => null,
                    'is_read' => (bool) rand(0, 1),
                    'created_at' => now()->subDays(rand(0, 30)),
                ];
            }
        }

        // Insert dalam chunks
        foreach (array_chunk($notifications, 500) as $chunk) {
            Notification::insert($chunk);
        }

        $this->command->info('✅ Berhasil menambahkan ' . count($notifications) . ' notifikasi');
    }

    private function getActor($role, $pool1, $pool2)
    {
        if ($role === 'admin') {
            return $pool1->isNotEmpty() ? $pool1->random() : null;
        } elseif ($role === 'pengelola') {
            return $pool1->isNotEmpty() ? $pool1->random() : null;
        } elseif ($role === 'pengelola_pending') {
            $pending = User::where('role', 'pengelola')->where('is_approved', false)->first();
            return $pending;
        } elseif ($role === 'donatur') {
            return $pool2->isNotEmpty() ? $pool2->random() : null;
        }
        return null;
    }

    private function parseMessage($message, $actor, $meta)
    {
        $message = str_replace('{actor_name}', $actor?->name ?? 'Seseorang', $message);
        $message = str_replace('{meta_amount}', $meta ? 'Rp ' . number_format($meta['amount'], 0, ',', '.') : 'Rp 0', $message);
        $message = str_replace('{meta_title}', 'Campaign Contoh', $message);

        return $message;
    }
}
