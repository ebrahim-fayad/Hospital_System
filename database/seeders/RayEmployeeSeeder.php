<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\RayEmployee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RayEmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RayEmployee::updateOrCreate(['email'=>'ray@gemail.com'],[

            'name' => 'Ray Employee',
            'password' => Hash::make('12345678')
            ]
    );
        Image::create([
            'fileName' => 'RayEmployees/ray-employee.jpg',
            'imageable_id' => 1,
            'imageable_type' => 'App\Models\RayEmployee',
        ]);
    }
}
