<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class SelectApi extends Select
{
    public ?bool $isLocalhost;
    public ?string $url;
    public ?array $params;
    public ?string $chainSelector;
    public ?array $initiateParams;

    /**
     * @param array $options
     * @param string|null $selected
     * @param string $name
     * @param string $label
     * @param string $error
     * @param string $helper
     * @param bool $isGroup
     * @param string $id
     * @param bool $autocomplete
     * @param bool $isLocalhost
     * @param string $url
     * @param array $params
     * @param string $chainSelector
     */
    public function __construct(array $options = [], string $selected = null, string $name = "", string $label = "", string $error = "", string $helper = "", bool $isGroup = false, string $id = "", bool $autocomplete = true, bool $isLocalhost = true, string $url = "", array $params = [], string $chainSelector = "", bool $disabled = false, $rounded = false, $initiateParams = [])
    {
        $this->isLocalhost = $isLocalhost;
        $this->url = $url;
        $this->params = $params;

        parent::__construct($options, $selected, $name, $label, $error, $helper, $isGroup, $id, $autocomplete, $disabled, $rounded);
        $this->chainSelector = $chainSelector;
        $this->initiateParams = $initiateParams;
    }

    public function getPrefixId()
    {
        return "select-api-";
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
