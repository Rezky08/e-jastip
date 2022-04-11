<?php

namespace Database\Seeders;

use Database\Seeders\Geo\GeoSeeder;
use Database\Seeders\Partner\ShipmentSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(GeoSeeder::class);
        $this->call(ShipmentSeeder::class);
    }
}
