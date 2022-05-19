<?php

namespace App\View\Components\Form;

use App\View\Components\Wrapper\FormGroup;
use Illuminate\View\Component;

class DisplayText extends FormGroup
{
    public function __construct(string $name = "", string $label = "", string $error = "", string $helper = "", bool $isGroup = false)
    {
        parent::__construct($name, $label, $error, $helper, $isGroup);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.display-text');
    }
}
