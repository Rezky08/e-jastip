<?php

namespace App\Traits;

use App\Models\PaymentMethod\Account;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait PaymentMethodAccountable
{
    public function paymentMethodAccounts(): MorphToMany
    {
        return $this->morphToMany(Account::class, 'payment_method_accountable', 'm_payment_method_accountables', 'payment_method_accountable_id','payment_method_account_id');
    }
//    public function invoice()
//    {
//        return $this->hasOneThrough(Invoice::class,InvoicableModel::class,'invoiceable_id','id',$this->getKeyName(),'invoice_id');
//    }
}

