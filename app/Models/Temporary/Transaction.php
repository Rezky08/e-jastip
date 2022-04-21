<?php

namespace App\Models\Temporary;

use App\Contracts\InvoiceableContract;
use App\Models\Geo\City;
use App\Models\Geo\District;
use App\Models\Geo\Province;
use App\Models\User;
use App\Traits\Invoiceable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $user_id
 * @property string $province_id
 * @property string $city_id
 * @property string $district_id
 * @property string $zip_code
 * @property string $address
 * @property string $partner_shipment_code
 * @property string $partner_shipment_service
 * @property string $partner_shipment_price
 * @property string $partner_shipment_etd
 * @property string $status
 * @property Province $province
 * @property City $city
 * @property District $district
 * @property Collection $invoices
 */
class Transaction extends Model implements InvoiceableContract
{
    use HasFactory, Invoiceable;

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

    function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function province(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Province::class,'province_id','province_id');
    }


    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class,'city_id','city_id');
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class,'district_id','district_id');
    }

}
