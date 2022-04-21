<?php

namespace App\Supports;

class SettingSupport
{
    static public function getSettingByKey($keyName){
        return \App\Models\Setting\Setting::query()->where('key',$keyName)->first();
    }
}
