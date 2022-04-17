<?php

namespace Database\Seeders;

use Database\Seeders\Geo\GeoSeeder;
use Database\Seeders\Partner\ShipmentSeeder;
use Database\Seeders\PaymentMethod\PaymentMethodSeeder;
use Database\Seeders\PaymentMethod\TypeSeeder;
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
        $this->call(TypeSeeder::class);
        $this->call(PaymentMethodSeeder::class);
    }
}
