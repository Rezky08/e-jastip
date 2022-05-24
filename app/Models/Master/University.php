<?php

namespace App\Models\Master;

use App\Models\Geo\City;
use App\Models\Geo\District;
use App\Models\Geo\Province;
use App\Models\Pivot\Master\AdminUniversity;
use App\Models\Transaction\Transaction;
use App\Traits\HasTable;
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
class University extends Model
{
    use HasFactory, HasTable;

    protected $table = 'm_universities';


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

    public function admins(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Admin::class, AdminUniversity::getTableName())->using(AdminUniversity::class);
    }
}
