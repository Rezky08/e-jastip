<?php

namespace App\View\Components\Form;

use App\View\Components\Wrapper\FormGroup;
use Illuminate\View\Component;

class Input extends FormGroup
{
    public string $type;
    /**
     * Create a new component instance.
     *
     * @param string $name
     * @param string $type
     * @param string $label
     * @param string $error
     * @param string $helper
     * @param bool $isGroup
     */
    public function __construct(string $name="", string $type="", string $label="", string $error="", string $helper="",bool $isGroup=false)
    {
        $this->type = $type;
        parent::__construct($name,$label,$error,$helper,$isGroup);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.input');
    }
}
