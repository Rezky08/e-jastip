<?php

namespace App\Supports\Notification;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;

class ToastSupport extends NotificationAbstract
{
    const NOTIFICATION_KEY = 'toast';

    public static function add($content = null, $title = null, $img = null, $altImg = null, $datetime = null,)
    {
        $self = self::getInstance();
        $key = $self->getKey();
        $data = [
            'title' => $title,
            'datetime' => $datetime,
            'img' => $img,
            'altImg' => $altImg,
            'content' => $content,
        ];
        $notifications = Session::get($key);
        $notifications = array_merge(Arr::wrap($notifications), [$data]);
        Session::flash($key, $notifications);
    }

    public function getNotificationKey(): string
    {
        return self::NOTIFICATION_KEY;
    }

}
