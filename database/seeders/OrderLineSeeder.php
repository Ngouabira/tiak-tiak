<?php

namespace Database\Seeders;

use App\Models\OrderLine;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderLineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderLine::factory()->count(5)->create();
    }
}
