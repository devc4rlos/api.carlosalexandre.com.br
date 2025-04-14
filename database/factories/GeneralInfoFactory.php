<?php

namespace Database\Factories;

use App\Models\GeneralInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<GeneralInfo>
 */
class GeneralInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'title' => $this->faker->title(),
            'bio' => $this->faker->text(),
            'location' => $this->faker->address(),
            'timezone' => $this->faker->timezone(),
            'experience_years' => $this->faker->randomDigit(),
            'freelance_available' => $this->faker->boolean(),
        ];
    }
}
