<?php

namespace App\Models\Master;

use App\Contracts\PaymentMethodAccountableContract;
use App\Models\Geo\City;
use App\Models\Geo\District;
use App\Models\Geo\Province;
use App\Models\Master\Sprinter\Sprinter;
use App\Models\Transaction\Transaction;
use App\Traits\HasTable;
use App\Traits\PaymentMethodAccountable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $province_id
 * @property int $city_id
 * @property int $district_id
 * @property string $name
 * @property Province $province
 * @property City $city
 * @property District $district
 * @property string $zip_code
 * @property string $address
 */
class University extends Model implements PaymentMethodAccountableContract
{
    use HasFactory, HasTable, PaymentMethodAccountable;

    protected $table = 'm_universities';

    protected $fillable = [
        'name',
        'province_id',
        'city_id',
        'district_id',
        'zip_code',
        'address',
    ];


    public function province(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id', 'province_id');
    }


    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'city_id');
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'district_id', 'district_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'university_id', 'id');
    }

    public function sprinters(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphedByMany(Sprinter::class, 'universitiable', 'm_universitiables', 'university_id', 'universitiable_id');
    }

    public function admins(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphedByMany(Admin::class, 'universitiable', 'm_universitiables', 'university_id', 'universitiable_id');
    }
}
