<?php

namespace App\Models\Master\Sprinter;

use App\Contracts\UniversitiableContract;
use App\Models\Transaction\Order;
use App\Traits\HasTable;
use App\Traits\Universitiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

/**
 * @property string $name
 */
class Sprinter extends Authenticatable implements  UniversitiableContract
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

    protected $fillable = [
        'name',
        'email',
        'password',
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

    public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Order::class,'sprinter_id','id');
    }

}
