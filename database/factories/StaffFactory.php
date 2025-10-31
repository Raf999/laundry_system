<?php

namespace Database\Factories;

use App\Enum\StaffRoleEnum;
use App\Models\Company;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staff>
 */
class StaffFactory extends Factory
{
    protected $model = Staff::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name(),
            'role' => $this->faker->randomElement(StaffRoleEnum::cases()),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'company_id' => Company::factory(),
            'password' => 'pass9999',
        ];
    }
}
