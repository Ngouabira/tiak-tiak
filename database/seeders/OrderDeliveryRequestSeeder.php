<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderDeliveryRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderDeliveryRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderDeliveryRequest::factory()->count(5)->create();
    }
}
