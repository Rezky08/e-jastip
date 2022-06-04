<?php

namespace App\Models\Transaction;

use App\Contracts\TransactionLogableContract;
use App\Models\Master\Sprinter;
use App\Traits\HasTable;
use App\Traits\TransactionLogable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Transaction $transaction
 * @property int $status
 */
class Order extends Model implements TransactionLogableContract
{
    use HasFactory, HasTable,TransactionLogable;

    protected $table = "t_orders";

    protected $keyType = "string";

    const ORDER_STATUS_TAKEN = 1;
    const ORDER_STATUS_PRINT = 2;
    const ORDER_STATUS_LEGAL_PROCESS = 3;
    const ORDER_STATUS_SHIPPING_PREP = 4;
    const ORDER_STATUS_SHIPPING = 5;
    const ORDER_STATUS_RECEIVED = 6;
    const ORDER_STATUS_ARRIVED = 7;

    public function transaction(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'id');
    }

    public function sprinter(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Sprinter::class, 'sprinter_id', 'id');
    }

    static public function getAvailableStatus(): array
    {
        return [
            self::ORDER_STATUS_TAKEN => __('statuses.order.' . self::ORDER_STATUS_TAKEN),
            self::ORDER_STATUS_PRINT => __('statuses.order.' . self::ORDER_STATUS_PRINT),
            self::ORDER_STATUS_LEGAL_PROCESS => __('statuses.order.' . self::ORDER_STATUS_LEGAL_PROCESS),
            self::ORDER_STATUS_SHIPPING_PREP => __('statuses.order.' . self::ORDER_STATUS_SHIPPING_PREP),
            self::ORDER_STATUS_SHIPPING => __('statuses.order.' . self::ORDER_STATUS_SHIPPING),
            self::ORDER_STATUS_RECEIVED => __('statuses.order.' . self::ORDER_STATUS_RECEIVED),
            self::ORDER_STATUS_ARRIVED => __('statuses.order.' . self::ORDER_STATUS_ARRIVED),
        ];
    }
}
