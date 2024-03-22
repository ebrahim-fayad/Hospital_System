<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Patient::create([
            'name' => 'ابراهيم',
            'email' => 'ibrahim@gemail.com',
            'Date_Birth' => '2001-09-01',
            'phone' => 12345678,
            'password' => Hash::make('12345678'),
            'gender_id' => 1,
            'Blood_Group' => 'O-',
        ]);
        
    }
}
