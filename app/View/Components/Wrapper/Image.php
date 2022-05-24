<?php

namespace App\View\Components\Wrapper;

use Illuminate\View\Component;

class Image extends Component
{
    public ?string $src;
    public ?string $alt;
    public ?string $classes;
    public ?string $name;
    public ?float $size;
    public ?float $height;
    public ?float $width;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name = null, $src = null, $alt = null, $classes = null, $size = 1, $width = 3, $height = 6)
    {
        //
        $this->src = $src;
        $this->alt = $alt ?? $name ?? $src;
        $this->classes = $classes;
        $this->name = $name ?? $alt;
        $this->size = $size;
        $this->width = bcmul($size , $width);
        $this->height = bcmul($size , $height);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.wrapper.image');
    }
}
