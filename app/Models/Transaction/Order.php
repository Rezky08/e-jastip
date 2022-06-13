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
 * @property string $receipt
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
    const ORDER_STATUS_LEGAL_PROCESSING = 5;
    const ORDER_STATUS_LEGAL_PROCESSED = 6;
    const ORDER_STATUS_PACKING = 7;
    const ORDER_STATUS_PACKED = 8;
    const ORDER_STATUS_TO_SHIPMENT_PARTNER = 9;
    const ORDER_STATUS_SHIPPING = 10;
    const ORDER_STATUS_RECEIVED = 11;
    const ORDER_STATUS_DONE = 12;

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
            self::ORDER_STATUS_TO_UNIVERSITY => "Menuju Universitas",
            self::ORDER_STATUS_ARRIVED_UNIVERSITY => "Sampai Universitas",
            self::ORDER_STATUS_LEGAL_PROCESSING => "Proses Legalisasi",
            self::ORDER_STATUS_LEGAL_PROCESSED => "Selesai Legalisasi",
            self::ORDER_STATUS_PACKING => "Pengemasan",
            self::ORDER_STATUS_PACKED => "Selesai Dikemas",
            self::ORDER_STATUS_TO_SHIPMENT_PARTNER => "Menuju Jasa Pengiriman",
            self::ORDER_STATUS_SHIPPING => "Dalam Pengiriman",
            self::ORDER_STATUS_RECEIVED => "Pesanan diterima",
            self::ORDER_STATUS_DONE => "Pesanan telah sampai ditujuan",
        ];
    }
}
