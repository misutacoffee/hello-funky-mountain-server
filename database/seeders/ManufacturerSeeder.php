<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManufacturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $manufacturers = [
            'Blackmagic Design', 'Canon', 'Pioneer', 'Sony', 'Yamaha',
        ];
        // or use csv?
    }
}
