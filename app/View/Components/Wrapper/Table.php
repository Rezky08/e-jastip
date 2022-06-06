<?php

namespace App\View\Components\Wrapper;

use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class Table extends Component
{
    public ?string $name;
    public ?array $columns;
    public ?bool $isLocalhost;
    public ?string $url;
    /**
     * @var null
     */
    public $action;
    public ?bool $isServerSide;
    public ?array $options;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name = "table", $columns = [], $isLocalhost = true, $url = "", $action = null, $isServerSide=true,$options = [])
    {
        //
        $this->name = "table-{$name}";
        $this->columns = $columns;
        $this->isLocalhost = $isLocalhost;
        $routeName = Route::current()->getName();
        $currentRouteCompiled = $routeName ? \route($routeName,Route::current()->parameters) : Route::current()->uri;
        $this->url = empty($url) ? $currentRouteCompiled: $url;
        $this->action = $action;
        $this->isServerSide = $isServerSide;
        $this->options = $options;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.wrapper.table');
    }
}
