<?php

namespace App\Listeners\Transaction\Invoice;

use App\Events\Transaction\Invoice\InvoicePaymentMethodUpdated;
use App\Jobs\Transaction\Invoice\UpdateInvoiceStatus;
use App\Models\Master\User\User;
use App\Models\Transaction\Invoice\Invoice;
use Illuminate\Contracts\Auth\Authenticatable;
use Rezky\LaravelResponseFormatter\Exception\Error;
use Rezky\LaravelResponseFormatter\Http\Code;

class UpdateInvoiceStatusByEvent
{
    public User|Authenticatable $user;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

        $this->user = auth()->user();
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        /** @var Invoice $invoice */
        $invoice = $event->invoice;
        throw_if(empty($invoice),Error::make(Code::CODE_ERROR_INVALID_DATA,[],"Invoice Not Found"));

        switch (true){
            case $event instanceof InvoicePaymentMethodUpdated:
                $job = new UpdateInvoiceStatus($invoice,Invoice::INVOICE_STATUS_WAITING_PAYMENT);
                dispatch($job);
                break;
        }
    }
}
