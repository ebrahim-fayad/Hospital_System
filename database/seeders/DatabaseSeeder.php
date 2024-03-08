<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Gender;
use App\Models\Image;
use App\Models\LaboratoryEmployee;
use App\Models\RayEmployee;
use App\Models\Section;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Admin::truncate();
        User::truncate();
        Section::truncate();
        Doctor::truncate();
        RayEmployee::truncate();
        LaboratoryEmployee::truncate();
        Appointment::truncate();
        Image::truncate();
        Gender::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            SectionSeeder::class,
            AppointmentSeeder::class,
            DoctorSeeder::class,
            GenderSeeder::class,
            ServiceSeeder::class,
            PatientSeeder::class,
            RayEmployeeSeeder::class,
            LaboratoryEmployeeSeder::class,
            ImageSeeder::class,
            ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
