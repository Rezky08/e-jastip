<?php

namespace Database\Seeders\PaymentMethod;

use App\Jobs\Master\PaymentMethod\CreatePaymentMethodAccount;
use App\Models\Master\University;
use App\Models\PaymentMethod\Account;
use App\Models\PaymentMethod\Type;
use App\Supports\PaymentMethodSupport;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class PaymentMethodAccountSeeder extends Seeder
{
    public $COUNT = 15;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->prepareDependency();
        $accounts = Account::factory()->count($this->COUNT)->make();
        foreach ($accounts as $account) {
            try {
                $job = new CreatePaymentMethodAccount($account->toArray());
                dispatch($job);
            } catch (\Exception $exception) {

            }
        }

    }

    private function getRandomPaymentMethod(Collection $paymentMethodTypeList)
    {

        /** @var  $paymentMethodType Type */
        $paymentMethodType = $paymentMethodTypeList->random(1)->first();
        /** @var Collection $paymentMethodList */
        $paymentMethodList = $paymentMethodType->paymentMethods;
        return $paymentMethodList->random(1)->first();
    }

    private function prepareDependency()
    {
        $paymentMethodQuery = PaymentMethodSupport::getPaymentMethodTypeQuery();

        if ($paymentMethodQuery->count() === 0) {
            $this->call([
                TypeSeeder::class,
                PaymentMethodAccountSeeder::class
            ]);
        }
    }
}
