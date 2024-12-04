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
                'name' => 'Office 1',
                'address' => 'Jl. Office 1',
                'qrcode' => '48SCTr6Y9wWsFxsE6DXMQtMT20gfaucfoX3UHjSI',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
