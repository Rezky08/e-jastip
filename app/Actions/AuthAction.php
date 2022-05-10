<?php

namespace App\Actions;

use App\Jobs\Master\User\CreateUser;
use App\Models\Master\Admin;
use App\Models\Master\User\User;
use App\Providers\RouteServiceProvider;
use App\Supports\Repositories\AuthRepository;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthAction
{

    public AuthRepository $repository;

    public function __construct(AuthRepository $repository)
    {
        $this->repository = $repository;
    }

    public function login($credentials = ['email' => null, 'password' => null]): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        Validator::make($credentials, [
            'email' => ['required', 'filled', 'exists:' . $this->repository->getModel()::getTableName() . ',email'],
            'password' => ['required', 'filled']
        ])->validate();
        // check user is exists
        /** @var Authenticatable|User|Admin $user */
        $user = $this->repository->queries()->where('email', $credentials['email'])->first();
        $isPasswordValid = Hash::check($credentials['password'], $user->password);
        if ($isPasswordValid) {
            $this->repository->scopedAuth->login($user);
            return redirect(RouteServiceProvider::HOME);
        } else {
            $errors = ValidationException::withMessages([
                'password' => 'silahkan periksa credential anda'
            ]);
            throw $errors;
        }
    }

    public function register($credentials = ['email' => null, 'password' => null, 'password_confirmation' => null])
    {
        $job = new CreateUser($credentials);
        dispatch($job);
        $user = $job->user;
        $this->repository->scopedAuth->login($user);
        return redirect(RouteServiceProvider::HOME);
    }

    public function logout()
    {
        $this->repository->scopedAuth->logout();
        return redirect(route('auth.login'));
    }

}
