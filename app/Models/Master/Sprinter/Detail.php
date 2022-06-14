<?php

namespace App\Models\Master\Sprinter;

use App\Traits\HasTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Propaganistas\LaravelPhone\Casts\E164PhoneNumberCast;

/**
 * @property string $name
 * @property string $phone
 */
class Detail extends Model
{
    use HasFactory, HasTable;

    protected $table = 'm_sprinter_details';

    protected $fillable = [
        'name',
        'phone'
    ];
    public $casts = [
        'phone' => E164PhoneNumberCast::class.':ID',
    ];

    public function sprinter(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Sprinter::class, 'sprinter_id', 'id');
    }
}
