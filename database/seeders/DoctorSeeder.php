<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctors= Doctor::factory()->count(10)->create();
        //لو عايز احدد لكل طبيب 3 مواعيد فقط
        foreach ($doctors as $doctor) {
           $numberOfAppointments = 3; // يمكنك تعديل هذا الرقم حسب احتياجاتك

            // استرجاع عدد معين من المواعيد بشكل عشوائي
            $appointments = Appointment::inRandomOrder()->take($numberOfAppointments)->get();

            // ربط المواعيد بالطبيب
            foreach ($appointments as $appointment) {
                $doctor->doctorAppointments()->attach($appointment);
            }
        }
        //# لو عايز اختار لكل طبيب اكثر من موعد و يكون عددهم عشوائي
        // $Appointments = Appointment::all();
        // Doctor::all()->each(function ($doctor) use ($Appointments) {
        //     $doctor->doctorAppointments()->attach(
        //         $Appointments->random(rand(1, 7))->pluck('id')->toArray()
        //     );
        // });

    }
}
