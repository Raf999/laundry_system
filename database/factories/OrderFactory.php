<?php

namespace Database\Factories;

use App\Enum\DeliveryType;
use App\Enum\OrderStatus;
use App\Enum\PaymentMethod;
use App\Enum\PaymentStatus;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reference' => 'ORD-' . $this->faker->unique()->numerify('########'),
            'user_id' => User::factory(),
            'company_id' => 1,
            // The staff member who took the order
            'staff_in_id' => 1,

            // Default status as per migration
            'status' => OrderStatus::PROCESSING->value,

            // Random delivery type
            'delivery_type' => $this->faker->randomElement(DeliveryType::cases())->value,

            // Address is nullable, so we make it optional
            'delivery_address' => $this->faker->optional(0.7)->address(),
            'delivery_cost' => $this->faker->randomFloat(2, 0, 30),

            'discount_amount' => $this->faker->randomFloat(2, 0, 100),
            'amount_paid' => $this->faker->randomFloat(2, 50, 1000),
            'payment_method' => $this->faker->randomElement(PaymentMethod::cases())->value,

            // Estimated completion date is optional
            'estimated_completion_date' => $this->faker->optional(0.5)->dateTimeBetween('+1 day', '+1 month'),

            'completed_at' => null,
        ];
    }
}
