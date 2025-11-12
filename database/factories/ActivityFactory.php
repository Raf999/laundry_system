<?php

namespace Database\Factories;

use App\Enum\ActivityType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(ActivityType::cases()),
            'description' => $this->faker->sentence(),
            'company_id' => $this->faker->randomElement([1, 2, 3])
        ];
    }
}
