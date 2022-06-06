<?php

namespace App\Jobs\Transaction\Order;

use App\Events\Transaction\Order\OrderDocumentPrintedBySprinter;
use App\Events\Transaction\Order\OrderStatusUpdatedBySprinter;
use App\Models\Master\Sprinter;
use App\Models\Transaction\Order;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Rezky\LaravelResponseFormatter\Exception\Error;
use Rezky\LaravelResponseFormatter\Http\Response;

class SprinterUpdateOrderStatus
{
    use Dispatchable, SerializesModels;

    public Sprinter $sprinter;
    public Order $order;
    public int $prevStatus;
    public int $nextStatus;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Sprinter $sprinter, Order $order,$prevStatus=Order::ORDER_STATUS_TAKEN,$nextStatus=Order::ORDER_STATUS_PRINT)
    {
        $this->prevStatus = $prevStatus;
        $this->nextStatus = $nextStatus;
        $statusRemark = Order::getAvailableStatus()[$this->prevStatus];
        throw_if($order->status !== $this->prevStatus, Error::make(
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
        $job = new UpdateOrderStatus($this->order, $this->nextStatus);
        dispatch($job);

        if ($this->order->status === $job->order->status){
            $this->order = $job->order;
            event(new OrderStatusUpdatedBySprinter($this->sprinter,$this->order));
        }
        return $this->order->wasChanged();
    }
}
