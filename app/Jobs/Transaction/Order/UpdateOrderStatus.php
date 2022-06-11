<?php

namespace App\Jobs\Transaction\Order;

use App\Events\Transaction\Order\OrderStatusUpdated;
use App\Models\Transaction\Order;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Rezky\LaravelResponseFormatter\Exception\Error;
use Rezky\LaravelResponseFormatter\Http\Response;

class UpdateOrderStatus
{
    use Dispatchable, SerializesModels;

    public array $attributes;
    public Order $order;
    private int $prevStatus;
    private int $nextStatus;

    /**
     * Create a new job instance.
     *
     * @param Order $order
     * @param $status
     * @throws \Illuminate\Validation\ValidationException
     */
    public function __construct(Order $order, $prevStatus=Order::ORDER_STATUS_TAKEN,$nextStatus=Order::ORDER_STATUS_PRINT)
    {
        $this->order = $order;
        $this->attributes = Validator::make(['status' => $nextStatus], ['status' => Rule::in(array_keys(Order::getAvailableStatus()))])->validate();
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
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle()
    {
        $this->order->status = $this->attributes['status'];
        $this->order->save();
        if ($this->order->exists) {
            event(new OrderStatusUpdated($this->order));
        }
        return $this->order->wasChanged();
    }
}
