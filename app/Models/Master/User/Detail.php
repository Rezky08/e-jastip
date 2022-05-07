<?php

namespace App\Models\Master\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    protected $table = "m_user_details";
    protected $fillable = [
        "name",
        "student_id",
        "faculty_id",
        "study_program_id",
        "phone",
    ];
}
