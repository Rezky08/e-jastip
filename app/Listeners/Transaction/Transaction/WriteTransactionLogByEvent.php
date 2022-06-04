<?php

namespace App\Listeners\Transaction\Transaction;

use App\Events\Transaction\Order\TransactionOrderTaken;
use App\Jobs\Transaction\Transaction\WriteTransactionLog;
use App\Models\Transaction\Order;
use App\Supports\TransactionLogSupport;

class WriteTransactionLogByEvent
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
            case $event instanceof TransactionOrderTaken:
                /** @var Order $order */
                $order = $event->order;
                $transaction = $order->transaction;

                $message = __('logs.order.taken', ['name' => $order->sprinter->name]);
                $data = [
                    'remark' => TransactionLogSupport::generateLogMessage( Order::class, Order::getAvailableStatus()[$order->status], $message)
                ];

                $job = new WriteTransactionLog($transaction, $order, $data);
                dispatch($job);
        }
    }
}
