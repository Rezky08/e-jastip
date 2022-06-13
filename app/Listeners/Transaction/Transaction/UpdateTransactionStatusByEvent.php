<?php

namespace App\Listeners\Transaction\Transaction;

use App\Events\Transaction\Invoice\InvoicePaymentConfirmationUploaded;
use App\Events\Transaction\Invoice\InvoicePaymentConfirmed;
use App\Events\Transaction\Invoice\InvoicePaymentMethodUpdated;
use App\Events\Transaction\Order\DocumentReceivedByUser;
use App\Events\Transaction\Order\OrderShippedBySprinter;
use App\Events\Transaction\Order\TransactionOrderTaken;
use App\Jobs\Transaction\Transaction\UpdateTransactionStatus;
use App\Models\Transaction\Invoice\Invoice;
use App\Models\Transaction\Order;
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
        switch (true) {
            case $event instanceof InvoicePaymentMethodUpdated:
                /** @var Invoice $invoice */
                $invoice = $event->invoice ?? null;
                throw_if(empty($invoice), Error::make(Code::CODE_ERROR_INVALID_DATA, [], "Invoice Not Found"));

                $transaction = $invoice->transaction;

                $job = new UpdateTransactionStatus($transaction, Transaction::TRANSACTION_STATUS_WAITING_PAYMENT);
                dispatch($job);
                break;
            case $event instanceof InvoicePaymentConfirmed:
                /** @var Invoice $invoice */
                $invoice = $event->invoice ?? null;
                throw_if(empty($invoice), Error::make(Code::CODE_ERROR_INVALID_DATA, [], "Invoice Not Found"));

                $transaction = $invoice->transaction;
                $job = new UpdateTransactionStatus($transaction, Transaction::TRANSACTION_STATUS_PAID);
                dispatch($job);
                break;
            case $event instanceof TransactionOrderTaken:
                /** @var Order $order */
                $order = $event->order;
                $transaction = $order->transaction;
                $job = new UpdateTransactionStatus($transaction, Transaction::TRANSACTION_STATUS_IN_PROGRESS);
                dispatch($job);
                break;
            case $event instanceof OrderShippedBySprinter:
                /** @var Order $order */
                $order = $event->order;
                $transaction = $order->transaction;
                $job = new UpdateTransactionStatus($transaction, Transaction::TRANSACTION_STATUS_IN_SHIPPING);
                dispatch($job);
                break;
            case $event instanceof DocumentReceivedByUser:
                /** @var Order $order */
                $order = $event->order;
                $transaction = $order->transaction;
                $job = new UpdateTransactionStatus($transaction, Transaction::TRANSACTION_STATUS_ARRIVED);
                dispatch($job);
                break;

        }
    }
}
