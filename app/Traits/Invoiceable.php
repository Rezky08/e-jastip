<?php

namespace App\Traits;

use App\Models\Transaction\Invoice\Invoice;
use App\Models\Transaction\Invoice\Invoicable as InvoicableModel;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Invoiceable
{
    public function invoices(): MorphToMany
    {
        $attachment_class = Invoice::class;
        return $this->morphToMany($attachment_class, 'invoiceable', 't_invoiceables', 'invoiceable_id');
    }
    public function invoice()
    {
        return $this->hasOneThrough(Invoice::class,InvoicableModel::class,'invoiceable_id','id',$this->getKeyName(),'invoice_id');
    }
}

