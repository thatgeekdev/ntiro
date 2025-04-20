<?php

namespace Database\Factories;
use App\Models\Job;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->jobTitle(),
            'description' => fake()->paragraph(2),
            'salary' => fake()->numberBetween(3000, 12000),
            'location' => fake()->city(),
            'category' => fake()->randomElement(Job::$categories),
            'experience' => fake()->randomElement(Job::$experience),
            'status' => fake()->randomElement(Job::$status),
            'work_modes' => fake()->randomElement(Job::$work_modes),
            'company_name' => fake()->company(),
            'expires_at' => now()->addDays(30),
            'views' => fake()->numberBetween(0, 1000),
            'applications' => fake()->numberBetween(0, 100),
        ];
    }
}
