<?php

namespace App\Supports\Repositories;

use App\Models\Master\Admin;
use App\Models\Master\Sprinter;
use App\Models\Master\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Rezky\LaravelResponseFormatter\Exception\Error;
use Rezky\LaravelResponseFormatter\Http\Code;

class AuthRepository
{
    public ?string $scopedGuard = null;
    public \Illuminate\Contracts\Auth\Factory|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Auth\StatefulGuard|\Illuminate\Contracts\Auth\Guard $scopedAuth;

    private \Closure $requestCallback;

    const GUARD_WEB = 'web';
    const GUARD_ADMIN = 'admin';
    const GUARD_SPRINTER = 'sprinter';


    public function __construct(\Closure $requestCallback)
    {
        $this->setScopedAuth();
        $this->requestCallback = $requestCallback;
    }

    public static function getAvailableGuard(): array
    {
        return [
            self::GUARD_ADMIN,
            self::GUARD_WEB,
            self::GUARD_SPRINTER,

        ];
    }

    public function setScopedGuard($guard = null)
    {
        $this->scopedGuard = $guard;
        $this->setScopedAuth();
    }

    public function setScopedAuth($guard = null)
    {
        $this->scopedAuth = auth($guard ?? $this->scopedGuard);
    }

    public function queries(): \Illuminate\Database\Eloquent\Builder
    {
        $user = $this->getUser();
        return $user ? $user->newQuery() : $this->getModel()::query();
    }

    public function getModel(): string
    {
        if ($this->isAdmin()) {
            return Admin::class;
        } elseif ($this->isSprinter()) {
            return Sprinter::class;
        } else {
            return User::class;
        }
    }

    public function getUser(): User|Admin|Sprinter|null
    {

        $user = $this->scopedAuth->user();
        return $user;
    }

    public function isAdmin(): bool
    {
        return $this->scopedGuard === self::GUARD_ADMIN;
    }

    public function isSprinter(): bool
    {
        return $this->scopedGuard === self::GUARD_SPRINTER;
    }

    public function getRouteHome()
    {
        if ($this->isAdmin()) {
            return route('admin.pengajuan-legalisir.ijazah');
        } elseif ($this->isSprinter()) {
            return route('sprinter.order.incoming');
        } else {
            return route('profile');

        }
    }


    /**
     * Get route collection.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getRoutes(): Collection
    {
        $routes = Route::getRoutes()->getRoutesByName();
        return collect($routes)->filter(function ($route, $name) {
            if ($this->getUser() instanceof User and Str::startsWith($name, 'auth')) {
                return true;
            }

            if ($this->getUser() instanceof User and Str::startsWith($name, 'api')) {
                return true;
            }

            // add verify for user later
            if ($this->getUser() instanceof User and !(Str::startsWith($name, 'admin'))) {
                return true;
            }

            // add verify for admin later
            if ($this->getUser() instanceof Admin and Str::startsWith($name, 'admin')) {
                return true;
            }


            return false;
        });
    }

    public function getSidebar()
    {
        return Config::get('sidebar')[$this->scopedGuard ?? self::GUARD_WEB];
    }

    private function getRequest(): Request
    {
        $requestCallback = $this->requestCallback;

        return $requestCallback();
    }
}
