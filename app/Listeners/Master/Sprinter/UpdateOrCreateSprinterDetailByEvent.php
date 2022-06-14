<?php

namespace App\Listeners\Master\Sprinter;

use App\Events\Master\Sprinter\SprinterCreated;
use App\Events\Master\User\UserCreated;
use App\Jobs\Master\Sprinter\UpdateOrCreateSprinterDetail;
use App\Jobs\Master\User\UpdateOrCreateUserDetail;
use App\Models\Master\Sprinter\Sprinter;
use App\Models\Master\User\User;

class UpdateOrCreateSprinterDetailByEvent
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        if ($event instanceof SprinterCreated) {
            /** @var Sprinter $user */
            $user = $event->sprinter;
//            dd($user->only('name'));
            $job = new UpdateOrCreateSprinterDetail($user->only('name'), $user);
            dispatch($job);
        }
    }
}
