<?php

namespace App\Events\Transaction\Order;

use App\Models\Master\Sprinter;
use App\Models\Transaction\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderStatusUpdatedBySprinter
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Sprinter $sprinter;
    public Order $order;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Sprinter $sprinter, Order $order)
    {
        //
        $this->sprinter = $sprinter;
        $this->order = $order;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
