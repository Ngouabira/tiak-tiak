<?php

namespace Database\Seeders;

use App\Models\DeliveryRequest;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DeliveryRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DeliveryRequest::factory()->count(5)->create();
    }
}
