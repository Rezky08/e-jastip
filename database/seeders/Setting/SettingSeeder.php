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
                'key'=> Setting::KEY_BIAYA_LAYANAN,
                'value' => 100000
            ],
            [
                'key'=> Setting::KEY_PENGIRIMAN_KOTA_ASAL,
                'value' => 399 // Semarang Kota
            ],
            [
                'key'=> Setting::KEY_BIAYA_APP_PERCENTAGE,
                'value' => 20 // in percentage
            ],
            [
                'key'=> Setting::KEY_BIAYA_OPS_PERCENTAGE,
                'value' => 10 // in percentage
            ],
            [
                'key'=> Setting::KEY_BIAYA_JASTIP_PERCENTAGE,
                'value' => 70 // in percentage
            ],
            [
                'key'=> Setting::KEY_MAX_TRANSACTION_ATTACHMENT,
                'value' => 1
            ],
            [
                'key'=> Setting::KEY_MAX_SPRINTER_ORDER_TAKEN,
                'value' => 3
            ],
            [
                'key'=> Setting::KEY_MAX_SPRINTER_UPLOAD_PROOF,
                'value' => 3
            ],

        ];
    }
}
