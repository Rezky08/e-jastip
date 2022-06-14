<?php

namespace App\Models\Master\Sprinter;

use App\Traits\HasTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory,HasTable;
    protected $table = 'm_sprinter_details';
}
