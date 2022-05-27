<?php

namespace Database\Seeders;

use Database\Seeders\Geo\GeoSeeder;
use Database\Seeders\Master\AdminSeeder;
use Database\Seeders\Master\AdminUniversitySeeder;
use Database\Seeders\Master\FacultySeeder;
use Database\Seeders\Master\StudyProgramWithoutFacultySeeder;
use Database\Seeders\Master\UniversityAddressSeeder;
use Database\Seeders\Master\UniversitySeeder;
use Database\Seeders\Master\UserSeeder;
use Database\Seeders\Partner\ShipmentSeeder;
use Database\Seeders\PaymentMethod\PaymentMethodAccountSeeder;
use Database\Seeders\PaymentMethod\PaymentMethodSeeder;
use Database\Seeders\PaymentMethod\TypeSeeder;
use Database\Seeders\Setting\SettingSeeder;
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
        $this->call(SettingSeeder::class);
        $this->call(GeoSeeder::class);
        $this->call(ShipmentSeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(PaymentMethodSeeder::class);
        $this->call(UniversitySeeder::class);
        $this->call(FacultySeeder::class);
        $this->call(StudyProgramWithoutFacultySeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(UniversityAddressSeeder::class);
        $this->call(AdminUniversitySeeder::class);
        $this->call(PaymentMethodAccountSeeder::class);

    }
}
