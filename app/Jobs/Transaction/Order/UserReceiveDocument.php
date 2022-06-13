<?php

namespace App\Jobs\Transaction\Order;

use App\Events\Transaction\Order\DocumentReceivedByUser;
use App\Models\Master\User\User;
use App\Models\Transaction\Order;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserReceiveDocument
{
    use Dispatchable,  SerializesModels;

    public Order $order;
    private User $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user,Order $order)
    {
        $this->order = $order;
        $this->job = new UpdateOrderStatus($this->order,Order::ORDER_STATUS_SHIPPING,Order::ORDER_STATUS_RECEIVED);
        $this->user = $user;
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
            event(new DocumentReceivedByUser($this->user,$this->order));
        }
        return $this->order->wasChanged();
    }
}
