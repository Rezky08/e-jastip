<?php

namespace App\View\Components\Wrapper;

use Illuminate\View\Component;

class Collapse extends Component
{
    public ?string $name;
    public ?string $toggle;
    public ?bool $isCard;
    public ?string $component;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name="",$component="div",$toggle="",$isCard=true)
    {
        //

        if ($name==""){
            $str=rand();
            $randomName = md5($str);
            $name = $randomName;
        }

        $this->name = "collapse-".$name;
        $this->toggle = $toggle;
        $this->isCard = $isCard;
        $this->component = $component;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.wrapper.collapse');
    }
}
