<?php

namespace App\Traits;

use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

trait HasSocialLogin
{

    #[ArrayShape([self::SOCIAL_LOGIN_DRIVER_GOOGLE => "string"])] public static function getAvailableSocialLoginDrivers(): array
    {
        return [
            self::SOCIAL_LOGIN_DRIVER_GOOGLE => self::SOCIAL_LOGIN_DRIVER_GOOGLE_KEY,
            self::SOCIAL_LOGIN_DRIVER_FACEBOOK => self::SOCIAL_LOGIN_DRIVER_FACEBOOK_KEY
        ];
    }

    #[Pure] public static function getSocialLoginKey($driver = self::SOCIAL_LOGIN_DRIVER_GOOGLE): string|null
    {
        return self::getAvailableSocialLoginDrivers()[$driver] ?? null;
    }
}
