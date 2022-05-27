<?php

namespace App\Listeners\Transaction\Transaction;

use App\Events\Transaction\Invoice\InvoicePaymentConfirmationUploaded;
use App\Events\Transaction\Invoice\InvoicePaymentConfirmed;
use App\Events\Transaction\Invoice\InvoicePaymentMethodUpdated;
use App\Jobs\Transaction\Transaction\UpdateTransactionStatus;
use App\Models\Transaction\Invoice\Invoice;
use App\Models\Transaction\Transaction;
use Rezky\LaravelResponseFormatter\Exception\Error;
use Rezky\LaravelResponseFormatter\Http\Code;

class UpdateTransactionStatusByEvent
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        $transaction = $event->transaction ?? null;
        if (!($transaction instanceof Transaction)) {
            /** @var Invoice $invoice */
            $invoice = $event->invoice;
            throw_if(empty($invoice), Error::make(Code::CODE_ERROR_INVALID_DATA, [], "Invoice Not Found"));

            $transaction = $invoice->transaction;
        }

        switch (true) {
            case $event instanceof InvoicePaymentMethodUpdated:
                $job = new UpdateTransactionStatus($transaction, Transaction::TRANSACTION_STATUS_WAITING_PAYMENT);
                dispatch($job);
                break;
             case $event instanceof InvoicePaymentConfirmed:
                $job = new UpdateTransactionStatus($transaction, Transaction::TRANSACTION_STATUS_PAID);
                dispatch($job);
                break;

        }
    }
}
