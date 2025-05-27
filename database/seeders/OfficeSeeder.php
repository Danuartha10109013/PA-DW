<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('offices')->insert([
            [
                'name' => 'PT. ZEN MULTIMEDIA INDONESIA',
                'address' => 'Jl. Taman Pahlawan No.166, Purwamekar, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41119',
                'qrcode' => 'qWrsUjQkygjoflKiF3O9qaKEthMvUp7Kk7Wb9Gvn',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
