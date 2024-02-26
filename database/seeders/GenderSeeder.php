<?php

namespace Database\Seeders;

use App\Models\Gender;
use App\Models\GenderTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gender::create([
            'type'=>'ذكر',
        ]);
        GenderTranslation::create([
            'locale' => 'en',
            'gender_id' => '1',
            'type'=>'Male',
        ]);
        Gender::create([
            'type'=>'أنثي',
        ]);
        GenderTranslation::create([
            'locale' => 'en',
            'gender_id' => '2',
            'type'=>'Female',
        ]);
    }
}
