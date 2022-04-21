<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphToMany;

interface InvoiceableContract
{
    public function invoices(): MorphToMany;
}
