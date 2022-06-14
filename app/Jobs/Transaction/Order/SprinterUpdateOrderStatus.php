<?php

namespace App\Jobs\Transaction\Order;

use App\Events\Transaction\Order\OrderStatusUpdatedBySprinter;
use App\Models\Master\Sprinter\Sprinter;
use App\Models\Transaction\Order;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SprinterUpdateOrderStatus
{
    use Dispatchable, SerializesModels;

    public Sprinter $sprinter;
    public Order $order;
    public int $prevStatus;
    public int $nextStatus;
    public UpdateOrderStatus $job;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Sprinter $sprinter, Order $order,$prevStatus=Order::ORDER_STATUS_TAKEN,$nextStatus=Order::ORDER_STATUS_PRINT)
    {
        $this->prevStatus = $prevStatus;
        $this->nextStatus = $nextStatus;
        $this->job = new UpdateOrderStatus($order,$this->prevStatus,$this->nextStatus);
        $this->sprinter = $sprinter;
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle()
    {
        dispatch($this->job);

        if ($this->order->status === $this->job->order->status){
            $this->order = $this->job->order;
            event(new OrderStatusUpdatedBySprinter($this->sprinter,$this->order));
        }
        return $this->order->wasChanged();
    }
}
