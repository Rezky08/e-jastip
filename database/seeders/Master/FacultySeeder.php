<?php

namespace Database\Seeders\Master;

use App\Models\Master\Faculty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach ($this->getAvailableFaculty() as $item){
            $faculty = new Faculty($item);
            $faculty->save();
        }
    }

    private function getAvailableFaculty(): array
    {
        return [
            [
                'code' => 'FIP',
                'name' => 'Fakultas Ilmu Pendidikan'
            ],
            [
                'code' => 'FBS',
                'name' => 'Fakultas Bahasa & Seni'
            ],
            [
                'code' => 'FIS',
                'name' => 'Fakultas Ilmu Sosial'
            ],
            [
                'code' => 'FMIPA',
                'name' => 'Fakultas Matematika dan IPA'
            ],
            [
                'code' => 'FT',
                'name' => 'Fakultas Teknik'
            ],
            [
                'code' => 'FIO',
                'name' => 'Fakultas Ilmu Keolahragaan'
            ],
            [
                'code' => 'FE',
                'name' => 'Fakultas Ekonomi'
            ],
            [
                'code' => 'FH',
                'name' => 'Fakultas Hukum'
            ],
            [
                'code' => 'PSC',
                'name' => 'Pascasarjana'
            ],

        ];
    }
}
