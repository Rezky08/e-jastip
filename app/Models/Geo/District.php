<?php

namespace App\Models\Geo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\HasTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * District model.
 *
 * @property int $district_id
 * @property int $city_id
 * @property string $district_name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Geo\City|null $city
 */
class District extends Model
{
    use HasFactory,HasTable;
    protected $table = "m_districts";
    protected $primaryKey = "district_id";
    protected $hidden = ['created_at', 'updated_at'];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class,"city_id","city_id");
    }
}
