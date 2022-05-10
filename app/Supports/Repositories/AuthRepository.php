<?php

namespace App\Supports\Repositories;

use App\Models\Master\Admin;
use App\Models\Master\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Rezky\LaravelResponseFormatter\Exception\Error;
use Rezky\LaravelResponseFormatter\Http\Code;

class AuthRepository
{
    public ?string $scopedGuard = null;
    public \Illuminate\Contracts\Auth\Factory|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Auth\StatefulGuard|\Illuminate\Contracts\Auth\Guard $scopedAuth;

    private \Closure $requestCallback;

    const GUARD_WEB = 'web';
    const GUARD_ADMIN = 'admin';


    public function __construct(\Closure $requestCallback)
    {
        $this->setScopedAuth();
        $this->requestCallback = $requestCallback;
    }

    public static function getAvailableGuard(): array
    {
        return [
            self::GUARD_ADMIN,
            self::GUARD_WEB
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
        $user = null;
        try {
            $user = $this->getUser();
        } catch (\Exception $exception) {

        }
        return $user ? $user->newQuery() : $this->getModel()::query();
    }

    public function getModel(): string
    {
        if ($this->isAdmin()) {
            return Admin::class;
        } else {
            return User::class;
        }
    }

    public function getUser(): User|Admin|null
    {

        $user = $this->scopedAuth->user();
        return $user;
    }

    public function isAdmin(): bool
    {
        return $this->scopedGuard === self::GUARD_ADMIN;
    }

    public function getRouteHome()
    {
        if ($this->isAdmin()) {
            return route('admin.pengajuan-legalisir.ijazah');
        } else {
            return route('profile');

        }
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
