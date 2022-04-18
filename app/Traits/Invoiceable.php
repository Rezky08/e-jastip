<?php

namespace App\Traits;

use App\Models\Transaction\Invoice;

trait Invoiceable
{
    public function invoices(): MorphToMany
    {
        $attachment_class = Invoice::class;
        return $this->morphToMany($attachment_class, 'invoiceable', 'invoiceable', 'invoiceable_id');
    }
}

