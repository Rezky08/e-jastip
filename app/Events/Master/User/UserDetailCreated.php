<?php

namespace App\Events\Master\User;

use App\Models\Master\User\Detail;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserDetailCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Detail $detail;

    /**
     * Create a new event instance.
     *
     * @param Detail $detail
     */
    public function __construct(Detail $detail)
    {
        //
        $this->detail = $detail;
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
