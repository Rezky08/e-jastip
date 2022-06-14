<?php

namespace App\Contracts;

interface SocialLoginContract
{
    const SOCIAL_LOGIN_DRIVER_GOOGLE = 'google';
    const SOCIAL_LOGIN_DRIVER_GOOGLE_KEY = 'google_id';

    const SOCIAL_LOGIN_DRIVER_FACEBOOK = 'facebook';
    const SOCIAL_LOGIN_DRIVER_FACEBOOK_KEY = 'facebook_id';

    public static function getAvailableSocialLoginDrivers(): array;

    public static function getSocialLoginKey(): string|null;
}
