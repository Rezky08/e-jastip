<?php

namespace App\Traits;

use App\Models\Pivot\Transaction\TransactionLogablePivot;
use App\Models\Transaction\Transaction;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait TransactionLogable
{
    public function transactionLogs(): MorphToMany
    {
        $model_class = Transaction::class;
        return $this->morphToMany($model_class, 'transaction_logable', 't_transaction_logables', 'transaction_logable_id')->using(TransactionLogablePivot::class)->withPivot(['id','remark'])->withTimestamps();
    }

    public function transactionLog(): \Illuminate\Database\Eloquent\Relations\HasOneThrough
    {
        return $this->hasOneThrough(Transaction::class, TransactionLogablePivot::class, 'transaction_logable_id', 'id', $this->getKeyName(), 'transaction_id');
    }
}

