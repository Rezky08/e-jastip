<?php

namespace Database\Seeders\Master;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UniversitySeeder extends Seeder
{
    public static int $defaultId = 139;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $base = __DIR__."/../data";
        $path = $base.'/universities.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('University seeded!');

    }
}
