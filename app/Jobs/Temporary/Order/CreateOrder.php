<?php

namespace App\Jobs\Temporary\Order;

use App\Events\Temporary\Order\OrderCreated;
use App\Models\Master\Order;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CreateOrder
{
    use Dispatchable, SerializesModels;

    protected array $attributes;
    public \App\Models\Temporary\Order $order;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($attributes = [],$status = Order::ORDER_STATUS_CREATED)
    {
        $attributes = array_merge(['status'=>$status],$attributes);
        $this->attributes = Validator::make($attributes, [
            'province_id' => ['required', 'filled', 'exists:provinces,province_id'],
            'city_id' => ['required', 'filled', 'exists:cities,city_id'],
            'district_id' => ['required', 'filled', 'exists:districts,district_id'],
            'zip_code' => ['required', 'filled'],
            'address' => ['nullable'],
            'partner_shipment_code' => ['nullable'],
            'partner_shipment_service' => ['nullable'],
            'partner_shipment_price' => ['nullable'],
            'partner_shipment_etd' => ['nullable'],
            'status' => ['required',Rule::in(Order::getAvailableStatus())]
        ])->validate();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // TODO: Assign Into Existing User
        $this->attributes['user_id'] = 1;
        $this->order = new \App\Models\Temporary\Order($this->attributes);
        $this->order->save();

        if ($this->order->exists){
            \event(new OrderCreated($this->order));
        }
    }
}
