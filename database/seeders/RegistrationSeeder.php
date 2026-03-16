<?php

namespace Database\Seeders;

use App\Models\Registration;
use App\Models\Room;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RegistrationSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan ada kamar dulu — seeder ini butuh minimal 10 kamar di tabel rooms.
        // Kalau belum ada, jalankan RoomSeeder terlebih dahulu:
        //   php artisan db:seed --class=RoomSeeder
        $rooms = Room::orderBy('room_number')->get();

        if ($rooms->isEmpty()) {
            $this->command->warn('Tabel rooms kosong. Jalankan RoomSeeder terlebih dahulu.');
            return;
        }

        // ── Data tamu ────────────────────────────────────────────────────────
        $guests = [
            // [0] Tamu menginap sekarang (WNI)
            [
                'name'               => 'Budi Santoso',
                'profession'         => 'Pegawai Negeri Sipil',
                'company'            => 'Kementerian Pendidikan',
                'nationality'        => 'WNI',
                'id_passport_number' => '3175041205890001',
                'birth_date'         => '1989-05-12',
                'address'            => 'Jl. Kebon Jeruk No. 45, RT.03/RW.07, Kebon Jeruk, Jakarta Barat 11530',
                'phone'              => '021-5367890',
                'mobile_phone'       => '081234567890',
                'email'              => 'budi.santoso@kemdikbud.go.id',
                'member_number'      => 'MBR-00123',
                'arrival_days_ago'   => 1,
                'stay_nights'        => 3,
                'receptionist'       => 'Sari Dewi',
                'payment_method'     => 'transfer',
                'payment_status'     => 'paid',
                'payment_amount'     => 1500000,
                'payment_reference'  => 'TRF-20260315-001',
                'payment_notes'      => 'Sudah lunas via BCA',
                'safety_deposit'     => 'SDB-001',
                'issued_by'          => 'Sari Dewi',
            ],

            // [1] Tamu menginap sekarang (WNA - Australia)
            [
                'name'               => 'James Mitchell',
                'profession'         => 'Business Consultant',
                'company'            => 'Mitchell & Co. Pty Ltd',
                'nationality'        => 'WNA - Australia',
                'id_passport_number' => 'PA1234567',
                'birth_date'         => '1985-03-22',
                'address'            => '12 Collins Street, Melbourne VIC 3000, Australia',
                'phone'              => null,
                'mobile_phone'       => '+61412345678',
                'email'              => 'james.mitchell@mitchellco.com.au',
                'member_number'      => null,
                'arrival_days_ago'   => 2,
                'stay_nights'        => 5,
                'receptionist'       => 'Ahmad Fauzi',
                'payment_method'     => 'credit_card',
                'payment_status'     => 'paid',
                'payment_amount'     => 3750000,
                'payment_reference'  => 'CC-VISA-20260314-002',
                'payment_notes'      => 'Visa Gold, disetujui',
                'safety_deposit'     => 'SDB-002',
                'issued_by'          => 'Ahmad Fauzi',
            ],

            // [2] Tamu menginap sekarang (WNI - pasangan)
            [
                'name'               => 'Rizki Ramadhan',
                'profession'         => 'Wirausaha',
                'company'            => 'CV Maju Bersama',
                'nationality'        => 'WNI',
                'id_passport_number' => '3271050809920003',
                'birth_date'         => '1992-09-08',
                'address'            => 'Jl. Sudirman Kav. 52-53, Senayan, Jakarta Selatan 12190',
                'phone'              => '021-5703456',
                'mobile_phone'       => '087654321098',
                'email'              => 'rizki.ramadhan@cvmajubersama.com',
                'member_number'      => 'MBR-00456',
                'arrival_days_ago'   => 0,
                'stay_nights'        => 2,
                'receptionist'       => 'Sari Dewi',
                'payment_method'     => 'qris',
                'payment_status'     => 'paid',
                'payment_amount'     => 900000,
                'payment_reference'  => null,
                'payment_notes'      => 'QRIS BCA Mobile',
                'safety_deposit'     => null,
                'issued_by'          => null,
                'number_of_persons'  => 2,
                'use_room2'          => true,
            ],

            // [3] Upcoming (besok)
            [
                'name'               => 'Siti Nurhaliza',
                'profession'         => 'Dokter',
                'company'            => 'RSUD Tarakan Jakarta',
                'nationality'        => 'WNI',
                'id_passport_number' => '3173046712880002',
                'birth_date'         => '1988-12-27',
                'address'            => 'Jl. Pluit Raya No. 10, RT.05/RW.03, Pluit, Penjaringan, Jakarta Utara 14440',
                'phone'              => '021-6912345',
                'mobile_phone'       => '082198765432',
                'email'              => 'dr.siti@rsudtarakan.go.id',
                'member_number'      => null,
                'arrival_days_ago'   => -1, // besok
                'stay_nights'        => 2,
                'receptionist'       => 'Ahmad Fauzi',
                'payment_method'     => 'cash',
                'payment_status'     => 'unpaid',
                'payment_amount'     => null,
                'payment_reference'  => null,
                'payment_notes'      => 'Bayar saat check-in',
                'safety_deposit'     => null,
                'issued_by'          => null,
            ],

            // [4] Upcoming (2 hari lagi)
            [
                'name'               => 'David Lim Wei Jian',
                'profession'         => 'Software Engineer',
                'company'            => 'Grab Holdings Pte Ltd',
                'nationality'        => 'WNA - Singapura',
                'id_passport_number' => 'S8801234A',
                'birth_date'         => '1988-06-14',
                'address'            => '1 Raffles Place, Singapore 048616',
                'phone'              => null,
                'mobile_phone'       => '+6591234567',
                'email'              => 'david.lim@grab.com',
                'member_number'      => null,
                'arrival_days_ago'   => -2,
                'stay_nights'        => 4,
                'receptionist'       => 'Rini Wulandari',
                'payment_method'     => 'credit_card',
                'payment_status'     => 'partial',
                'payment_amount'     => 1000000,
                'payment_reference'  => 'CC-MC-20260316-005',
                'payment_notes'      => 'DP 50%, sisa dibayar saat check-in',
                'safety_deposit'     => null,
                'issued_by'          => null,
            ],

            // [5] Sudah check-out (3 hari lalu)
            [
                'name'               => 'Hendra Kusuma',
                'profession'         => 'Manajer Pemasaran',
                'company'            => 'PT Unilever Indonesia',
                'nationality'        => 'WNI',
                'id_passport_number' => '3578021107800006',
                'birth_date'         => '1980-07-11',
                'address'            => 'Jl. Gatot Subroto Kav. 15, Kuningan, Jakarta Selatan 12940',
                'phone'              => '021-5229876',
                'mobile_phone'       => '081312345678',
                'email'              => 'hendra.kusuma@unilever.com',
                'member_number'      => 'MBR-00789',
                'arrival_days_ago'   => 5,
                'stay_nights'        => 2,
                'receptionist'       => 'Sari Dewi',
                'payment_method'     => 'debit_card',
                'payment_status'     => 'paid',
                'payment_amount'     => 800000,
                'payment_reference'  => 'DB-MANDIRI-20260311-006',
                'payment_notes'      => null,
                'safety_deposit'     => 'SDB-006',
                'issued_by'          => 'Sari Dewi',
            ],

            // [6] Sudah check-out (5 hari lalu)
            [
                'name'               => 'Yuki Tanaka',
                'profession'         => 'Fashion Designer',
                'company'            => 'Tanaka Design Studio',
                'nationality'        => 'WNA - Jepang',
                'id_passport_number' => 'TK9876543',
                'birth_date'         => '1993-11-03',
                'address'            => '3-1-2 Shibuya, Shibuya-ku, Tokyo 150-0002, Japan',
                'phone'              => null,
                'mobile_phone'       => '+818012345678',
                'email'              => 'yuki.tanaka@tanakastudio.jp',
                'member_number'      => null,
                'arrival_days_ago'   => 8,
                'stay_nights'        => 3,
                'receptionist'       => 'Rini Wulandari',
                'payment_method'     => 'gopay',
                'payment_status'     => 'paid',
                'payment_amount'     => 1200000,
                'payment_reference'  => null,
                'payment_notes'      => 'GoPay via aplikasi',
                'safety_deposit'     => null,
                'issued_by'          => null,
            ],

            // [7] Sudah check-out (seminggu lalu)
            [
                'name'               => 'Agus Prasetyo',
                'profession'         => 'Pengacara',
                'company'            => 'Kantor Hukum Prasetyo & Partners',
                'nationality'        => 'WNI',
                'id_passport_number' => '3171031508750008',
                'birth_date'         => '1975-08-15',
                'address'            => 'Jl. HR Rasuna Said Kav. X-7 No. 6, Kuningan, Jakarta Selatan 12950',
                'phone'              => '021-5227654',
                'mobile_phone'       => '081187654321',
                'email'              => 'agus.prasetyo@prasetyolaw.co.id',
                'member_number'      => 'MBR-00321',
                'arrival_days_ago'   => 10,
                'stay_nights'        => 3,
                'receptionist'       => 'Ahmad Fauzi',
                'payment_method'     => 'transfer',
                'payment_status'     => 'paid',
                'payment_amount'     => 2250000,
                'payment_reference'  => 'TRF-BNI-20260306-008',
                'payment_notes'      => null,
                'safety_deposit'     => 'SDB-008',
                'issued_by'          => 'Ahmad Fauzi',
            ],

            // [8] Sudah check-out, refunded
            [
                'name'               => 'Maria Santos',
                'profession'         => 'Journalist',
                'company'            => 'Reuters Asia Pacific',
                'nationality'        => 'WNA - Filipina',
                'id_passport_number' => 'AA1234567',
                'birth_date'         => '1990-04-25',
                'address'            => '3 Exchange Square, Central, Hong Kong',
                'phone'              => null,
                'mobile_phone'       => '+639171234567',
                'email'              => 'maria.santos@reuters.com',
                'member_number'      => null,
                'arrival_days_ago'   => 14,
                'stay_nights'        => 4,
                'receptionist'       => 'Rini Wulandari',
                'payment_method'     => 'credit_card',
                'payment_status'     => 'refunded',
                'payment_amount'     => 2800000,
                'payment_reference'  => 'CC-VISA-20260302-009',
                'payment_notes'      => 'Refund karena early check-out - dipotong 1 malam',
                'safety_deposit'     => null,
                'issued_by'          => null,
            ],

            // [9] Menginap sekarang, belum bayar (walk-in)
            [
                'name'               => 'Fajar Nugroho',
                'profession'         => 'Mahasiswa',
                'company'            => 'Universitas Indonesia',
                'nationality'        => 'WNI',
                'id_passport_number' => '3201012003020001',
                'birth_date'         => '2002-03-20',
                'address'            => 'Jl. Margonda Raya No. 100, Depok, Jawa Barat 16424',
                'phone'              => null,
                'mobile_phone'       => '089512345678',
                'email'              => 'fajar.nugroho@ui.ac.id',
                'member_number'      => null,
                'arrival_days_ago'   => 0,
                'stay_nights'        => 1,
                'receptionist'       => 'Sari Dewi',
                'payment_method'     => 'cash',
                'payment_status'     => 'unpaid',
                'payment_amount'     => null,
                'payment_reference'  => null,
                'payment_notes'      => 'Walk-in, bayar saat check-out',
                'safety_deposit'     => null,
                'issued_by'          => null,
            ],
        ];

        // ── Room types yang tersedia ─────────────────────────────────────────
        $roomTypes = ['Standard', 'Superior', 'Deluxe', 'Suite', 'Executive'];

        // Kumpulkan room yang sudah dipakai agar tidak dobel
        $usedRoomIds = [];
        $roomIndex   = 0;

        foreach ($guests as $i => $guest) {
            // Ambil kamar pertama
            while ($roomIndex < $rooms->count() && in_array($rooms[$roomIndex]->id, $usedRoomIds)) {
                $roomIndex++;
            }
            if ($roomIndex >= $rooms->count()) break;

            $room1 = $rooms[$roomIndex++];
            $usedRoomIds[] = $room1->id;

            // Kamar kedua (opsional)
            $room2 = null;
            if (!empty($guest['use_room2'])) {
                while ($roomIndex < $rooms->count() && in_array($rooms[$roomIndex]->id, $usedRoomIds)) {
                    $roomIndex++;
                }
                if ($roomIndex < $rooms->count()) {
                    $room2 = $rooms[$roomIndex++];
                    $usedRoomIds[] = $room2->id;
                }
            }

            // Hitung tanggal
            $arrivalDate   = Carbon::today()->subDays($guest['arrival_days_ago']);
            $departureDate = $arrivalDate->copy()->addDays($guest['stay_nights']);
            $arrivalTime   = $arrivalDate->copy()->setTime(rand(8, 22), rand(0, 59));

            // Hitung jumlah kamar & estimasi harga jika payment_amount null
            $numRooms = $room2 ? 2 : 1;
            $pricePerNight = ($room1->price_per_night ?? 400000)
                + ($room2 ? ($room2->price_per_night ?? 400000) : 0);
            $estimatedTotal = $pricePerNight * $guest['stay_nights'];

            $paymentAmount = $guest['payment_amount'];
            if ($paymentAmount === null && $guest['payment_status'] === 'paid') {
                $paymentAmount = $estimatedTotal;
            }

            Registration::create([
                'room_id_1'                 => $room1->id,
                'room_id_2'                 => $room2?->id,
                'number_of_persons'         => $guest['number_of_persons'] ?? 1,
                'number_of_rooms'           => $numRooms,
                'room_type'                 => $room1->room_type ?? $roomTypes[array_rand($roomTypes)],
                'receptionist'              => $guest['receptionist'],
                'name'                      => $guest['name'],
                'profession'                => $guest['profession'],
                'company'                   => $guest['company'],
                'nationality'               => $guest['nationality'],
                'id_passport_number'        => $guest['id_passport_number'],
                'birth_date'                => $guest['birth_date'],
                'address'                   => $guest['address'],
                'phone'                     => $guest['phone'],
                'mobile_phone'              => $guest['mobile_phone'],
                'email'                     => $guest['email'],
                'member_number'             => $guest['member_number'],
                'arrival_time'              => $arrivalTime,
                'arrival_date'              => $arrivalDate->toDateString(),
                'departure_date'            => $departureDate->toDateString(),
                'safety_deposit_box_number' => $guest['safety_deposit'],
                'issued_by'                 => $guest['issued_by'],
                'issued_date'               => $guest['safety_deposit'] ? $arrivalDate->toDateString() : null,
                'payment_method'            => $guest['payment_method'],
                'payment_status'            => $guest['payment_status'],
                'payment_amount'            => $paymentAmount,
                'payment_reference'         => $guest['payment_reference'],
                'payment_notes'             => $guest['payment_notes'],
            ]);
        }

        $this->command->info('✅ RegistrationSeeder selesai — ' . count($guests) . ' data registrasi ditambahkan.');
    }
}
