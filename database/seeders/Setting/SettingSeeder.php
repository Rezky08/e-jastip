<?php

namespace Database\Seeders\Setting;

use App\Models\Setting\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach ($this->getAvailableSettings() as $value){
            $setting = new Setting($value);
            $setting->save();
        }
    }

    protected function getAvailableSettings(): array
    {
        return [
            [
                'key'=> 'biaya_layanan',
                'value' => 100000
            ]
        ];
    }
}
