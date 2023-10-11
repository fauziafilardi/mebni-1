<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();

        DB::table('users')->insert([
            [
                'membership_type' => 'I',
                'name' => 'Super Admin',
                'phone_number' => '000000000',
                'address' => '-',
                'email' => 'sadmin@mail.com',
                'password' => Hash::make('a'),
                'email_verified_at' => now(),
                'role' => '1',
                'created_at' => now()
            ],
            [
                'membership_type' => 'I',
                'name' => 'Petugas',
                'phone_number' => '000000001',
                'address' => '-',
                'email' => 'petugas@mail.com',
                'password' => Hash::make('a'),
                'email_verified_at' => now(),
                'role' => '2',
                'created_at' => now()
            ],
            [
                'membership_type' => 'C',
                'name' => 'PT. Angin Ribut',
                'phone_number' => '000000002',
                'address' => '-',
                'email' => 'pt1@mail.com',
                'password' => Hash::make('a'),
                'email_verified_at' => now(),
                'role' => '3',
                'created_at' => now()
            ],
            [
                'membership_type' => 'C',
                'name' => 'PT. Surgawi',
                'phone_number' => '000000003',
                'address' => '-',
                'email' => 'pt2@mail.com',
                'password' => Hash::make('a'),
                'email_verified_at' => now(),
                'role' => '3',
                'created_at' => now()
            ],
            [
                'membership_type' => 'P',
                'name' => 'Husna Naadhira Althafunnisa',
                'phone_number' => '000000004',
                'address' => '-',
                'email' => 'husna@mail.com',
                'password' => Hash::make('a'),
                'email_verified_at' => now(),
                'role' => '3',
                'created_at' => now()
            ],
            [
                'membership_type' => 'P',
                'name' => 'Muhammad Uwais Al Qarni Abdillah',
                'phone_number' => '000000005',
                'address' => '-',
                'email' => 'uwais@mail.com',
                'password' => Hash::make('a'),
                'email_verified_at' => now(),
                'role' => '3',
                'created_at' => now()
            ],
        ]);
    }
}
