<?php

namespace App\Traits;

trait HasTable
{
    static public function getInstance()
    {
        return new (get_called_class());
    }

    static public function getTableName(): string
    {
        $instance = self::getInstance();
        return $instance->getTable() ?? "";
    }
}
