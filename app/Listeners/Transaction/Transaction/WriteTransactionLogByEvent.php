<?php

namespace App\Listeners\Transaction\Transaction;

use App\Events\Transaction\Order\OrderArrivedUniversityBySprinter;
use App\Events\Transaction\Order\OrderGoToUniversityBySprinter;
use App\Events\Transaction\Order\OrderLegalProcessBySprinter;
use App\Events\Transaction\Order\TransactionOrderTaken;
use App\Events\Transaction\Transaction\TransactionCreated;
use App\Jobs\Transaction\Transaction\WriteTransactionLog;
use App\Models\Master\Sprinter;
use App\Models\Transaction\Order;
use App\Models\Transaction\Transaction;
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
                    'remark' => TransactionLogSupport::generateLogMessage(Order::class, Order::getAvailableStatus()[$order->status], $message)
                ];

                $job = new WriteTransactionLog($transaction, $order, $data);
                dispatch($job);
                break;
            case $event instanceof TransactionCreated:
                /** @var Transaction $transaction */
                $transaction = $event->transaction;

                $message = __('logs.transaction.created');
                $data = [
                    'remark' => TransactionLogSupport::generateLogMessage(Transaction::class, Transaction::getAvailableStatus()[$transaction->status], $message)
                ];

                $job = new WriteTransactionLog($transaction, $transaction, $data);
                dispatch($job);
                break;
            case $event instanceof OrderGoToUniversityBySprinter:
                /** @var Order $order */
                $order = $event->order;
                /** @var Sprinter $sprinter */
                $sprinter = $event->sprinter;
                $statusRemark = Order::getAvailableStatus()[$order->status];
                $university = $order->transaction->university;
                $message = __('logs.order.to', ['sprinter_name' => $sprinter->name, 'name' => $university->name]);
                $data = [
                    'remark' => TransactionLogSupport::generateLogMessage(Order::class, $statusRemark, $message)
                ];
                $job = new WriteTransactionLog($order->transaction, $order, $data);
                dispatch($job);
                break;

            case $event instanceof OrderArrivedUniversityBySprinter:
                /** @var Order $order */
                $order = $event->order;
                /** @var Sprinter $sprinter */
                $sprinter = $event->sprinter;
                $statusRemark = Order::getAvailableStatus()[$order->status];
                $university = $order->transaction->university;
                $message = __('logs.order.arrived', ['sprinter_name' => $sprinter->name, 'name' => $university->name]);
                $data = [
                    'remark' => TransactionLogSupport::generateLogMessage(Order::class, $statusRemark, $message)
                ];
                $job = new WriteTransactionLog($order->transaction, $order, $data);
                dispatch($job);
                break;
            case $event instanceof OrderLegalProcessBySprinter:
                /** @var Order $order */
                $order = $event->order;
                $statusRemark = Order::getAvailableStatus()[$order->status];
                $message = __('logs.order.legal_process');
                $data = [
                    'remark' => TransactionLogSupport::generateLogMessage(Order::class, $statusRemark, $message)
                ];
                $job = new WriteTransactionLog($order->transaction, $order, $data);
                dispatch($job);
                break;
        }
    }
}
