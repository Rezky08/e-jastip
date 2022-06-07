<?php

namespace App\Jobs\Transaction\Order;

use App\Events\Transaction\Order\OrderLegalProcessBySprinter;
use App\Events\Transaction\Order\OrderLegalDoneBySprinter;
use App\Jobs\Transaction\Transaction\WriteTransactionLog;
use App\Models\Master\Sprinter;
use App\Models\Transaction\Order;
use App\Supports\TransactionLogSupport;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SprinterLegalDone
{
    use Dispatchable, SerializesModels;

    public Sprinter $sprinter;
    public Order $order;
    public SprinterUpdateOrderStatus $job;
    public array $attributes;
    public \App\Models\Transaction\Transaction $transaction;
    public WriteTransactionLog $jobWriteLog;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Sprinter $sprinter, Order $order,$attributes=[])
    {
        $this->sprinter = $sprinter;
        $this->order = $order;
        $this->transaction = $order->transaction;
        $this->job = new SprinterUpdateOrderStatus($this->sprinter,$this->order,Order::ORDER_STATUS_LEGAL_PROCESS,Order::ORDER_STATUS_LEGAL_PROCESS_DONE);
        $this->attributes = $attributes;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle()
    {
        dispatch($this->job);
        $this->order = $this->job->order;

        $statusRemark = Order::getAvailableStatus()[$this->order->status];
        $this->attributes['remark'] = TransactionLogSupport::generateLogMessage(Order::class, $statusRemark, $this->attributes['remark']);
        $this->jobWriteLog = new WriteTransactionLog($this->transaction, $this->order, $this->attributes);
        dispatch($this->jobWriteLog);

        if ($this->order->wasChanged()){
            event(new OrderLegalDoneBySprinter($this->sprinter,$this->order));
        }
        return $this->order->wasChanged();
    }
}
