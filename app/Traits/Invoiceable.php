<?php

namespace App\Traits;

use App\Models\Transaction\Invoice;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Invoiceable
{
    public function invoices(): MorphToMany
    {
        $attachment_class = Invoice::class;
        return $this->morphToMany($attachment_class, 'invoiceable', 't_invoiceables', 'invoiceable_id');
    }
}

