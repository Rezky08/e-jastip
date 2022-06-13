<?php

namespace App\Jobs\Transaction\Transaction;

use App\Contracts\TransactionLogableContract;
use App\Models\Transaction\Transaction;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Validator;

class WriteTransactionLog
{
    use Dispatchable, SerializesModels;

    public Transaction $transaction;
    public TransactionLogableContract $transactionLogable;
    public array $attributes;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Transaction $transaction, TransactionLogableContract $transactionLogable, $attributes = [])
    {
        $this->transaction = $transaction;
        $this->transactionLogable = $transactionLogable;
        $this->attributes = Validator::make($attributes, [
            'remark' => ['required', 'filled']
        ])->validate();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->transactionLogable->transactionLogs()->attach($this->transaction, $this->attributes);
        $this->transactionLogable->save();
    }
}
