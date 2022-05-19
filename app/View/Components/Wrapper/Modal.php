<?php

namespace App\View\Components\Wrapper;

use Illuminate\View\Component;

class Modal extends Component
{
    /**
     * @var null
     */
    public $name;
    /**
     * @var null
     */
    public $title;
    /**
     * @var null
     */
    public $body;
    /**
     * @var null
     */
    public $footer;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name = null, $title = null, $body = null, $footer = null)
    {
        //
        $this->name = $name;
        $this->title = $title;
        $this->body = $body;
        $this->footer = $footer;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.wrapper.modal');
    }
}
