<?php

namespace App\Jobs\Transaction\Transaction;

use App\Events\Transaction\Invoice\InvoiceUpdated;
use App\Events\Transaction\Transaction\TransactionUpdated;
use App\Models\Transaction\Invoice\Invoice;
use App\Models\Transaction\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UpdateTransactionStatus
{
    use Dispatchable, SerializesModels;

    public Transaction $transaction;
    public int $status;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Transaction $transaction, $status = Transaction::TRANSACTION_STATUS_CREATED)
    {
        //
        $this->transaction = $transaction;
        $this->status = $status;
        $this->attributes = Validator::make(['status' => $status], ['status' => Rule::in(array_keys(Transaction::getAvailableStatus()))])->validate();

    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle()
    {
        $this->transaction->status = $this->attributes['status'];
        $this->transaction->save();
        if ($this->transaction->exists) {
            event(new TransactionUpdated($this->transaction));
        }
        return $this->transaction->wasChanged();
    }
}
