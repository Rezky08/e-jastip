<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphToMany;

interface PaymentMethodAccountableContract
{
    public function paymentMethodAccounts(): MorphToMany;
}
