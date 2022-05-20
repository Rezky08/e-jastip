<?php

namespace App\Models\Master;

use App\Traits\HasTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory,HasTable;

    protected $table = 'm_universities';


}
