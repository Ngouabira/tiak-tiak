<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Delivery;
use App\Models\DeliveryRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DeliveryRequest>
 */
class DeliveryRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'delivery_id' => Delivery::factory(),
            'deliver_id' => User::factory(),
            'status' => $this->faker->randomElement(['pending', 'accepted', 'rejected']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
