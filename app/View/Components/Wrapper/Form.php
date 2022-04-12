<?php

namespace App\View\Components\Wrapper;

use Illuminate\View\Component;

class Form extends Component
{
    public bool $isRow;
    public bool $isResponsive;

    /**
     * Create a new component instance.
     *
     * @param bool $isRow
     */
    public function __construct(bool $isRow = false,bool $isResponsive = true)
    {
        $this->isRow = $isRow;
        $this->isResponsive = $isResponsive;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.wrapper.form');
    }
}
