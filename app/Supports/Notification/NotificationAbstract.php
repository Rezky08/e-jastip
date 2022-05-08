<?php

namespace App\Supports\Notification;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use JetBrains\PhpStorm\Pure;

abstract class NotificationAbstract
{

    const NOTIFICATION_PREFIX = 'notification';

    public static $instance;

    public function __construct()
    {
        self::$instance = $this;
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new (get_called_class());
        }
        return self::$instance;
    }

    public function getNotificationKey(): string
    {
        return 'notif';
    }

    #[Pure] public function getKey(): string
    {
        return self::NOTIFICATION_PREFIX . "." . $this->getNotificationKey();
    }

    /**
     * @param $content
     * @param $title
     * @param $img
     * @param $altImg
     * @param $datetime
     * @return void
     */
    static public function add(
        $content = null,
        $title = null,
        $img = null,
        $altImg = null,
        $datetime = null,
    )
    {

    }

    public static function get()
    {
        $self = self::getInstance();
        $key = $self->getKey();
        $data = Arr::wrap(Session::get($key));
        Session::remove($key);
        return $data;
    }
}
