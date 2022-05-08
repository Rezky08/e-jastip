<?php

namespace App\Models\Master\User;

use App\Models\Master\Faculty;
use App\Models\Master\StudyProgram;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\HasTable;
use Illuminate\Database\Eloquent\Model;
use Propaganistas\LaravelPhone\Casts\E164PhoneNumberCast;

/**
 * @property string $name
 * @property string $student_id
 * @property int $faculty_id
 * @property int $study_program_id
 * @property string $phone
 * @property \DateTime $phone_validated_at
 * @property Faculty $faculty
 * @property StudyProgram $studyProgram
 *
 */
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
        "phone_validated_at"
    ];

    public $casts = [
        'phone' => E164PhoneNumberCast::class.':ID',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function faculty(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Faculty::class, 'faculty_id', 'id');
    }

    public function studyProgram(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(StudyProgram::class, 'study_program_id', 'id');
    }
}
