<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class RadioCard extends Component
{
    public string $name;
    public string $value;
    public bool $fullWidth;

    /**
     * Create a new component instance.
     *
     * @param string $name
     * @param string $value
     * @param bool $fullWidth
     */
    public function __construct($name="",$value="",$fullWidth=true)
    {
        //
        $this->name = $name;
        $this->value = $value;
        $this->fullWidth = $fullWidth;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.radio-card');
    }
}
