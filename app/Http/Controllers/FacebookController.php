<?php

namespace App\Http\Controllers;

use App\Actions\AuthAction;
use App\Contracts\SocialLoginContract;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function redirectToFacebook(){
        return Socialite::driver(SocialLoginContract::SOCIAL_LOGIN_DRIVER_FACEBOOK)->redirect();
    }

    public function handleFacebookCallback(){
        $authAction = new AuthAction($this->authRepository);
        return $authAction->socialLogin(SocialLoginContract::SOCIAL_LOGIN_DRIVER_FACEBOOK);
    }
}
