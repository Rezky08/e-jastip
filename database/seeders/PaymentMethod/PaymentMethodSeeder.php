<?php

namespace Database\Seeders\PaymentMethod;

use App\Models\PaymentMethod\PaymentMethod;
use App\Models\PaymentMethod\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach (PaymentMethod::getAvailableMethods() as $key => $item){
            try {
                $type = Type::query()->where('type',$item['type'])->firstOrFail();
                foreach ($item['paymentMethod'] as $value){
                    unset($value['isActive']);
                    $paymentMethod = new PaymentMethod($value);
                    $type->paymentMethods()->save($paymentMethod);
                }
            }catch (\Exception $e){

            }
        }

        //
    }
}
