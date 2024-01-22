<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Delivery;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Delivery>
 */
class DeliveryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'receiver_name' => $this->faker->name,
            'receiver_phone' => $this->faker->phoneNumber,
            'startposition' => $this->faker->address,
            'endposition' => $this->faker->address,
            'distance' => $this->faker->randomFloat(2, 1, 100),
            'amount' => $this->faker->randomFloat(2, 10, 100),
            'status' => 'pending',
            'accepteddate' => $this->faker->dateTimeThisMonth,
            'comment' => $this->faker->text,
            'note' => $this->faker->numberBetween(1, 5),
            'startdate' => $this->faker->dateTimeThisMonth,
            'enddate' => $this->faker->dateTimeThisMonth,
            'client_id' => User::factory(),
            'deliver_id' => User::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
