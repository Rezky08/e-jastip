<?php

namespace App\Jobs\Transaction\Order;

use App\Events\Transaction\Order\OrderDocumentPrintedBySprinter;
use App\Models\Master\Sprinter;
use App\Models\Transaction\Order;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Rezky\LaravelResponseFormatter\Exception\Error;
use Rezky\LaravelResponseFormatter\Http\Response;

class SprinterPrintDocument
{
    use Dispatchable, SerializesModels;

    public Sprinter $sprinter;
    public Order $order;
    public int $status;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Sprinter $sprinter, Order $order)
    {
        $this->status = Order::ORDER_STATUS_TAKEN;
        $statusRemark = Order::getAvailableStatus()[$this->status];
        throw_if($order->status !== $this->status, Error::make(
            Response::CODE_ERROR_INVALID_DATA,
            [],
            __('validation.order.status.invalid', [
                'current_status' => Order::getAvailableStatus()[$order->status],
                'status' => $statusRemark
            ])
        ));
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
        $job = new UpdateOrderStatus($this->order, Order::ORDER_STATUS_PRINT);
        dispatch($job);

        if ($this->order->status === $job->order->status){
            $this->order = $job->order;
            event(new OrderDocumentPrintedBySprinter($this->sprinter,$this->order));
        }
        return $this->order->wasChanged();
    }
}
