<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $faculty_id
 * @property string $code
 * @property string $name
 * @property Faculty $faculty
 */
class StudyProgram extends Model
{
    use HasFactory;

    protected $table = 'm_study_programs';

    public static function generateCodeFromName($name = "")
    {
        $name = preg_replace('/[^a-z0-9\s]+/i', '', $name);
        $names = explode(" ", $name);
        $result = "";
        foreach ($names as $word) {
            $result .= $word[0] ?? "";
        }
        // check exists
        $query = self::query();
        $studyProgramSimiliarCount = $query->where('code', 'ilike', $result . '%')->count();
        if ($studyProgramSimiliarCount > 0) {
            $result .= $studyProgramSimiliarCount;
        }

        return strtoupper($result);
    }

    public function faculty(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Faculty::class, "faculty_id", 'id');
    }
}
