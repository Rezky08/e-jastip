<?php

namespace App\View\Components\Invoice;

use Illuminate\View\Component;

class PriceItem extends Component
{
    public string $name;
    public string $price;
    public bool $isDiscount;

    /**
     * Create a new component instance.
     *
     * @param string $name
     * @param float|int $price
     * @param bool $isDiscount
     */
    public function __construct(string $name="", float|int $price=0,bool $isDiscount = false)
    {
        //
        $this->name = $name;
        $this->price = number_format($price);
        $this->isDiscount = $isDiscount;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.invoice.price-item');
    }
}
