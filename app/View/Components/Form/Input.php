<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Input extends Component
{
    public string $name;
    public string $label;
    public string $error;
    public string $helper;
    public string $type;
    public bool $isGroup;

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
        $this->name = $name;
        $this->label = $label;
        $this->error = $error;
        $this->helper = $helper;
        $this->type = $type;
        $this->isGroup = $isGroup;
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
