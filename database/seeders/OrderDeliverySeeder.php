<?php

namespace Database\Seeders;

use App\Models\OrderDelivery;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderDeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderDelivery::factory()->count(5)->create();
    }
}
