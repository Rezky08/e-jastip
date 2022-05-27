<?php

namespace App\Http\Middleware;

use App\Supports\PageSupport;
use App\Supports\Repositories\AuthRepository;
use App\Supports\Repositories\TransactionRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ScopeGuard
{
    public AuthRepository $repository;
    public TransactionRepository $transactionRepository;

    public function __construct(AuthRepository $repository, TransactionRepository $transactionRepository)
    {
        $this->repository = $repository;
        $this->transactionRepository = $transactionRepository;
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
        $this->transactionRepository->setAuthRepository($this->repository);
        view()->composer('*', function ($view) {
            $sidebar = $this->repository->getSidebar();
            $currentSidebar = PageSupport::getCurrentSidebar($sidebar);
            $view->with('sidebar', $sidebar);
            $view->with('currentSidebar', $currentSidebar);
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
                    'is_authenticated' => $this->repository->scopedAuth->check(),
                    'is_admin' => $this->repository->isAdmin(),
                    'user' => $this->repository->scopedAuth->user(),
                    'routes' => $collection,
                    'current_route' => empty(request()->route()) ? '' : request()->route()->getName(),
                    'request' => request()->all(),
                ]);
            }
        });
        return $next($request);
    }
}
