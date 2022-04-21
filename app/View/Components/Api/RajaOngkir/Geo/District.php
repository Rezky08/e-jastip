<?php

namespace App\View\Components\Api\RajaOngkir\Geo;

use App\View\Components\Form\Select;

class District extends Select
{
    public string $parentName;

    /**
     * @param array $options
     * @param string|null $selected
     * @param string $parentName
     * @param string $name
     * @param string $label
     * @param string $error
     * @param string $helper
     * @param bool $isGroup
     * @param string $id
     */
    public function __construct(array $options = [], string $selected = null, string $parentName = "city_id", string $name = "district_id", string $label = "Kecamatan", string $error = "", string $helper = "", bool $isGroup = false, string $id = "")
    {
        parent::__construct($options, $selected, $name, $label, $error, $helper, $isGroup, $id);
        $this->parentName = $parentName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.api.raja-ongkir.geo.district');
    }
}
