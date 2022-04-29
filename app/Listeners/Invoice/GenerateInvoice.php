<?php

namespace App\Listeners\Invoice;

use App\Jobs\Transaction\Invoice\CreateInvoiceFromTransaction;
use App\Models\Transaction\Transaction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Rezky\LaravelResponseFormatter\Exception\Error;
use Rezky\LaravelResponseFormatter\Http\Code;

class GenerateInvoice
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
     * @throws \Throwable
     */
    public function handle($event)
    {
        throw_if(!($event->transaction instanceof Transaction),Error::make(Code::CODE_ERROR_INVALID_DATA,[],"Transaction Not Found"));

        /** @var Transaction $transaction */
        $transaction = $event->transaction;

        $job = new CreateInvoiceFromTransaction($transaction);

        dispatch($job);

    }
}
