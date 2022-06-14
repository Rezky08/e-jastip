<?php

namespace App\Events\Master\Sprinter;

use App\Models\Master\Sprinter\Detail;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SprinterDetailCreated
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
