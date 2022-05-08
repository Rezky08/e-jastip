<?php

namespace App\Traits;

trait HasInstance
{
    static public function getInstance()
    {
        return new (get_called_class());
    }
}
