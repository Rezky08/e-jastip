<?php

namespace App\Actions;

use App\Jobs\Master\Sprinter\CreateSprinter;
use App\Jobs\Master\User\CreateUser;
use App\Models\Master\Admin;
use App\Models\Master\Sprinter\Sprinter;
use App\Models\Master\User\User;
use App\Supports\Repositories\AuthRepository;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;

class AuthAction
{

    public AuthRepository $repository;

    public function __construct(AuthRepository $repository)
    {
        $this->repository = $repository;
    }

    public function socialLogin($driver = User::SOCIAL_LOGIN_DRIVER_GOOGLE)
    {
        $model = $this->repository->getModel();
        $user = Socialite::driver($driver)->user();
        $driverKey = $model::getSocialLoginKey($driver);
        $finduser = $model::where($driverKey, $user->getId())->orWhere('email', 'ILIKE', $user->getEmail())->first();
        if ($finduser) {
            if (empty($finduser->$driverKey)) {
                $finduser->$driverKey = $user->getId();
                $finduser->save();
            }

            $this->repository->scopedAuth->login($finduser);
            return redirect($this->repository->getRouteHome());
        } else {
            $defaultPassword = env('SOCIAL_DEFAULT_PASSWORD');
            $credentials = [
                'name' => $user->getName(),
                'username' => $user->getEmail(),
                'email' => $user->getEmail(),
                $driverKey => $user->getId(),
                'password' => $defaultPassword,
                'password_confirmation' => $defaultPassword,
            ];
            return $this->register($credentials);
        }
    }

    public function login($credentials = ['email' => null, 'password' => null]): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        Validator::make($credentials, [
            'email' => ['required', 'filled', 'exists:' . $this->repository->getModel()::getTableName() . ',email'],
            'password' => ['required', 'filled']
        ])->validate();
        // check user is exists
        /** @var Authenticatable|User|Admin|Sprinter $user */
        $user = $this->repository->queries()->where('email', $credentials['email'])->first();
        $isPasswordValid = Hash::check($credentials['password'], $user->password);
        if ($isPasswordValid) {
            $this->repository->scopedAuth->login($user);
            return redirect($this->repository->getRouteHome());
        } else {
            $errors = ValidationException::withMessages([
                'password' => 'silahkan periksa credential anda'
            ]);
            throw $errors;
        }
    }

    public function register($credentials = ['email' => null, 'password' => null, 'password_confirmation' => null])
    {
        if ($this->repository->isSprinter()) {
            DB::transaction(function () use ($credentials, &$job) {
                $job = new CreateSprinter($credentials);
                dispatch($job);
            });
            $user = $job->sprinter;
        } else {
            DB::transaction(function () use ($credentials, &$job) {
                $job = new CreateUser($credentials);
                dispatch($job);
            });
            $user = $job->user;
        }

        $this->repository->scopedAuth->login($user);
        return redirect($this->repository->getRouteHome());
    }

    public function logout()
    {
        $homeRoute = $this->repository->getRouteLogin();
        $this->repository->scopedAuth->logout();
        return redirect($homeRoute);
    }

}
