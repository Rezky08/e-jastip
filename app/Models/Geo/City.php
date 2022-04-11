<?php

namespace App\Models\Geo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * City model.
 *
 * @property int                                                                         $city_id
 * @property int                                                                         $province_id
 * @property string                                                                      $city_name
 * @property \Carbon\Carbon                                                              $created_at
 * @property \Carbon\Carbon                                                              $updated_at
 *
 */
class City extends Model
{
    use HasFactory;
    protected $primaryKey = "city_id";
    protected $hidden =['created_at','updated_at'];

}
