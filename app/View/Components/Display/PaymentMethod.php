<?php

namespace App\View\Components\Display;

use App\Models\PaymentMethod\PaymentMethod as PaymentMethodModel;
use Illuminate\View\Component;

class PaymentMethod extends Component
{
    public array|PaymentMethodModel $paymentMethod;
    /**
     * @var mixed|string|null
     */
    public mixed $icon;
    /**
     * @var mixed|string|null
     */
    public mixed $label;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(PaymentMethodModel|array $paymentMethod)
    {
        //
        $this->paymentMethod = $paymentMethod;
        $this->icon = $paymentMethod->icon ?? $paymentMethod['icon'] ?? null;
        $this->label = $paymentMethod->label ?? $paymentMethod['label'] ?? null;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.display.payment-method');
    }
}
