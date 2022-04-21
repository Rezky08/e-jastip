<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = "m_transactions";

    const TRANSACTION_STATUS_CREATED = 1;
    const TRANSACTION_STATUS_WAITING_PAYMENT = 2;
    const TRANSACTION_STATUS_PAID = 3;
    const TRANSACTION_STATUS_IN_PROGRESS = 4;
    const TRANSACTION_STATUS_DONE = 5;
    const TRANSACTION_STATUS_WAITING_PICKUP = 6;
    const TRANSACTION_STATUS_IN_SHIPPING = 7;
    const TRANSACTION_STATUS_ARRIVED = 8;
    const TRANSACTION_STATUS_CONFIRMED = 9;
    const TRANSACTION_STATUS_FINISHED = 10;

    static public function getAvailableStatus(): array
    {
        return [
            self::TRANSACTION_STATUS_CREATED,
            self::TRANSACTION_STATUS_WAITING_PAYMENT,
            self::TRANSACTION_STATUS_PAID,
            self::TRANSACTION_STATUS_IN_PROGRESS,
            self::TRANSACTION_STATUS_DONE,
            self::TRANSACTION_STATUS_WAITING_PICKUP,
            self::TRANSACTION_STATUS_IN_SHIPPING,
            self::TRANSACTION_STATUS_ARRIVED,
            self::TRANSACTION_STATUS_CONFIRMED,
            self::TRANSACTION_STATUS_FINISHED,
        ];
    }

}
