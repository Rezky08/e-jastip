<?php

namespace App\Supports\Repositories\UserRepository;

use App\Models\Master\User\User;

class Query
{
    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function transactionQuery(){
        return $this->user->transactions()->getQuery();
    }
}
