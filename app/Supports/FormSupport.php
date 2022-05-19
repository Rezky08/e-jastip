<?php

namespace App\Supports;

use App\Traits\HasInstance;

class FormSupport
{
    use HasInstance;

    public $formKey = "form";


    public static function storeFormData($data)
    {
        /** @var FormSupport $self */
        $self = self::getInstance();
        \Illuminate\Support\Facades\Session::flash($self->formKey, $data);
    }

    public static function getFormData($key)
    {
        /** @var FormSupport $self */
        $self = self::getInstance();
        return \Illuminate\Support\Facades\Session::get($self->formKey . "." . $key);
    }
}
