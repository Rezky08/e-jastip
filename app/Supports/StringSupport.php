<?php

namespace App\Supports;

class StringSupport
{
    public static function convertArrayIntoDotKey($arrayKey = ""): array|string|null
    {
        $pattern = '/\]\[/';
        $pattern2 = '/(\]|\[)/';
        $pattern3 = '/\.$/';
        $replacement = '.';

        $result = preg_replace($pattern, $replacement, $arrayKey);
        $result = preg_replace($pattern2, $replacement, $result);
        return preg_replace($pattern3, "", $result);
    }
}
