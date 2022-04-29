<?php

namespace Database\Seeders\Geo;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $base = __DIR__."../data";
        $path = $base.'/province.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Province seeded!');

        $path = $base.'/city.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('City seeded!');

        $path = $base.'/district.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('District seeded!');
    }
}
