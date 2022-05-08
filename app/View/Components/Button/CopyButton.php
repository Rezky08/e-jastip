<?php

namespace App\View\Components\Button;

use Illuminate\View\Component;

class CopyButton extends Component
{
    public ?string $target;
    public ?string $class;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($target = "",$class="")
    {
        //
        $this->target = $target;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button.copy-button');
    }
}
