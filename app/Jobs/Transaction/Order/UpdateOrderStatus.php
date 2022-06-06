<?php

namespace App\Jobs\Transaction\Order;

use App\Events\Transaction\Order\OrderStatusUpdated;
use App\Models\Transaction\Order;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UpdateOrderStatus
{
    use Dispatchable, SerializesModels;

    public array $attributes;
    public Order $order;

    /**
     * Create a new job instance.
     *
     * @param Order $order
     * @param $status
     * @throws \Illuminate\Validation\ValidationException
     */
    public function __construct(Order $order, $status)
    {
        $this->order = $order;
        $this->attributes = Validator::make(['status' => $status], ['status' => Rule::in(array_keys(Order::getAvailableStatus()))])->validate();
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
