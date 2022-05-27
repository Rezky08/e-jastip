<?php

namespace App\Listeners\Transaction\Invoice;

use App\Events\Transaction\Invoice\InvoicePaymentConfirmationUploaded;
use App\Events\Transaction\Invoice\InvoicePaymentConfirmed;
use App\Events\Transaction\Invoice\InvoicePaymentMethodUpdated;
use App\Jobs\Transaction\Invoice\UpdateInvoiceStatus;
use App\Jobs\Transaction\Transaction\UpdateTransactionStatus;
use App\Models\Master\User\User;
use App\Models\Transaction\Invoice\Invoice;
use App\Models\Transaction\Transaction;
use App\Supports\Repositories\AuthRepository;
use Illuminate\Contracts\Auth\Authenticatable;
use Rezky\LaravelResponseFormatter\Exception\Error;
use Rezky\LaravelResponseFormatter\Http\Code;

class UpdateInvoiceStatusByEvent
{
    public User|Authenticatable $user;
    public AuthRepository $repository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(AuthRepository $repository)
    {

        $this->repository = $repository;
        $this->user = $this->repository->getUser();
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        /** @var Invoice $invoice */
        $invoice = $event->invoice;
        throw_if(empty($invoice), Error::make(Code::CODE_ERROR_INVALID_DATA, [], "Invoice Not Found"));
        $transaction = $invoice->transaction;

        switch (true) {
            case $event instanceof InvoicePaymentMethodUpdated:
                $job = new UpdateInvoiceStatus($invoice, Invoice::INVOICE_STATUS_WAITING_PAYMENT);
                dispatch($job);
                break;
            case $event instanceof InvoicePaymentConfirmationUploaded:
                $job = new UpdateInvoiceStatus($invoice, Invoice::INVOICE_STATUS_WAITING_CONFIRMATION);
                dispatch($job);
                break;
            case $event instanceof InvoicePaymentConfirmed:

                $statusLabel = Transaction::getAvailableStatus()[Transaction::TRANSACTION_STATUS_PAID];
                $currentStatusLabel = Transaction::getAvailableStatus()[$transaction->status];
                $message = __('validation.transaction.status.invalid', ['status' => $statusLabel, 'current_status' => $currentStatusLabel]);
                throw_if($transaction->status != Transaction::TRANSACTION_STATUS_PAID, Error::make(Code::CODE_ERROR_INVALID_DATA, [], $message));

                $job = new UpdateInvoiceStatus($invoice, Invoice::INVOICE_STATUS_PAID);
                dispatch($job);
                break;
        }
    }
}
