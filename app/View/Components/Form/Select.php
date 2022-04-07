<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Select extends Component
{
    public array $options;
    public string $selected;

    /**
     * Create a new component instance.
     *
     * @param array $options
     * @param string|null $selected
     */
    public function __construct(array $options=[], string $selected=null)
    {
        //
        $this->options = $options;
        $this->selected = $selected;
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
