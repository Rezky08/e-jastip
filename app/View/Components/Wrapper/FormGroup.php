<?php

namespace App\View\Components\Wrapper;

use App\Supports\StringSupport;
use Illuminate\View\Component;

class FormGroup extends Component
{
    public string $name;
    public string $label;
    public string $error;
    public string $helper;
    public bool $isGroup;

    /**
     * Create a new component instance.
     *
     * @param string $name
     * @param string $label
     * @param string $error
     * @param string $helper
     * @param bool $isGroup
     */
    public function __construct(string $name="", string $label="", string $error="", string $helper="",bool $isGroup=false)
    {
        $this->name = $name;
        $this->label = $label;
        $this->error = $error;
        $this->helper = $helper;
        $this->isGroup = $isGroup;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.wrapper.form-group');
    }
}
