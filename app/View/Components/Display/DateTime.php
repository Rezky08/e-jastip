<?php

namespace App\View\Components\Display;

use Carbon\Carbon;
use Illuminate\View\Component;

class DateTime extends Component
{
    /**
     * @var null
     */
    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($value=null)
    {
        //
        $carbonTime = Carbon::createFromTimeString($value);
        $displayTime = $carbonTime->format('d M Y H:i:s');
        $this->value = $displayTime;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.display.date-time');
    }
}
