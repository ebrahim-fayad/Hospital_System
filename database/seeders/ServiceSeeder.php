<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create([
            'name' => 'حشو عصب',
            'price' => 2000,
        ]);
        Service::create([
            'name' => 'زرع اسنان',
            'price' => 5000,
        ]);
    }
}
