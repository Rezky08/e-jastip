<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphToMany;

interface TransactionLogableContract
{
    public function transactionLogs(): MorphToMany;
}
