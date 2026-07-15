<?php

namespace Database\Seeders;

use App\Models\BusRoute;
use Illuminate\Database\Seeder;

class BusRouteSeeder extends Seeder
{
    public function run(): void
    {
        BusRoute::factory(10)->create();
    }
}
