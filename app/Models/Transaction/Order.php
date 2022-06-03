<?php

namespace App\Models\Transaction;

use App\Models\Master\Sprinter;
use App\Traits\HasTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @property int $status
 */
class Order extends Model
{
    use HasFactory, HasTable;

    protected $table = "t_orders";

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected $keyType = "string";

    const ORDER_STATUS_TAKEN = 1;
    const ORDER_STATUS_PRINT = 2;
    const ORDER_STATUS_LEGAL_PROCESS = 3;
    const ORDER_STATUS_SHIPPING_PREP = 4;
    const ORDER_STATUS_SHIPPING = 5;
    const ORDER_STATUS_RECEIVED = 6;
    const ORDER_STATUS_ARRIVED = 7;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function (self $attachment) {
            $attachment->setAttribute($attachment->getKeyName(), (string)Str::orderedUuid()->toString());
        });
    }

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
