<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\CampaignUpdate;
use App\Models\User;
use Illuminate\Database\Seeder;

class CampaignUpdateSeeder extends Seeder
{
    public function run(): void
    {
        $campaigns = Campaign::where('status', 'approved')->get();

        if ($campaigns->isEmpty()) {
            $this->command->warn('⚠️ Tidak ada campaign approved, skip CampaignUpdateSeeder');
            return;
        }

        $updateTemplates = [
            [
                'title' => 'Laporan Pertama',
                'contents' => [
                    'Alhamdulillah, pada hari ini kami telah memulai proses distribusi bantuan. Kami berhasil menjangkau 20 keluarga yang membutuhkan. Terima kasih atas dukungan semua donatur.',
                    'Kami ingin menyampaikan laporan pertama mengenai penggunaan dana yang telah terkumpul. Saat ini kami sedang dalam tahap persiapan dan akan segera memulai pelaksanaan program.',
                    'Puji syukur, tahap pertama program telah berjalan dengan baik. Kami berhasil mengumpulkan seluruh penerima manfaat dan akan segera memulai distribusi.',
                ],
                'image' => 'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?w=800',
            ],
            [
                'title' => 'Proses Berjalan',
                'contents' => [
                    'Proses pembangunan saat ini telah mencapai 40%. Tim kami bekerja keras setiap hari untuk memastikan target tercapai tepat waktu. Berikut dokumentasi terbaru kami.',
                    'Alhamdulillah, distribusi bantuan tahap kedua telah selesai. Total 50 keluarga telah menerima bantuan. Kami akan melanjutkan ke tahap berikutnya.',
                    'Program berjalan sesuai rencana. Saat ini kami telah berhasil membantu 75% dari target penerima manfaat. Berikut beberapa foto kegiatan kami.',
                ],
                'image' => 'https://images.unsplash.com/photo-1497486751825-1233686d5d80?w=800',
            ],
            [
                'title' => 'Laporan Keuangan',
                'contents' => [
                    'Berikut kami sampaikan laporan keuangan sementara:\n\nTotal dana masuk: Rp XX.XXX.XXX\nDana terpakai: Rp XX.XXX.XXX\nSisa dana: Rp XX.XXX.XXX\n\nRincian penggunaan dana akan kami lampirkan dalam laporan lengkap.',
                    'Transparansi adalah prioritas kami. Berikut laporan penggunaan dana yang telah diverifikasi:\n\n1. Pembelian material: Rp X.XXX.XXX\n2. Biaya operasional: Rp X.XXX.XXX\n3. Honor tenaga kerja: Rp X.XXX.XXX',
                    'Kami ingin memastikan semua donatur mengetahui bagaimana donasi mereka digunakan. Berikut ringkasan penggunaan dana hingga saat ini.',
                ],
                'image' => null,
            ],
            [
                'title' => 'Dokumentasi Kegiatan',
                'contents' => [
                    'Berikut dokumentasi kegiatan yang telah kami lakukan. Semoga dengan adanya dokumentasi ini, para donatur bisa melihat langsung dampak dari donasi yang diberikan.',
                    'Kami mengabadikan momen-momen berharga selama pelaksanaan program. Terima kasih kepada semua pihak yang telah berpartisipasi.',
                    'Foto-foto berikut menunjukkan kondisi sebelum dan sesudah program berjalan. Perubahan yang terjadi sangat signifikan berkat dukungan para donatur.',
                ],
                'image' => 'https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=800',
            ],
            [
                'title' => 'Ucapan Terima Kasih',
                'contents' => [
                    'Kami mengucapkan terima kasih yang sebesar-besarnya kepada seluruh donatur yang telah berpartisipasi. Tanpa dukungan kalian, program ini tidak akan berjalan dengan baik. Semoga Allah membalas kebaikan kalian.',
                    'Program ini telah selesai dengan baik. Ini semua berkat dukungan dan doa dari para donatur. Kami tidak bisa mengucapkan terima kasih yang cukup, tapi kami berharap amal baik kalian diterima.',
                    'Menutup program ini dengan rasa syukur. Terima kasih atas kepercayaan yang diberikan. Kami berharap bisa terus berkolaborasi di program-program selanjutnya.',
                ],
                'image' => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=800',
            ],
        ];

        $count = 0;

        foreach ($campaigns as $campaign) {
            // Campaign yang baru dibuat mungkin belum ada update
            $daysSinceCreated = now()->diffInDays($campaign->created_at);
            $numUpdates = min(count($updateTemplates), max(1, floor($daysSinceCreated / 3)));

            for ($i = 0; $i < $numUpdates; $i++) {
                $template = $updateTemplates[$i];
                $content = $template['contents'][array_rand($template['contents'])];

                CampaignUpdate::firstOrCreate(
                    [
                        'campaign_id' => $campaign->id,
                        'title' => $template['title'],
                    ],
                    [
                        'content' => $content,
                        'image' => $template['image'],
                        'created_at' => $campaign->created_at->addDays(($i + 1) * 2),
                    ]
                );
                $count++;
            }
        }

        $this->command->info("✅ Berhasil menambahkan {$count} campaign updates");
    }
}
