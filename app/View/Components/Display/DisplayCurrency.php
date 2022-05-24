<?php

namespace App\View\Components\Display;

use Illuminate\View\Component;

class DisplayCurrency extends Component
{
    public string $amount;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($amount = 0)
    {
        $amount = (float)$amount;
        //
        $this->amount = $amount;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.display.display-currency');
    }
}
