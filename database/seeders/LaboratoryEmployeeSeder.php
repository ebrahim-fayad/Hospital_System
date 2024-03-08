<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\LaboratoryEmployee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LaboratoryEmployeeSeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LaboratoryEmployee::updateOrCreate(
            ['email' => 'laboratory@gemail.com'],
            [

                'name' => 'Laboratory Employee',
                'password' => Hash::make('12345678')
            ]
        );
        Image::create([
            'fileName' => 'LaboratoryEmployees/laboratory-employee.jpg',
            'imageable_id' => 1,
            'imageable_type' => 'App\Models\LaboratoryEmployee',
        ]);
    }
}
