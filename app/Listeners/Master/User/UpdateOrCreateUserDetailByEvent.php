<?php

namespace App\Listeners\Master\User;

use App\Events\Master\User\UserCreated;
use App\Jobs\Master\User\UpdateOrCreateUserDetail;
use App\Models\Master\User\User;

class UpdateOrCreateUserDetailByEvent
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if ($event instanceof UserCreated){
            /** @var User $user */
            $user = $event->user;
//            dd($user->only('name'));
            $job = new UpdateOrCreateUserDetail($user->only('name'),$user);
            dispatch($job);
        }
    }
}
