<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create();
        return [
            // 'name' => fake()->name(),
            // 'email' => fake()->unique()->safeEmail(),
            // 'email_verified_at' => now(),
            // 'password' => static::$password ??= Hash::make('password'),
            // 'remember_token' => Str::random(10),
            'name' => $faker->name,
            'firstname' => $faker->firstName,
            'gender' => $faker->randomElement(['male', 'female']),
            'phone' => $faker->unique()->phoneNumber,
            'address' => $faker->address,
            'status' => $faker->word,
            'image' => $faker->imageUrl(),
            'cni' => $faker->numerify('########'),
            'email' => $faker->unique()->safeEmail,
            'point' => $faker->numberBetween(0, 100),
            'profile_id' => Profile::factory(), // Assurez-vous que le modèle Profile est correctement configuré
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
