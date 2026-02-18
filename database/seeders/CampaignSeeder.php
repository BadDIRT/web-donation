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
                'article' => 'Masjid merupakan tempat ibadah yang sangat penting bagi umat Muslim. Di desa kami, banyak warga yang kesulitan untuk mendapatkan akses ke masjid yang layak. Oleh karena itu, kami menggalang dana untuk membangun sebuah masjid yang dapat digunakan oleh seluruh warga desa. Dengan adanya masjid ini, diharapkan dapat meningkatkan kualitas ibadah dan mempererat tali silaturahmi antar warga. Kami sangat berharap dukungan dari semua pihak untuk mewujudkan pembangunan masjid ini. Setiap donasi yang diberikan akan sangat berarti bagi kami dan akan digunakan secara transparan untuk membangun masjid yang layak bagi warga desa kami. Terima kasih atas dukungan dan partisipasi Anda dalam mewujudkan impian kami untuk memiliki masjid yang layak di desa kami. Semoga Allah SWT membalas kebaikan Anda dengan pahala yang berlipat ganda. Aamiin.',
                'category_id' => 6, // Agama
            ],
            [
                'user_id' => $pengelola->id,
                'title' => 'Bantuan Bencana Alam',
                'description' => 'Donasi untuk korban bencana alam di daerah kami.',
                'target_amount' => 100000000,
                'status' => 'approved',
                'article' => 'Bencana alam merupakan musibah yang tidak dapat diprediksi dan seringkali menyebabkan kerusakan yang besar serta kehilangan harta benda dan bahkan nyawa. Di daerah kami, baru-baru ini terjadi bencana alam yang mengakibatkan banyak warga kehilangan tempat tinggal, harta benda, dan sumber penghasilan mereka. Oleh karena itu, kami menggalang dana untuk membantu para korban bencana alam ini. Dana yang terkumpul akan digunakan untuk memberikan bantuan berupa makanan, pakaian, obat-obatan, serta bantuan keuangan untuk membantu mereka memulai kembali kehidupan mereka setelah bencana. Kami sangat berharap dukungan dari semua pihak untuk membantu para korban bencana alam ini. Setiap donasi yang diberikan akan sangat berarti bagi mereka yang sedang mengalami kesulitan akibat bencana ini. Terima kasih atas dukungan dan partisipasi Anda dalam membantu para korban bencana alam di daerah kami. Semoga Allah SWT membalas kebaikan Anda dengan pahala yang berlipat ganda. Aamiin.',
                'category_id' => 13, // Bencana Alam
            ],
            [
                'user_id' => $pengelola->id,
                'title' => 'Pendidikan Anak Kurang Mampu',
                'description' => 'Bantuan biaya pendidikan untuk anak-anak kurang mampu.',
                'target_amount' => 75000000,
                'status' => 'approved',
                'article' => 'Pendidikan merupakan hak dasar setiap anak, namun sayangnya masih banyak anak-anak kurang mampu yang kesulitan untuk mendapatkan akses pendidikan yang layak. Oleh karena itu, kami menggalang dana untuk membantu biaya pendidikan bagi anak-anak kurang mampu di daerah kami. Dana yang terkumpul akan digunakan untuk membayar biaya sekolah, membeli perlengkapan sekolah, serta memberikan beasiswa bagi anak-anak yang berprestasi namun tidak mampu secara finansial. Kami sangat berharap dukungan dari semua pihak untuk membantu anak-anak kurang mampu ini mendapatkan pendidikan yang layak. Setiap donasi yang diberikan akan sangat berarti bagi mereka yang sedang berjuang untuk mendapatkan pendidikan. Terima kasih atas dukungan dan partisipasi Anda dalam membantu anak-anak kurang mampu mendapatkan pendidikan yang layak di daerah kami. Semoga Allah SWT membalas kebaikan Anda dengan pahala yang berlipat ganda. Aamiin.',
                'category_id' => 1, // Pendidikan
            ],
            [
                'user_id' => $pengelola->id,
                'title' => 'Bantuan Kesehatan Masyarakat',
                'description' => 'Penggalangan dana untuk fasilitas kesehatan masyarakat.',
                'target_amount' => 60000000,
                'status' => 'approved',
                'article' => 'Kesehatan merupakan salah satu aspek penting dalam kehidupan manusia. Namun, masih banyak masyarakat yang kesulitan untuk mendapatkan akses ke fasilitas kesehatan yang memadai. Oleh karena itu, kami menggalang dana untuk membantu fasilitas kesehatan masyarakat di daerah kami. Dana yang terkumpul akan digunakan untuk memperbaiki dan meningkatkan fasilitas kesehatan yang ada, serta memberikan bantuan medis bagi mereka yang membutuhkan. Kami sangat berharap dukungan dari semua pihak untuk membantu meningkatkan fasilitas kesehatan masyarakat di daerah kami. Setiap donasi yang diberikan akan sangat berarti bagi mereka yang sedang mengalami kesulitan dalam mendapatkan akses ke fasilitas kesehatan. Terima kasih atas dukungan dan partisipasi Anda dalam membantu meningkatkan fasilitas kesehatan masyarakat di daerah kami. Semoga Allah SWT membalas kebaikan Anda dengan pahala yang berlipat ganda. Aamiin.',
                'category_id' => 2, // Kesehatan
            ],
            [
                'user_id' => $pengelola->id,
                'title' => 'Bantuan Hewan Ternak',
                'description' => 'Donasi untuk peternak yang kehilangan hewan ternak akibat bencana.',
                'target_amount' => 30000000,
                'status' => 'approved',
                'article' => 'Hewan ternak merupakan sumber penghasilan utama bagi banyak peternak di daerah kami. Namun, baru-baru ini terjadi bencana yang mengakibatkan banyak peternak kehilangan hewan ternak mereka, yang berdampak besar pada kehidupan mereka. Oleh karena itu, kami menggalang dana untuk membantu para peternak yang kehilangan hewan ternak akibat bencana ini. Dana yang terkumpul akan digunakan untuk memberikan bantuan berupa hewan ternak baru, pakan, serta bantuan keuangan untuk membantu mereka memulai kembali usaha peternakan mereka. Kami sangat berharap dukungan dari semua pihak untuk membantu para peternak yang sedang mengalami kesulitan akibat kehilangan hewan ternak ini. Setiap donasi yang diberikan akan sangat berarti bagi mereka yang sedang berjuang untuk memulai kembali usaha peternakan mereka setelah bencana ini. Terima kasih atas dukungan dan partisipasi Anda dalam membantu para peternak yang kehilangan hewan ternak akibat bencana di daerah kami. Semoga Allah SWT membalas kebaikan Anda dengan pahala yang berlipat ganda. Aamiin.',
                'category_id' => 7, // Hewan
            ],
            [
                'user_id' => $pengelola->id,
                'title' => 'Bantuan untuk Panti Asuhan',
                'description' => 'Penggalangan dana untuk kebutuhan panti asuhan di kota kami.',
                'target_amount' => 40000000,
                'status' => 'approved',
                'article' => 'Panti asuhan merupakan tempat yang sangat penting bagi anak-anak yatim piatu dan anak-anak yang tidak memiliki keluarga. Namun, masih banyak panti asuhan yang kurang mampu dalam memenuhi kebutuhan dasar anak-anak di dalamnya. Oleh karena itu, kami menggalang dana untuk membantu kebutuhan panti asuhan di kota kami. Dana yang terkumpul akan digunakan untuk membeli perlengkapan panti asuhan, memperbaiki fasilitas, serta memberikan bantuan keuangan bagi anak-anak yatim piatu. Kami sangat berharap dukungan dari semua pihak untuk membantu anak-anak yatim piatu ini mendapatkan lingkungan yang aman dan nyaman. Setiap donasi yang diberikan akan sangat berarti bagi mereka yang sedang berjuang untuk mendapatkan kebutuhan dasar mereka. Terima kasih atas dukungan dan partisipasi Anda dalam membantu anak-anak yatim piatu di daerah kami. Semoga Allah SWT membalas kebaikan Anda dengan pahala yang berlipat ganda. Aamiin.',
                'category_id' => 1, // Pendidikan
            ],
            [
                'user_id' => $pengelola->id,
                'title' => 'Bantuan untuk Lansia',
                'description' => 'Donasi untuk kebutuhan lansia yang kurang mampu.',
                'target_amount' => 35000000,
                'status' => 'approved',
                'article' => 'Lansia merupakan kelompok masyarakat yang membutuhkan perhatian khusus, terutama dalam hal kesehatan dan kebutuhan sehari-hari. Namun, masih banyak lansia yang kesulitan untuk memenuhi kebutuhan dasar mereka karena kurangnya dukungan dari masyarakat. Oleh karena itu, kami menggalang dana untuk membantu lansia yang kurang mampu di daerah kami. Dana yang terkumpul akan digunakan untuk memberikan bantuan berupa kebutuhan sehari-hari, perawatan kesehatan, serta bantuan keuangan bagi mereka yang membutuhkan. Kami sangat berharap dukungan dari semua pihak untuk membantu lansia yang sedang mengalami kesulitan dalam memenuhi kebutuhan dasar mereka. Terima kasih atas dukungan dan partisipasi Anda dalam membantu lansia di daerah kami. Semoga Allah SWT membalas kebaikan Anda dengan pahala yang berlipat ganda. Aamiin.',
                'category_id' => 5, // Kemanusiaan
            ],
            [
                'user_id' => $pengelola->id,
                'title' => 'Bantuan untuk Penderita Penyakit Kronis',
                'description' => 'Penggalangan dana untuk membantu penderita penyakit kronis yang membutuhkan perawatan intensif.',
                'target_amount' => 80000000,
                'status' => 'approved',
                'article' => 'Penderita penyakit kronis seringkali membutuhkan perawatan intensif yang memerlukan biaya yang cukup besar. Namun, masih banyak penderita penyakit kronis yang kesulitan untuk mendapatkan perawatan yang mereka butuhkan karena keterbatasan finansial. Oleh karena itu, kami menggalang dana untuk membantu penderita penyakit kronis yang membutuhkan perawatan intensif di daerah kami. Dana yang terkumpul akan digunakan untuk membayar biaya perawatan, membeli obat-obatan, serta memberikan bantuan keuangan bagi mereka yang membutuhkan. Kami sangat berharap dukungan dari semua pihak untuk membantu penderita penyakit kronis ini mendapatkan perawatan yang layak. Setiap donasi yang diberikan akan sangat berarti bagi mereka yang sedang berjuang untuk mendapatkan perawatan yang mereka butuhkan. Terima kasih atas dukungan dan partisipasi Anda dalam membantu penderita penyakit kronis di daerah kami. Semoga Allah SWT membalas kebaikan Anda dengan pahala yang berlipat ganda. Aamiin.',
                'category_id' => 2, // Kesehatan
            ],
            [
                'user_id' => $pengelola->id,
                'title' => 'Bantuan untuk Pendidikan Anak Yatim',
                'description' => 'Donasi untuk biaya pendidikan anak-anak yatim piatu.',
                'target_amount' => 45000000,
                'status' => 'approved',
                'article' => 'Anak-anak yatim piatu seringkali menghadapi banyak tantangan dalam mendapatkan pendidikan yang layak. Oleh karena itu, kami menggalang dana untuk membantu biaya pendidikan anak-anak yatim piatu di daerah kami. Dana yang terkumpul akan digunakan untuk membayar biaya sekolah, membeli perlengkapan sekolah, serta memberikan beasiswa bagi anak-anak yatim piatu yang berprestasi namun tidak mampu secara finansial. Kami sangat berharap dukungan dari semua pihak untuk membantu anak-anak yatim piatu ini mendapatkan pendidikan yang layak. Setiap donasi yang diberikan akan sangat berarti bagi mereka yang sedang berjuang untuk mendapatkan pendidikan. Terima kasih atas dukungan dan partisipasi Anda dalam membantu anak-anak yatim piatu mendapatkan pendidikan yang layak di daerah kami. Semoga Allah SWT membalas kebaikan Anda dengan pahala yang berlipat ganda. Aamiin.',
                'category_id' => 1, // Pendidikan
            ],
            [
                'user_id' => $pengelola->id,
                'title' => 'Bantuan untuk Korban Kekerasan',
                'description' => 'Penggalangan dana untuk membantu korban kekerasan yang membutuhkan perlindungan dan rehabilitasi.',
                'target_amount' => 55000000,
                'status' => 'approved',
                'article' => 'Korban kekerasan seringkali membutuhkan perlindungan dan rehabilitasi untuk memulihkan diri dari trauma yang mereka alami. Namun, masih banyak korban kekerasan yang kesulitan untuk mendapatkan bantuan yang mereka butuhkan karena keterbatasan finansial. Oleh karena itu, kami menggalang dana untuk membantu korban kekerasan yang membutuhkan perlindungan dan rehabilitasi di daerah kami. Dana yang terkumpul akan digunakan untuk memberikan bantuan berupa perlindungan, perawatan kesehatan, serta bantuan keuangan bagi mereka yang membutuhkan. Kami sangat berharap dukungan dari semua pihak untuk membantu korban kekerasan ini mendapatkan perlindungan dan rehabilitasi yang layak. Setiap donasi yang diberikan akan sangat berarti bagi mereka yang sedang berjuang untuk memulihkan diri dari trauma akibat kekerasan. Terima kasih atas dukungan dan partisipasi Anda dalam membantu korban kekerasan di daerah kami. Semoga Allah SWT membalas kebaikan Anda dengan pahala yang berlipat ganda. Aamiin.',
                'category_id' => 5, // Kemanusiaan
            ],
            [
                'user_id' => $pengelola->id,
                'title' => 'Bantuan untuk Pembangunan Sekolah',
                'description' => 'Donasi untuk pembangunan sekolah di daerah terpencil.',
                'target_amount' => 90000000,
                'status' => 'approved',
                'article' => 'Pendidikan merupakan hak dasar setiap anak, namun sayangnya masih banyak anak-anak di daerah terpencil yang kesulitan untuk mendapatkan akses pendidikan yang layak. Oleh karena itu, kami menggalang dana untuk membantu pembangunan sekolah di daerah terpencil. Dana yang terkumpul akan digunakan untuk membangun fasilitas sekolah, membeli perlengkapan sekolah, serta memberikan bantuan keuangan bagi anak-anak yang berprestasi namun tidak mampu secara finansial. Kami sangat berharap dukungan dari semua pihak untuk membantu anak-anak di daerah terpencil mendapatkan pendidikan yang layak. Setiap donasi yang diberikan akan sangat berarti bagi mereka yang sedang berjuang untuk mendapatkan pendidikan. Terima kasih atas dukungan dan partisipasi Anda dalam membantu pembangunan sekolah di daerah terpencil. Semoga Allah SWT membalas kebaikan Anda dengan pahala yang berlipat ganda. Aamiin.',
                'category_id' => 1, // Pendidikan
            ]
        ]);

        Campaign::create([
            'user_id' => $pengelola->id,
            'title' => 'Santunan Anak Yatim',
            'description' => 'Donasi untuk anak yatim piatu.',
            'target_amount' => 25000000,
            'status' => 'pending',
            'article' => 'Anak-anak yatim piatu seringkali menghadapi banyak tantangan dalam mendapatkan kebutuhan dasar mereka. Oleh karena itu, kami menggalang dana untuk memberikan santunan kepada anak-anak yatim piatu di daerah kami. Dana yang terkumpul akan digunakan untuk memberikan bantuan berupa kebutuhan sehari-hari, pendidikan, serta bantuan keuangan bagi mereka yang membutuhkan. Kami sangat berharap dukungan dari semua pihak untuk membantu anak-anak yatim piatu ini mendapatkan kehidupan yang layak. Setiap donasi yang diberikan akan sangat berarti bagi mereka yang sedang berjuang untuk mendapatkan kebutuhan dasar mereka. Terima kasih atas dukungan dan partisipasi Anda dalam membantu anak-anak yatim piatu di daerah kami. Semoga Allah SWT membalas kebaikan Anda dengan pahala yang berlipat ganda. Aamiin.',
            'category_id' => 1, // Pendidikan
        ]);
    }
}
