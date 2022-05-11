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
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name = "table", $columns = [], $isLocalhost = true, $url = "")
    {
        //
        $this->name = "table-{$name}";
        $this->columns = $columns;
        $this->isLocalhost = $isLocalhost;
        $this->url = empty($url) ? "/".Route::current()->uri : $url;
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
