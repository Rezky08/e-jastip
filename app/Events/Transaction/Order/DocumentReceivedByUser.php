<?php

namespace App\Events\Transaction\Order;

use App\Models\Master\User\User;
use App\Models\Transaction\Order;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DocumentReceivedByUser
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $user;
    public Order $order;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Order $order)
    {
        //
        $this->user = $user;
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
