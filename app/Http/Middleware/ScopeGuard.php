<?php

namespace App\Http\Middleware;

use App\Supports\Repositories\AuthRepository;
use Closure;
use Illuminate\Http\Request;

class ScopeGuard
{
    public AuthRepository $repository;

    public function __construct(AuthRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,$guard)
    {
        $this->repository->setScopedGuard($guard);
        return $next($request);
    }
}
