<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\AppointmentTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Appointment::create([
            'name' => 'السبت',
        ]);
        AppointmentTranslation::create([
            'locale' => 'en',
            'appointment_id' => '1',
            'name' => 'Saturday',
        ]);
        Appointment::create([
            'name' => 'الاحد',
        ]);
        AppointmentTranslation::create([
            'locale' => 'en',
            'appointment_id' => '2',
            'name' => 'Sunday',
        ]);
        Appointment::create([
            'name' => 'الاثنين',
        ]);
        AppointmentTranslation::create([
            'locale' => 'en',
            'appointment_id' => '3',
            'name' => 'Monday',
        ]);
        Appointment::create([
            'name' => 'الثلاثاء',
        ]);
        AppointmentTranslation::create([
            'locale' => 'en',
            'appointment_id' => '4',
            'name' => 'Tuesday',
        ]);
        Appointment::create([
            'name' => 'الأربعاء',
        ]);
        AppointmentTranslation::create([
            'locale' => 'en',
            'appointment_id' => '5',
            'name' => 'Wednesday',
        ]);
        Appointment::create([
            'name' => 'الخميس',
        ]);
        AppointmentTranslation::create([
            'locale' => 'en',
            'appointment_id' => '6',
            'name' => 'Thursday',
        ]);
        Appointment::create([
            'name' => 'الجمعة',
        ]);
        AppointmentTranslation::create([
            'locale' => 'en',
            'appointment_id' => '7',
            'name' => 'Friday',
        ]);
    }
}
