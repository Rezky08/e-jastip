<?php

namespace App\Actions;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthAction
{
    public function login($credentials = ['email' => '', 'password' => '']): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        Validator::make($credentials, [
            'email' => ['required', 'filled', 'exists:m_users,email'],
            'password' => ['required', 'filled']
        ])->validate();
        // check user is exists
        /** @var Authenticatable|User $user */
        $user = User::query()->where('email', $credentials['email'])->first();
        $isPasswordValid = Hash::check($credentials['password'],$user->password);
        if ($isPasswordValid){
            auth()->login($user);
            return redirect(RouteServiceProvider::HOME);
        }else{
            $errors = ValidationException::withMessages([
                'password' => 'silahkan periksa credential anda'
            ]);
            throw $errors;
        }
    }

    public function logout(){
        auth()->logout();
        return redirect(route('auth.login'));
    }
}
