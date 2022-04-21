<?php

namespace App\View\Components\Api\RajaOngkir\Cost;

use App\View\Components\Wrapper\FormGroup;
use Illuminate\View\Component;

class Select extends FormGroup
{
    public string $origin;
    public string $destination;
    public string $weight;

    /**
     * @param string $name
     * @param string $label
     * @param string $error
     * @param string $helper
     * @param bool $isGroup
     */
    public function __construct($origin="",$destination="",$weight="",string $name = "partner_shipment", string $label = "Kurir", string $error = "", string $helper = "", bool $isGroup = false)
    {
        parent::__construct($name, $label, $error, $helper, $isGroup);
        $this->origin = $origin;
        $this->destination = $destination;
        $this->weight = $weight;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.api.raja-ongkir.cost.select');
    }
}
