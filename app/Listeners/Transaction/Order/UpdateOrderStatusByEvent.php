<?php

namespace App\Listeners\Transaction\Order;

use App\Events\Transaction\Order\DocumentReceivedByUser;
use App\Jobs\Transaction\Order\UpdateOrderStatus;
use App\Jobs\Transaction\Transaction\UpdateTransactionStatus;
use App\Models\Transaction\Order;
use App\Models\Transaction\Transaction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateOrderStatusByEvent
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
            case $event instanceof DocumentReceivedByUser:
                /** @var Order $order */
                $order = $event->order;
                $job = new UpdateOrderStatus($order, Order::ORDER_STATUS_RECEIVED, Order::ORDER_STATUS_DONE);
                dispatch($job);
                break;
        }
    }
}
