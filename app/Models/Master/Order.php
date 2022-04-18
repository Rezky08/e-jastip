<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = "m_orders";

    const ORDER_STATUS_CREATED = 1;
    const ORDER_STATUS_WAITING_PAYMENT = 2;
    const ORDER_STATUS_PAID = 3;
    const ORDER_STATUS_IN_PROGRESS = 4;
    const ORDER_STATUS_DONE = 5;
    const ORDER_STATUS_WAITING_PICKUP = 6;
    const ORDER_STATUS_IN_SHIPPING = 7;
    const ORDER_STATUS_ARRIVED = 8;
    const ORDER_STATUS_CONFIRMED = 9;
    const ORDER_STATUS_FINISHED = 10;

    static public function getAvailableStatus(){
        return [
            self::ORDER_STATUS_CREATED,
            self::ORDER_STATUS_WAITING_PAYMENT,
            self::ORDER_STATUS_PAID,
            self::ORDER_STATUS_IN_PROGRESS,
            self::ORDER_STATUS_DONE,
            self::ORDER_STATUS_WAITING_PICKUP,
            self::ORDER_STATUS_IN_SHIPPING,
            self::ORDER_STATUS_ARRIVED,
            self::ORDER_STATUS_CONFIRMED,
            self::ORDER_STATUS_FINISHED,
        ];
    }

}
