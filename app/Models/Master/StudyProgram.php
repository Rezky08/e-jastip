<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
