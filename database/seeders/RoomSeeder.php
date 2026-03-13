<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $floors  = [6, 7, 8, 9, 10];
        $types   = ['Standard', 'Superior', 'Deluxe', 'Suite', 'Executive'];
        $prices  = [350000, 450000, 600000, 900000, 1200000];

        $rooms = [];

        foreach ($floors as $fi => $floor) {
            $type  = $types[$fi];
            $price = $prices[$fi];
            for ($i = 1; $i <= 10; $i++) {
                $rooms[] = [
                    'room_number'    => str_pad($floor * 100 + $i, 4, '0', STR_PAD_LEFT),
                    'room_type'      => $type,
                    'floor'          => $floor,
                    'capacity'       => in_array($type, ['Suite', 'Executive']) ? 4 : 2,
                    'price_per_night' => $price,
                    'status'         => 'available',
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ];
            }
        }

        DB::table('rooms')->insert($rooms);
    }
}
