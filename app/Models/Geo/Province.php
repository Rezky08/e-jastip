<?php

namespace App\Models\Geo;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Province model.
 *
 * @property int                                                                         $province_id
 * @property string                                                                      $province_name
 * @property \Carbon\Carbon                                                              $created_at
 * @property \Carbon\Carbon                                                              $updated_at
 * @property Collection                                                                  $cities
 *
 */
class Province extends Model
{
    use HasFactory;
    protected $table = "m_provinces";
    protected $primaryKey = "city_id";
    protected $hidden =['created_at','updated_at'];

    public function cities(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(City::class);
    }
}
