<?php

namespace Database\Seeders\Master;

use App\Jobs\Master\Admin\CreateAdmin;
use App\Models\Master\Faculty;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = "Admin123456#";
        $job = new CreateAdmin([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'faculty_id' => Faculty::query()->inRandomOrder()->first()->id,
            'password_confirmation' => $password,
            'password' => $password
        ]);
        dispatch($job);
    }
}
