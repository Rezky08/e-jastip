<?php

namespace App\View\Components\React\Page\Sprinter\Order;

use Illuminate\View\Component;

class Ongoing extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.react.page.sprinter.order.ongoing');
    }
}
