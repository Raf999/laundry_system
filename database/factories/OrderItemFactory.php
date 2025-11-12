<?php

namespace Database\Factories;

use App\Models\ClothingType;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Define a reasonable unit price range for services/clothing
        $unitPrice = $this->faker->randomFloat(2, 5.00, 75.00);

        return [
            'order_id' => Order::factory(),
            'clothing_type_id' => 1,
            'service_id' => 1,

            // Quantity is defaulted to 1 in the migration, but we can randomize it
            'quantity' => $this->faker->numberBetween(1, 5),

            // Color is nullable, we make it optional but more likely to be set
            'color' => $this->faker->optional(0.7)->randomElement(['Blue', 'Black', 'Red', 'White', 'Gray', 'Khaki']),

            // Unit price as defined above
            'unit_price' => $unitPrice,
        ];
    }
}
