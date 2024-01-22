<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ProfileSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(CategorySeeder::class);
        $this->call(DeliveryRequestSeeder::class);
        $this->call(DeliverySeeder::class);
        $this->call(OrderDeliveryRequestSeeder::class);
        $this->call(OrderDeliverySeeder::class);
        $this->call(OrderLineSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(TransactionSeeder::class);
        $this->call(ProfileSeeder::class);
    }
}
