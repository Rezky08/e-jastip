<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class SelectApi extends Select
{
    public ?bool $isLocalhost;
    public ?string $url;
    public ?array $params;

    public function __construct(array $options = [], string $selected = null, string $name = "", string $label = "", string $error = "", string $helper = "", bool $isGroup = false, string $id = "", bool $autocomplete = true, bool $isLocalhost = true, string $url="", array $params=[])
    {
        $this->isLocalhost = $isLocalhost;
        $this->url = $url;
        $this->params = $params;

        parent::__construct($options, $selected, $name, $label, $error, $helper, $isGroup, $id, $autocomplete);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.select-api');
    }
}
