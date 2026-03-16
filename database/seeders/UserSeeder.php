<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name'     => 'Admin PPKD',
                'email'    => 'admin@ppkdhotel.com',
                'password' => Hash::make('admin123'),
            ],
            [
                'name'     => 'Resepsionis',
                'email'    => 'resepsionis@ppkdhotel.com',
                'password' => Hash::make('resepsionis123'),
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                $user
            );
        }

        $this->command->info('✅ UserSeeder selesai — 2 akun berhasil dibuat:');
        $this->command->table(
            ['Nama', 'Email', 'Password'],
            [
                ['Resepsionis',  'resepsionis@ppkdhotel.com',  'resepsionis123']
            ]
        );
    }
}
