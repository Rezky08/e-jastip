<?php

namespace App\View\Components\Invoice;

use Illuminate\View\Component;

class PaymentConfirmation extends Component
{
    /**
     * @var null
     */
    public $id;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id=null)
    {
        //
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.invoice.payment-confirmation');
    }
}
