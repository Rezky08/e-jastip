<?php

namespace App\View\Components\Api\RajaOngkir\Geo;

use App\View\Components\Form\Select;

class Province extends Select
{

    public function __construct(array $options = [], string $selected = null, string $name = "province_id", string $label = "Provinsi", string $error = "", string $helper = "", bool $isGroup = false, string $id = "")
    {
        parent::__construct($options, $selected, $name, $label, $error, $helper, $isGroup, $id);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.api.raja-ongkir.geo.province');
    }
}
