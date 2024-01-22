<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDelivery>
 */
class OrderDeliveryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' =>  Order::factory(),
            'deliver_id' => User::factory(),
            'startposition' => $this->faker->address,
            'endposition' => $this->faker->address,
            'distance' => $this->faker->randomFloat(2, 1, 100),
            'amount' => $this->faker->randomFloat(2, 10, 100),
            'status' => 'pending',
            'accepteddate' => $this->faker->dateTimeThisMonth,
            'comment' => $this->faker->text,
            'note' => $this->faker->numberBetween(1, 5),
            'enddate' => $this->faker->dateTimeThisMonth,
            'startdate' => $this->faker->dateTimeThisMonth,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
