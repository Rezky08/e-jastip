<?php

namespace Database\Seeders\Partner;

use App\Models\Partner\Shipment;
use Illuminate\Database\Seeder;

class ShipmentSeeder extends Seeder
{
    private function getData()
    {
        return [
            [
                'code' => 'jne',
                'name' => "Jalur Nugraha Ekakurir (JNE)",
                'abbr' => "JNE"
            ],
            [
                'code' => 'tiki',
                'name' => "Citra Van Titipan Kilat (TIKI)",
                'abbr' => "TIKI"
            ],
            [
                'code' => 'pos',
                'name' => "POS Indonesia (POS)",
                'abbr' => "POS"
            ],

        ];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->getData() as $data){
            $shipment = new Shipment($data);
            $shipment->save();
        }
        $this->command->info('Shipment seeded!');

    }
}
