<?php

namespace Database\Seeders\Master;

use App\Jobs\Master\User\CreateUser;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public $USER_COUNT = 5;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count($this->USER_COUNT)->create();
    }
}
