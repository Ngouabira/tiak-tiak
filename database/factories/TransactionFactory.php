<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => $this->faker->randomFloat(2, 10, 100),
            'paymentmode' => $this->faker->randomElement(['credit_card', 'paypal', 'cash']),
            'client_id' => User::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
