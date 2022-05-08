<?php

namespace App\Models\Master\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\HasTable;
use Illuminate\Database\Eloquent\Model;
use Propaganistas\LaravelPhone\Casts\E164PhoneNumberCast;

class Detail extends Model
{
    use HasFactory,HasTable;
    protected $table = "m_user_details";
    protected $fillable = [
        "name",
        "student_id",
        "faculty_id",
        "study_program_id",
        "phone",
        "validated_at"
    ];

    public $casts = [
        'phone' => E164PhoneNumberCast::class.':ID',
    ];

}
