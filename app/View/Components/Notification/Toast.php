<?php

namespace App\View\Components\Notification;

use Illuminate\View\Component;

class Toast extends Component
{
    public ?string $title;
    public ?string $img;
    public ?string $altImg;
    /**
     * @var null
     */
    public $datetime;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = "", $img = "", $altImg = "", $datetime = null)
    {
        $this->title = empty($title) ? 'Notifikasi' : $title;
        $this->img = $img;
        $this->altImg = $altImg;
        $this->datetime = $datetime;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.notification.toast');
    }
}
