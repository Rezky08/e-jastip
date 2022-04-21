<?php

namespace App\Models\Transaction\Invoice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\ArrayShape;

class Detail extends Model
{
    use HasFactory;

    protected $table = "t_invoice_details";

    const INVOICE_DETAIL_TYPE_SHIPMENT = 1;
    const INVOICE_DETAIL_TYPE_SERVICE = 2;
    const INVOICE_DETAIL_TYPE_DISCOUNT = 3;

    protected $fillable = [
        'invoice_id',
        'type',
        'name',
        'price',
        'note'
    ];

    #[ArrayShape([self::INVOICE_DETAIL_TYPE_SHIPMENT => "array", self::INVOICE_DETAIL_TYPE_SERVICE => "array", self::INVOICE_DETAIL_TYPE_DISCOUNT => "array"])] static public function getAvailableType(): array
    {
        return [
            self::INVOICE_DETAIL_TYPE_SHIPMENT => [
                'type' => self::INVOICE_DETAIL_TYPE_SHIPMENT,
                'name' => "Biaya Pengiriman"
            ],
            self::INVOICE_DETAIL_TYPE_SERVICE => [
                'type' => self::INVOICE_DETAIL_TYPE_SERVICE,
                'name' => "Biaya Layanan"
            ],
            self::INVOICE_DETAIL_TYPE_DISCOUNT => [
                'type' => self::INVOICE_DETAIL_TYPE_DISCOUNT,
                'name' => "Potongan Harga"
            ],
        ];
    }

    public function invoice(){
        return $this->belongsTo(Invoice::class,"invoice_id","id");
    }

}
