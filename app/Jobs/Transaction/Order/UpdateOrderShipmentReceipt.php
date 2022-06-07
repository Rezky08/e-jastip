<?php

namespace App\Jobs\Transaction\Order;

use App\Models\Transaction\Order;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Validator;

class UpdateOrderShipmentReceipt
{
    use Dispatchable,  SerializesModels;

    public Order $order;
    public array $attributes;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order, $attributes = [])
    {
        //
        $this->order = $order;
        $this->attributes = Validator::make($attributes, [
            'receipt' => ['required', 'filled']
        ])->validate();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->order->receipt = $this->attributes['receipt'];
        $this->order->save();
    }
}
