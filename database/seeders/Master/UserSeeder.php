<?php

namespace Database\Seeders\Master;

use App\Jobs\Master\User\CreateUser;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        User::factory()->count($this->USER_COUNT)->create();

        $factory = Factory::create();
//        $password = $factory->password(8);
        $password = "Password123#";
        $job = new CreateUser([
            'name' => $factory->name(),
            'email' => $factory->email(),
            'password_confirmation' => $password,
            'password' => $password
        ]);
        dispatch($job);
    }
}
