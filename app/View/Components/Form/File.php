<?php

namespace App\View\Components\Form;

use App\View\Components\Wrapper\FormGroup;

class File extends FormGroup
{
    public ?string $placeholder;
    public ?bool $isMultiple;

    /**
     * @param string $name
     * @param string $label
     * @param string $error
     * @param string $helper
     * @param bool $isGroup
     * @param string|null $placeholder
     */
    public function __construct(string $name = "file", string $label = "", string $error = "", string $helper = "", bool $isGroup = false, string $placeholder = null, $isMultiple = false)
    {
        parent::__construct($name, $label, $error, $helper, $isGroup);
        $this->placeholder = $placeholder;
        $this->isMultiple = $isMultiple;
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
