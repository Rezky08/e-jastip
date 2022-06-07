<?php

namespace App\Jobs\Transaction\Order;

use App\Events\Transaction\Order\OrderGoToShipmentPartnerBySprinter;
use App\Events\Transaction\Order\OrderLegalProcessBySprinter;
use App\Events\Transaction\Order\OrderLegalDoneBySprinter;
use App\Events\Transaction\Order\OrderPackingBySprinter;
use App\Jobs\Transaction\Transaction\WriteTransactionLog;
use App\Models\Master\Sprinter;
use App\Models\Transaction\Order;
use App\Supports\TransactionLogSupport;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SprinterToShipmentPartner
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
    public function __construct(Sprinter $sprinter, Order $order)
    {
        $this->sprinter = $sprinter;
        $this->order = $order;
        $this->transaction = $order->transaction;
        $this->job = new SprinterUpdateOrderStatus($this->sprinter,$this->order,Order::ORDER_STATUS_PACKED,Order::ORDER_STATUS_TO_SHIPMENT_PARTNER);
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
            event(new OrderGoToShipmentPartnerBySprinter($this->sprinter,$this->order));
        }
        return $this->order->wasChanged();
    }
}
