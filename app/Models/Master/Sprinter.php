<?php

namespace App\Models\Master;

use App\Contracts\UniversitiableContract;
use App\Traits\HasTable;
use App\Traits\Universitiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Sprinter extends Model implements UniversitiableContract
{
    use HasFactory, HasTable,Universitiable;

    protected $table = 'm_sprinters';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

}
