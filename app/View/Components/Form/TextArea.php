<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class TextArea extends Input
{
    public ?int $rows;
    public ?int $cols;
    public ?bool $noResize;

    /**
     * @param int|null $rows
     * @param int|null $cols
     * @param bool|null $noResize
     * @param string $name
     * @param string $type
     * @param string $label
     * @param string $error
     * @param string $helper
     * @param bool $isGroup
     * @param string|null $placeholder
     */
    public function __construct(int $rows=5, int $cols=null, bool $noResize=false, string $name = "", string $type = "", string $label = "", string $error = "", string $helper = "", bool $isGroup = false, string $placeholder = null)
    {
        parent::__construct($name, $type, $label, $error, $helper, $isGroup, $placeholder);
        $this->rows = $rows;
        $this->cols = $cols;
        $this->noResize = $noResize;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.text-area');
    }
}
