<?php

namespace App\Events\Master\University;

use App\Contracts\UniversitiableContract;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UniversitiableAttached
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public UniversitiableContract $universitiable;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(UniversitiableContract $universitiable)
    {
        //
        $this->universitiable = $universitiable;
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
