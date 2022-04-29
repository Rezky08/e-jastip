<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyProgram extends Model
{
    use HasFactory;

    public static function generateCodeFromName($name = "")
    {
        $name = preg_replace('/[^a-z0-9\s]+/i', '', $name);
        $names = explode(" ", $name);
        $result = "";
        foreach ($names as $word) {
            $result .= $word[0]??"";
        }
        return strtoupper($result);
    }
}
