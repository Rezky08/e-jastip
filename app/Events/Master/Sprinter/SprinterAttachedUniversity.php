<?php

namespace App\Events\Master\Sprinter;

use App\Models\Master\Sprinter;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SprinterAttachedUniversity
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Sprinter $sprinter;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Sprinter $sprinter)
    {
        //
        $this->sprinter = $sprinter;
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
