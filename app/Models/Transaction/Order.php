<?php

namespace App\Models\Transaction;

use App\Contracts\TransactionLogableContract;
use App\Models\Master\Sprinter;
use App\Traits\HasTable;
use App\Traits\TransactionLogable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jalameta\Attachments\Concerns\Attachable;
use Jalameta\Attachments\Contracts\AttachableContract;

/**
 * @property Transaction $transaction
 * @property int $status
 */
class Order extends Model implements TransactionLogableContract,AttachableContract
{
    use HasFactory, HasTable,TransactionLogable,Attachable;

    protected $table = "t_orders";

    protected $keyType = "string";

    const ORDER_STATUS_TAKEN = 1;
    const ORDER_STATUS_PRINT = 2;
    const ORDER_STATUS_TO_UNIVERSITY = 3;
    const ORDER_STATUS_ARRIVED_UNIVERSITY = 4;
    const ORDER_STATUS_LEGAL_PROCESS = 5;
    const ORDER_STATUS_LEGAL_PROCESS_DONE = 6;
    const ORDER_STATUS_SHIPPING_PREP = 7;
    const ORDER_STATUS_SHIPPING_PREP_DONE = 8;
    const ORDER_STATUS_SHIPPING = 9;
    const ORDER_STATUS_RECEIVED = 10;
    const ORDER_STATUS_ARRIVED = 11;

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
            self::ORDER_STATUS_TAKEN => 'Pesanan Diambil',
            self::ORDER_STATUS_PRINT => "Pesanan Dicetak",
            self::ORDER_STATUS_TO_UNIVERSITY => "Sprinter Menuju Universitas",
            self::ORDER_STATUS_ARRIVED_UNIVERSITY => "Sprinter Sampai di Universitas",
            self::ORDER_STATUS_LEGAL_PROCESS => "Pesanan dalam proses Legalisasi",
            self::ORDER_STATUS_LEGAL_PROCESS_DONE => "Pesanan selesai proses Legalisasi",
            self::ORDER_STATUS_SHIPPING_PREP => "Pesanan dalam persiapan pengiriman",
            self::ORDER_STATUS_SHIPPING_PREP_DONE => "Pesanan selesai persiapan pengiriman",
            self::ORDER_STATUS_SHIPPING => "Pesanan dalam pengiriman",
            self::ORDER_STATUS_RECEIVED => "Pesanan diterima",
            self::ORDER_STATUS_ARRIVED => "Pesanan telah sampai ditujuan",
        ];
    }
}
