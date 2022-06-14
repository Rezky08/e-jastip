<?php

namespace App\Jobs\Transaction\Order;

use App\Events\Transaction\Order\OrderLegalProcessBySprinter;
use App\Models\Master\Sprinter\Sprinter;
use App\Models\Transaction\Order;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SprinterLegalProcess
{
    use Dispatchable, SerializesModels;

    public Sprinter $sprinter;
    public Order $order;
    public SprinterUpdateOrderStatus $job;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Sprinter $sprinter, Order $order)
    {
        $this->sprinter = $sprinter;
        $this->order = $order;
        $this->job = new SprinterUpdateOrderStatus($this->sprinter,$this->order,Order::ORDER_STATUS_ARRIVED_UNIVERSITY,Order::ORDER_STATUS_LEGAL_PROCESSING);
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
        if ($this->order->wasChanged()){
            event(new OrderLegalProcessBySprinter($this->sprinter,$this->order));
        }
        return $this->order->wasChanged();
    }
}
