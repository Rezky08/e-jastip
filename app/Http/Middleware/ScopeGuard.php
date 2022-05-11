<?php

namespace App\Http\Middleware;

use App\Supports\Repositories\AuthRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

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
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $guard)
    {
        $this->repository->setScopedGuard($guard);
        view()->composer('*', function ($view) {
            $view->with('sidebar', $this->repository->getSidebar());
            $view->with('isAdmin', $this->repository->isAdmin());
            $view->with('user', $this->repository->getUser());

            $collection = new Collection();

            $this->repository->getRoutes()->each(function ($item, $key) use ($collection) {
                $collection->offsetSet($key, [
                    'uri' => $item->uri,
                    'methods' => $item->methods,
                ]);
            });

            if (!array_key_exists('laravelJs', $view->getData())) {
                $view->with('laravelJs', [
                    'is_authenticated' => auth()->check(),
                    'user' => auth()->user(),
                    'routes' => $collection,
                    'current_route' => empty(request()->route()) ? '' : request()->route()->getName(),
                    'request' => request()->all(),
                ]);
            }
        });
        return $next($request);
    }
}
