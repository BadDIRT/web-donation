<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ==================== ADMIN ====================
        $admins = [
            [
                'name' => 'Admin Utama',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'is_approved' => true,
                'phone' => '081234567890',
            ],
            [
                'name' => 'Admin Keuangan',
                'email' => 'admin.keuangan@example.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'is_approved' => true,
                'phone' => '081234567891',
            ],
        ];

        foreach ($admins as $admin) {
            User::firstOrCreate(['email' => $admin['email']], $admin);
        }

        // ==================== PENGELOLA APPROVED ====================
        $pengelolaApproved = [
            [
                'name' => 'Yayasan Berkah Nusantara',
                'email' => 'pengelola@example.com',
                'password' => Hash::make('pengelola123'),
                'role' => 'pengelola',
                'is_approved' => true,
                'phone' => '081234567892',
                'ktp_path' => 'ktp/yayasan_berkah.jpg',
            ],
            [
                'name' => 'Lembaga Peduli Sesama',
                'email' => 'pengelola2@example.com',
                'password' => Hash::make('pengelola123'),
                'role' => 'pengelola',
                'is_approved' => true,
                'phone' => '081234567893',
                'ktp_path' => 'ktp/peduli_sesama.jpg',
            ],
            [
                'name' => 'Komunitas Saling Bantu',
                'email' => 'pengelola3@example.com',
                'password' => Hash::make('pengelola123'),
                'role' => 'pengelola',
                'is_approved' => true,
                'phone' => '081234567894',
                'ktp_path' => 'ktp/saling_bantu.jpg',
            ],
            [
                'name' => 'Yayasan Harapan Bangsa',
                'email' => 'pengelola4@example.com',
                'password' => Hash::make('pengelola123'),
                'role' => 'pengelola',
                'is_approved' => true,
                'phone' => '081234567895',
                'ktp_path' => 'ktp/harapan_bangsa.jpg',
            ],
            [
                'name' => 'Forum Peduli Lingkungan',
                'email' => 'pengelola5@example.com',
                'password' => Hash::make('pengelola123'),
                'role' => 'pengelola',
                'is_approved' => true,
                'phone' => '081234567896',
                'ktp_path' => 'ktp/peduli_lingkungan.jpg',
            ],
        ];

        foreach ($pengelolaApproved as $pengelola) {
            User::firstOrCreate(['email' => $pengelola['email']], $pengelola);
        }

        // ==================== PENGELOLA PENDING ====================
        $pengelolaPending = [
            [
                'name' => 'Pengelola Pending 1',
                'email' => 'pengelola_pending@example.com',
                'password' => Hash::make('pengelola_pending123'),
                'role' => 'pengelola',
                'is_approved' => false,
                'phone' => '081234567897',
                'ktp_path' => 'ktp/pending1.jpg',
            ],
            [
                'name' => 'Pengelola Pending 2',
                'email' => 'pengelola_pending2@example.com',
                'password' => Hash::make('pengelola_pending123'),
                'role' => 'pengelola',
                'is_approved' => false,
                'phone' => '081234567898',
                'ktp_path' => 'ktp/pending2.jpg',
            ],
            [
                'name' => 'Pengelola Pending 3',
                'email' => 'pengelola_pending3@example.com',
                'password' => Hash::make('pengelola_pending123'),
                'role' => 'pengelola',
                'is_approved' => false,
                'phone' => '081234567899',
            ],
        ];

        foreach ($pengelolaPending as $pengelola) {
            User::firstOrCreate(['email' => $pengelola['email']], $pengelola);
        }

        // ==================== DONATUR ====================
        $donaturs = [
            ['name' => 'Ahmad Fauzi', 'email' => 'donatur@example.com', 'phone' => '082111111001'],
            ['name' => 'Siti Rahma', 'email' => 'donatur2@example.com', 'phone' => '082111111002'],
            ['name' => 'Budi Santoso', 'email' => 'donatur3@example.com', 'phone' => '082111111003'],
            ['name' => 'Dewi Lestari', 'email' => 'donatur4@example.com', 'phone' => '082111111004'],
            ['name' => 'Rizky Pratama', 'email' => 'donatur5@example.com', 'phone' => '082111111005'],
            ['name' => 'Nurul Hidayah', 'email' => 'donatur6@example.com', 'phone' => '082111111006'],
            ['name' => 'Hendra Wijaya', 'email' => 'donatur7@example.com', 'phone' => '082111111007'],
            ['name' => 'Putri Amelia', 'email' => 'donatur8@example.com', 'phone' => '082111111008'],
            ['name' => 'Yusuf Maulana', 'email' => 'donatur9@example.com', 'phone' => '082111111009'],
            ['name' => 'Rina Safitri', 'email' => 'donatur10@example.com', 'phone' => '082111111010'],
            ['name' => 'Agus Setiawan', 'email' => 'donatur11@example.com', 'phone' => '082111111011'],
            ['name' => 'Maya Anggraeni', 'email' => 'donatur12@example.com', 'phone' => '082111111012'],
            ['name' => 'Fajar Nugroho', 'email' => 'donatur13@example.com', 'phone' => '082111111013'],
            ['name' => 'Lina Marlina', 'email' => 'donatur14@example.com', 'phone' => '082111111014'],
            ['name' => 'Dian Permana', 'email' => 'donatur15@example.com', 'phone' => '082111111015'],
            ['name' => 'Rudi Hermawan', 'email' => 'donatur16@example.com', 'phone' => '082111111016'],
            ['name' => 'Ani Yuliani', 'email' => 'donatur17@example.com', 'phone' => '082111111017'],
            ['name' => 'Bayu Saputra', 'email' => 'donatur18@example.com', 'phone' => '082111111018'],
            ['name' => 'Citra Maharani', 'email' => 'donatur19@example.com', 'phone' => '082111111019'],
            ['name' => 'Dimas Arya', 'email' => 'donatur20@example.com', 'phone' => '082111111020'],
            ['name' => 'Eka Putri', 'email' => 'donatur21@example.com', 'phone' => '082111111021'],
            ['name' => 'Firman Hidayat', 'email' => 'donatur22@example.com', 'phone' => '082111111022'],
            ['name' => 'Gita Nuraini', 'email' => 'donatur23@example.com', 'phone' => '082111111023'],
            ['name' => 'Hadi Kurniawan', 'email' => 'donatur24@example.com', 'phone' => '082111111024'],
            ['name' => 'Indah Permata', 'email' => 'donatur25@example.com', 'phone' => '082111111025'],
        ];

        foreach ($donaturs as $donatur) {
            User::firstOrCreate(
                ['email' => $donatur['email']],
                array_merge($donatur, [
                    'password' => Hash::make('donatur123'),
                    'role' => 'donatur',
                ])
            );
        }
    }
}
