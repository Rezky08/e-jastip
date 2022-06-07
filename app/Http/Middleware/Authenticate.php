<?php

namespace App\Http\Middleware;

use App\Supports\Repositories\AuthRepository;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate extends Middleware
{
    public AuthRepository $authRepository;

    public function __construct(Auth $auth, AuthRepository $authRepository)
    {
        parent::__construct($auth);
        $this->authRepository = $authRepository;
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return $this->authRepository->getRouteLogin();
        }
    }
}
