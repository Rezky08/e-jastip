<?php

namespace App\Http\Controllers;

use App\Actions\AuthAction;
use App\Contracts\SocialLoginContract;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver(SocialLoginContract::SOCIAL_LOGIN_DRIVER_GOOGLE)->redirect();
    }

    public function handleGoogleCallback()
    {
        $authAction = new AuthAction($this->authRepository);
        return $authAction->socialLogin(SocialLoginContract::SOCIAL_LOGIN_DRIVER_GOOGLE);
    }
}
