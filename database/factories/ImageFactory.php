<?php

namespace Database\Factories;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fileName'=>$this->faker->randomElement(['Doctors/d1.jpg', 'Doctors/d2.jpg', 'Doctors/d3.jpg']),
            'imageable_id' => Doctor::inRandomOrder()->pluck('id')->unique()->first(),
            'imageable_type'=>'App\Models\Doctor',
        ];
    }
}
