<?php

namespace App\View\Components\Form;

use App\View\Components\Wrapper\FormGroup;

class File extends FormGroup
{
    public ?string $placeholder;

    /**
     * @param string $name
     * @param string $label
     * @param string $error
     * @param string $helper
     * @param bool $isGroup
     * @param string|null $placeholder
     */
    public function __construct(string $name = "", string $label = "", string $error = "", string $helper = "", bool $isGroup = false, string $placeholder=null)
    {
        parent::__construct($name, $label, $error, $helper, $isGroup);
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.file');
    }
}
