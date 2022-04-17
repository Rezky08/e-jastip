<?php

namespace App\View\Components\PaymentMethod;

use Illuminate\View\Component;

class Item extends Component
{
    public ?string $name;
    public ?string $value;
    public ?string $icon;
    public ?bool $isActive;

    /**
     * Create a new component instance.
     *
     * @param string $name
     * @param string $value
     * @param string $icon
     * @param bool $isActive
     */
    public function __construct($name="",$value="",$icon="",$isActive = true)
    {
        //
        $this->name = $name;
        $this->value = $value;
        $this->icon = $icon;
        $this->isActive = $isActive;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.payment-method.item');
    }
}
