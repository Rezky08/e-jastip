<?php

namespace Database\Seeders\Master;

use App\Models\Master\Admin;
use App\Models\Master\University;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var Admin $admin */
        $admin = Admin::query()->first();
        $university = University::query()->find(139);
        $admin->universities()->attach($university);
        $admin->save();
    }
}
