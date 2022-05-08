<?php

namespace App\Models\Geo;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\HasTable;
use Illuminate\Database\Eloquent\Model;


/**
 * City model.
 *
 * @property int                                                                         $city_id
 * @property int                                                                         $province_id
 * @property string                                                                      $city_name
 * @property \Carbon\Carbon                                                              $created_at
 * @property \Carbon\Carbon                                                              $updated_at
 * @property Province                                                                    $province
 * @property Collection                                                                  $districts
 */
class City extends Model
{
    use HasFactory,HasTable;
    protected $table = "m_cities";
    protected $primaryKey = "city_id";
    protected $hidden =['created_at','updated_at'];

    public function province(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Province::class,'province_id','province_id');
    }

    public function districts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(District::class,'city_id','city_id');
    }
}
