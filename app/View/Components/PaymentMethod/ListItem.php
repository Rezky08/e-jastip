<?php

namespace App\View\Components\PaymentMethod;

use App\Models\PaymentMethod\PaymentMethod;
use App\Supports\PaymentMethodSupport;
use Illuminate\View\Component;

class ListItem extends Component
{
    public array $paymentMethods;
    public string $name;

    /**
     * Create a new component instance.
     *
     * @param array $paymentMethods
     */
    public function __construct(array $paymentMethods = [], $name = "payment_method")
    {
        $this->paymentMethods = $paymentMethods;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.payment-method.list-item');
    }
}
