<?php

namespace App\Models\Temporary;

use App\Traits\Invoiceable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Transaction extends Model
{
    use HasFactory,Invoiceable;
    protected $table = "temp_transactions";
    protected $fillable = [
        'user_id',
        'province_id',
        'city_id',
        'district_id',
        'zip_code',
        'address',
        'partner_shipment_code',
        'partner_shipment_service',
        'partner_shipment_price',
        'partner_shipment_etd',
        'status',
    ];
}
