<?php

namespace Database\Seeders\PaymentMethod;

use App\Models\PaymentMethod\PaymentMethod;
use App\Models\PaymentMethod\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach (PaymentMethod::getAvailableTypes() as $key => $value){
            $paymentMethod = new Type($value);
            $paymentMethod->save();
        }
        //
    }
}
