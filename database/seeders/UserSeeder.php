<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                [
                    'name' => 'Admin',
                    'email' => 'admin@solar.com',
                    'tel' => '+256700000000',
                    'password' => Hash::make('password'),
                    'user_type' => 'admin',
                ],
                [
                    'name' => 'Technician',
                    'email' => 'tech@solar.com',
                    'tel' => '+256700000001',
                    'password' => Hash::make('password'),
                    'user_type' => 'technician',
                ]
            ]);
    }
}
