<?php

namespace App\View\Components\Form;

use App\View\Components\Wrapper\FormGroup;

class Select extends FormGroup
{
    public ?array $options;
    public ?string $selected;
    public ?string $id;

    /**
     * Create a new component instance.
     *
     * @param array $options
     * @param string|null $selected
     * @param string $name
     * @param string $label
     * @param string $error
     * @param string $helper
     * @param bool $isGroup
     * @param string $id
     */
    public function __construct(array $options = [], string $selected = null, string $name = "", string $label = "", string $error = "", string $helper = "", bool $isGroup = false, string $id = "")
    {
        $this->options = $options;
        $this->selected = $selected;
        $this->id = $id;

        parent::__construct($name, $label, $error, $helper, $isGroup);
    }

    public function isSelected($option): bool
    {
        return $this->selected === $option;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.select');
    }
}
