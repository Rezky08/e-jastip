<?php

namespace Database\Seeders\Master;

use App\Models\Master\University;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UniversityAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Unnes Address
        $university = University::query()->find(UniversitySeeder::$defaultId);
        $university->fill([
            'province_id' => 10,// Jawa tengah
            'city_id' => 399,// Kota Semarang
            'district_id' => 5503,// Gunungpati
            'zip_code' => 50229,
            'address' => 'Sekaran, Gunung Pati, Semarang City, Central Java 50229'
        ]);
        $university->save();

    }
}
