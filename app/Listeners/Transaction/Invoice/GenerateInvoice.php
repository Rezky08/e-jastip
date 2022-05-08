<?php

namespace App\Listeners\Transaction\Invoice;

use App\Jobs\Transaction\Invoice\CreateInvoiceFromTransaction;
use App\Models\Transaction\Transaction;
use Rezky\LaravelResponseFormatter\Exception\Error;
use Rezky\LaravelResponseFormatter\Http\Code;
use function dispatch;
use function throw_if;

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
