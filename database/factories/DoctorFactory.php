<?php

namespace Database\Factories;

use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>$this->faker->name,
            'email'=>$this->faker->unique()->safeEmail(),
            'section_id'=>Section::all()->random()->id,
            'email_verified_at'=>now(),
            'password'=>Hash::make('12345678'),
            'phone'=>$this->faker->phoneNumber,
            'number_of_statements'=>5,
        ];
    }
}
