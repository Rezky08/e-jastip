<?php

namespace App\Models\Pivot\Transaction;

use App\Models\Transaction\Order;
use App\Models\Transaction\Transaction;
use App\Traits\HasTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Jalameta\Attachments\Concerns\Attachable;
use Jalameta\Attachments\Contracts\AttachableContract;

class TransactionLogablePivot extends MorphPivot implements AttachableContract
{
    use HasFactory, HasTable, Attachable;

    public $incrementing = true;

    public $timestamps = true;

    const LOG_TYPE_ORDER = 'Order';
    const LOG_TYPE_TRANSACTION = 'Transaksi';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 't_transaction_logables';


    /**
     * @var array
     */
    protected $hidden = [
        'transaction_logable_id',
        'transaction_logable_type',
        'transaction_id',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'transaction_id',
        'transaction_logable_type',
        'transaction_logable_id',
        'remark',
    ];

    public static function getAvailableTypes()
    {
        return [
            Order::class => self::LOG_TYPE_ORDER,
            Transaction::class => self::LOG_TYPE_TRANSACTION,
        ];
    }

}
