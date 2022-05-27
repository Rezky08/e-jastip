<?php

namespace App\View\Components\Form;

use App\View\Components\Wrapper\FormGroup;

class Input extends FormGroup
{
    public string $type;
    public ?string $placeholder;
    public ?bool $rounded;
    public mixed $value;

    /**
     * Create a new component instance.
     *
     * @param string $name
     * @param string $type
     * @param string $label
     * @param string $error
     * @param string $helper
     * @param bool $isGroup
     * @param string|null $placeholder
     */
    public function __construct(string $name = "", string $type = "", string $label = "", string $error = "", string $helper = "", bool $isGroup = false, string $placeholder = null, bool $rounded = false, $value = null)
    {
        $this->type = $type;
        parent::__construct($name, $label, $error, $helper, $isGroup);
        $this->placeholder = $placeholder;
        $this->rounded = $rounded;
        $this->value = $value;
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
