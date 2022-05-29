<?php

namespace Database\Seeders\Master;

use App\Jobs\Master\Sprinter\CreateSprinter;
use App\Models\Master\University;
use Illuminate\Database\Seeder;

class SprinterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = "Sprinter123456#";
        $job = new CreateSprinter([
            'name' => 'sprinter',
            'email' => 'sprinter@mail.com',
            'university_id' => University::query()->findOrFail(UniversitySeeder::$defaultId)->id,
            'password_confirmation' => $password,
            'password' => $password
        ]);
        dispatch($job);
    }
}
