<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CampaignSeeder extends Seeder
{
    public function run(): void
    {
        $penggelolas = User::where('role', 'pengelola')
            ->where('is_approved', true)
            ->get();

        if ($penggelolas->isEmpty()) {
            $this->command->warn('⚠️ Tidak ada pengelola approved, skip CampaignSeeder');
            return;
        }

        $campaignsData = [
            // ========== PENGELOLA 1 ==========
            [
                'title' => 'Bantu Pembangunan Masjid',
                'description' => 'Penggalangan dana untuk pembangunan masjid desa.',
                'target_amount' => 50000000,
                'status' => 'approved',
                'category_slug' => 'agama',
                'image' => 'https://images.unsplash.com/photo-1585036156171-384164a8c696?w=800',
                'current_amount' => 15000000,
                'days_ago' => 10,
                'article' => 'Masjid merupakan tempat ibadah yang sangat penting bagi umat Muslim. Di desa kami, banyak warga yang kesulitan untuk mendapatkan akses ke masjid yang layak. Oleh karena itu, kami menggalang dana untuk membangun sebuah masjid yang dapat digunakan oleh seluruh warga desa. Dengan adanya masjid ini, diharapkan dapat meningkatkan kualitas ibadah dan mempererat tali silaturahmi antar warga. Kami sangat berharap dukungan dari semua pihak untuk mewujudkan pembangunan masjid ini. Setiap donasi yang diberikan akan sangat berarti bagi kami dan akan digunakan secara transparan untuk membangun masjid yang layak bagi warga desa kami. Terima kasih atas dukungan dan partisipasi Anda dalam mewujudkan impian kami untuk memiliki masjid yang layak di desa kami. Semoga Allah SWT membalas kebaikan Anda dengan pahala yang berlipat ganda. Aamiin.',
            ],
            [
                'title' => 'Bantuan Bencana Alam Cianjur',
                'description' => 'Donasi untuk korban gempa bumi di Cianjur.',
                'target_amount' => 100000000,
                'status' => 'approved',
                'category_slug' => 'bencana-alam',
                'image' => 'https://images.unsplash.com/photo-1469521669194-babb45599def?w=800',
                'current_amount' => 50000000,
                'days_ago' => 5,
                'article' => 'Gempa bumi yang melanda Cianjur telah menyebabkan kerusakan yang besar serta kehilangan harta benda dan nyawa. Banyak warga kehilangan tempat tinggal dan sumber penghasilan mereka. Dana yang terkumpul akan digunakan untuk memberikan bantuan berupa makanan, pakaian, obat-obatan, serta bantuan keuangan untuk membantu mereka memulai kembali kehidupan mereka setelah bencana.',
            ],
            [
                'title' => 'Pendidikan Anak Kurang Mampu',
                'description' => 'Bantuan biaya pendidikan untuk anak-anak kurang mampu.',
                'target_amount' => 75000000,
                'status' => 'approved',
                'category_slug' => 'pendidikan',
                'image' => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=800',
                'current_amount' => 30000000,
                'days_ago' => 3,
                'article' => 'Pendidikan merupakan hak dasar setiap anak, namun sayangnya masih banyak anak-anak kurang mampu yang kesulitan untuk mendapatkan akses pendidikan yang layak. Dana yang terkumpul akan digunakan untuk membayar biaya sekolah, membeli perlengkapan sekolah, serta memberikan beasiswa bagi anak-anak yang berprestasi namun tidak mampu secara finansial.',
            ],
            [
                'title' => 'Bantuan Kesehatan Masyarakat',
                'description' => 'Penggalangan dana untuk fasilitas kesehatan masyarakat.',
                'target_amount' => 60000000,
                'status' => 'approved',
                'category_slug' => 'kesehatan',
                'image' => 'https://images.unsplash.com/photo-1631815588090-d4bfec5b1ccb?w=800',
                'current_amount' => 20000000,
                'days_ago' => 1,
                'article' => 'Kesehatan merupakan salah satu aspek penting dalam kehidupan manusia. Masih banyak masyarakat yang kesulitan untuk mendapatkan akses ke fasilitas kesehatan yang memadai. Dana yang terkumpul akan digunakan untuk memperbaiki dan meningkatkan fasilitas kesehatan yang ada, serta memberikan bantuan medis bagi mereka yang membutuhkan.',
            ],
            [
                'title' => 'Santunan Anak Yatim',
                'description' => 'Donasi untuk anak yatim piatu.',
                'target_amount' => 25000000,
                'status' => 'pending',
                'category_slug' => 'kemanusiaan',
                'image' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=800',
                'current_amount' => 0,
                'days_ago' => 12,
                'article' => 'Anak-anak yatim piatu seringkali menghadapi banyak tantangan dalam mendapatkan kebutuhan dasar mereka. Dana yang terkumpul akan digunakan untuk memberikan bantuan berupa kebutuhan sehari-hari, pendidikan, serta bantuan keuangan bagi mereka yang membutuhkan.',
            ],
            // ========== PENGELOLA 2 ==========
            [
                'title' => 'Bantuan Hewan Ternak Terdampak Erupsi',
                'description' => 'Donasi untuk peternak yang kehilangan hewan ternak akibat erupsi gunung.',
                'target_amount' => 30000000,
                'status' => 'approved',
                'category_slug' => 'hewan',
                'image' => 'https://images.unsplash.com/photo-1500595046743-cd271d694d30?w=800',
                'current_amount' => 10000000,
                'days_ago' => 2,
                'article' => 'Hewan ternak merupakan sumber penghasilan utama bagi banyak peternak di daerah kami. Erupsi gunung mengakibatkan banyak peternak kehilangan hewan ternak mereka. Dana yang terkumpul akan digunakan untuk memberikan bantuan berupa hewan ternak baru, pakan, serta bantuan keuangan.',
            ],
            [
                'title' => 'Bantuan untuk Panti Asuhan Kasih Ibu',
                'description' => 'Penggalangan dana untuk kebutuhan panti asuhan.',
                'target_amount' => 40000000,
                'status' => 'approved',
                'category_slug' => 'sosial',
                'image' => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=800',
                'current_amount' => 25000000,
                'days_ago' => 4,
                'article' => 'Panti asuhan merupakan tempat yang sangat penting bagi anak-anak yatim piatu. Dana yang terkumpul akan digunakan untuk membeli perlengkapan panti asuhan, memperbaiki fasilitas, serta memberikan bantuan keuangan bagi anak-anak yatim piatu.',
            ],
            [
                'title' => 'Program Penghijauan Hutan Mangrove',
                'description' => 'Menanam 10.000 pohon mangrove untuk menyelamatkan pesisir.',
                'target_amount' => 45000000,
                'status' => 'approved',
                'category_slug' => 'lingkungan',
                'image' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=800',
                'current_amount' => 18000000,
                'days_ago' => 7,
                'article' => 'Hutan mangrove merupakan ekosistem penting yang melindungi pesisir dari abrasi dan badai. Program ini bertujuan untuk menanam 10.000 pohon mangrove di kawasan pesisir yang mengalami kerusakan. Dana akan digunakan untuk pembibitan, penanaman, dan perawatan pohon.',
            ],
            [
                'title' => 'Renovasi Mushola Al-Ikhlas',
                'description' => 'Renovasi mushola yang sudah tidak layak pakai.',
                'target_amount' => 35000000,
                'status' => 'rejected',
                'category_slug' => 'agama',
                'image' => 'https://images.unsplash.com/photo-1564769625905-50e93615e769?w=800',
                'current_amount' => 0,
                'days_ago' => 15,
                'article' => 'Mushola Al-Ikhlas sudah berdiri sejak 30 tahun lalu dan kondisinya sangat memprihatinkan. Atap bocor, dinding retak, dan lantai yang sudah tidak rata. Kami berencana untuk merenovasi secara total agar bisa digunakan dengan nyaman oleh jamaah.',
            ],
            // ========== PENGELOLA 3 ==========
            [
                'title' => 'Bantuan untuk Lansia Terlantar',
                'description' => 'Donasi untuk kebutuhan lansia yang kurang mampu.',
                'target_amount' => 35000000,
                'status' => 'approved',
                'category_slug' => 'kemanusiaan',
                'image' => 'https://images.unsplash.com/photo-1576765608535-5f04d1e3f289?w=800',
                'current_amount' => 15000000,
                'days_ago' => 6,
                'article' => 'Lansia merupakan kelompok masyarakat yang membutuhkan perhatian khusus. Dana yang terkumpul akan digunakan untuk memberikan bantuan berupa kebutuhan sehari-hari, perawatan kesehatan, serta bantuan keuangan bagi mereka yang membutuhkan.',
            ],
            [
                'title' => 'Biaya Operasi Bayi dengan Jantung Bocor',
                'description' => 'Penggalangan dana untuk operasi bayi penderita jantung bocor.',
                'target_amount' => 80000000,
                'status' => 'approved',
                'category_slug' => 'kesehatan',
                'image' => 'https://images.unsplash.com/photo-1585435557343-3b092031a831?w=800',
                'current_amount' => 40000000,
                'days_ago' => 7,
                'article' => 'Bayi Aqila (4 bulan) didiagnosa menderita jantung bocor sejak lahir. Dia membutuhkan operasi segera untuk menyelamatkan nyawanya. Kedua orang tuanya bekerja sebagai buruh harian dan tidak mampu membiayai operasi yang membutuhkan biaya sekitar 80 juta rupiah.',
            ],
            [
                'title' => 'Beasiswa untuk Anak Daerah Terpencil',
                'description' => 'Donasi untuk biaya pendidikan anak-anak di daerah terpencil Papua.',
                'target_amount' => 45000000,
                'status' => 'approved',
                'category_slug' => 'pendidikan',
                'image' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=800',
                'current_amount' => 35000000,
                'days_ago' => 8,
                'article' => 'Anak-anak di daerah terpencil Papua sangat ingin mendapatkan pendidikan yang layak. Namun akses ke sekolah yang memadai sangat sulit. Dana ini akan digunakan untuk menyediakan beasiswa, perlengkapan sekolah, dan biaya transportasi.',
            ],
            [
                'title' => 'Bantuan untuk Korban Kekerasan Domestik',
                'description' => 'Penggalangan dana untuk membantu korban kekerasan.',
                'target_amount' => 55000000,
                'status' => 'approved',
                'category_slug' => 'kemanusiaan',
                'image' => 'https://images.unsplash.com/photo-1581579438747-104c53d7fbc4?w=800',
                'current_amount' => 25000000,
                'days_ago' => 9,
                'article' => 'Korban kekerasan domestik membutuhkan perlindungan dan rehabilitasi untuk memulihkan diri dari trauma. Dana yang terkumpul akan digunakan untuk memberikan bantuan berupa perlindungan, perawatan kesehatan, serta bantuan keuangan.',
            ],
            // ========== PENGELOLA 4 ==========
            [
                'title' => 'Pembangunan Sekolah Dasar di Pedalaman',
                'description' => 'Donasi untuk pembangunan sekolah di daerah terpencil Kalimantan.',
                'target_amount' => 90000000,
                'status' => 'approved',
                'category_slug' => 'pendidikan',
                'image' => 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=800',
                'current_amount' => 60000000,
                'days_ago' => 11,
                'article' => 'Anak-anak di pedalaman Kalimantan harus menempuh perjalanan berjam-jam untuk mencapai sekolah terdekat. Kami ingin membangun sebuah sekolah dasar yang layak agar anak-anak bisa mendapatkan pendidikan tanpa harus meninggalkan kampung mereka.',
            ],
            [
                'title' => 'Bantuan Air Bersih untuk Desa Kering',
                'description' => 'Pembangunan sumur bor untuk desa yang kekurangan air bersih.',
                'target_amount' => 65000000,
                'status' => 'approved',
                'category_slug' => 'lingkungan',
                'image' => 'https://images.unsplash.com/photo-1541544181051-e46607bc22a5?w=800',
                'current_amount' => 42000000,
                'days_ago' => 13,
                'article' => 'Desa Mekar Sari di NTB sudah bertahun-tahun mengalami krisis air bersih, terutama pada musim kemarau. Warga harus berjalan 3 km untuk mendapatkan air. Kami berencana membangun 5 sumur bor yang dapat melayani seluruh warga desa.',
            ],
            [
                'title' => 'Pelatihan UMKM Digital',
                'description' => 'Program pelatihan digital marketing untuk UMKM kecil.',
                'target_amount' => 30000000,
                'status' => 'pending',
                'category_slug' => 'ekonomi',
                'image' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=800',
                'current_amount' => 0,
                'days_ago' => 2,
                'article' => 'Pandemi telah mengubah cara kita berbisnis. Banyak UMKM kecil yang tertinggal karena tidak menguasai teknologi digital. Program ini akan melatih 100 pelaku UMKM dalam digital marketing, e-commerce, dan manajemen keuangan.',
            ],
            // ========== PENGELOLA 5 ==========
            [
                'title' => 'Penyelamatan Penyu di Pantai Selatan',
                'description' => 'Program konservasi penyu dan penanganan tukik.',
                'target_amount' => 28000000,
                'status' => 'approved',
                'category_slug' => 'hewan',
                'image' => 'https://images.unsplash.com/photo-1534918865907-0c7c935b0e3b?w=800',
                'current_amount' => 12000000,
                'days_ago' => 14,
                'article' => 'Populasi penyu di pantai selatan Jawa semakin menurun akibat perburuan liar dan hilangnya habitat. Program ini bertujuan untuk menyelamatkan telur penyu, merawat tukik, dan melepasliarkan kembali ke laut.',
            ],
            [
                'title' => 'Festival Seni Budaya Nusantara',
                'description' => 'Penyelenggaraan festival untuk melestarikan budaya daerah.',
                'target_amount' => 50000000,
                'status' => 'approved',
                'category_slug' => 'seni-dan-budaya',
                'image' => 'https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?w=800',
                'current_amount' => 28000000,
                'days_ago' => 6,
                'article' => 'Budaya daerah Nusantara semakin terpinggirkan oleh arus globalisasi. Festival ini akan menampilkan berbagai seni budaya dari 34 provinsi di Indonesia, termasuk tarian, musik tradisional, dan kerajinan tangan.',
            ],
            [
                'title' => 'Bantuan Lapangan Olahraga Desa',
                'description' => 'Pembangunan lapangan olahraga multifungsi untuk pemuda desa.',
                'target_amount' => 40000000,
                'status' => 'approved',
                'category_slug' => 'olahraga',
                'image' => 'https://images.unsplash.com/photo-1461896836934-bd45ba8a0c15?w=800',
                'current_amount' => 15000000,
                'days_ago' => 9,
                'article' => 'Pemuda desa sangat membutuhkan fasilitas olahraga yang layak. Lapangan ini akan digunakan untuk berbagai kegiatan olahraga seperti futsal, bola voli, dan basket. Selain untuk olahraga, lapangan ini juga akan digunakan untuk kegiatan sosial kemasyarakatan.',
            ],
            [
                'title' => 'Bantuan Korban Banjir Bandang',
                'description' => 'Donasi darurat untuk korban banjir bandang di Sumatra Barat.',
                'target_amount' => 120000000,
                'status' => 'closed',
                'category_slug' => 'bencana-alam',
                'image' => 'https://images.unsplash.com/photo-1547683905-f686c993aae5?w=800',
                'current_amount' => 95000000,
                'days_ago' => 30,
                'article' => 'Banjir bandang yang melanda Sumatra Barat telah menyebabkan kerusakan parah. Ratusan rumah hancur dan ribuan warga mengungsi. Dana yang terkumpul telah disalurkan untuk bantuan darurat dan akan dilanjutkan untuk rehabilitasi.',
            ],
            [
                'title' => 'Pengadaan Komputer untuk Sekolah',
                'description' => 'Pengadaan 20 unit komputer untuk laboratorium sekolah.',
                'target_amount' => 55000000,
                'status' => 'ended',
                'category_slug' => 'teknologi',
                'image' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=800',
                'current_amount' => 55000000,
                'days_ago' => 45,
                'article' => 'Sekolah Dasar Negeri 5 Sukamaju belum memiliki laboratorium komputer. Siswa-siswi belum pernah menggunakan komputer sama sekali. Program ini berhasil mengumpulkan dana untuk pengadaan 20 unit komputer yang kini telah digunakan oleh siswa.',
            ],
        ];

        $categoryMap = [];
        foreach (\App\Models\Category::all() as $cat) {
            $categoryMap[$cat->slug] = $cat->id;
        }

        foreach ($campaignsData as $index => $data) {
            $pengelola = $penggelolas[$index % $penggelolas->count()];

            Campaign::firstOrCreate(
                ['slug' => Str::slug($data['title'])],
                [
                    'user_id' => $pengelola->id,
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'article' => $data['article'],
                    'target_amount' => $data['target_amount'],
                    'current_amount' => $data['current_amount'],
                    'status' => $data['status'],
                    'category_id' => $categoryMap[$data['category_slug']] ?? null,
                    'image' => $data['image'],
                    'created_at' => now()->subDays($data['days_ago']),
                ]
            );
        }
    }
}
