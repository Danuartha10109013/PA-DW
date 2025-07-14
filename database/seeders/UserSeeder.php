<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            // [
            //     'name' => 'Admin',
            //     'nik' => null,
            //     'position' => null,
            //     'email' => 'admin@gmail.com',
            //     'email_verified_at' => now(),
            //     'password' => Hash::make('12345'),
            //     'remember_token' => Str::random(40),
            //     'role_id' => 1,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'name' => 'Admin',
            //     'nik' => null,
            //     'position' => null,
            //     'email' => 'admin@gmail.com',
            //     'email_verified_at' => now(),
            //     'password' => Hash::make('12345'),
            //     'remember_token' => Str::random(40),
            //     'role_id' => 1,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            [
                'name' => 'direkturkeuangan',
                'nik' => '12345678910',
                'position' => 'direkturkeuangan',
                'email' => 'direkturkeuangan@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('12345'),
                'remember_token' => Str::random(40),
                'role_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
