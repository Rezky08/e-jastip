<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\HasTable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $code
 * @property string $name
 */
class Faculty extends Model
{
    use HasFactory,HasTable;
    protected $table = "m_faculties";
    protected $fillable = [
        'name',
        'code'
    ];

}
