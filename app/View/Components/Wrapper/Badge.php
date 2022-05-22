<?php

namespace App\View\Components\Wrapper;

use App\View\Components\Global\Size\SizeInterface;
use App\View\Components\Global\Size\SizeTrait;
use App\View\Components\Global\Type\TypeInterface;
use App\View\Components\Global\Type\TypeTrait;
use Illuminate\View\Component;

class Badge extends Component implements SizeInterface, TypeInterface
{
    use SizeTrait, TypeTrait;

    public ?string $variant;
    public ?string $type;
    public ?string $size;
    public ?bool $pill;
    public $content;

    /**
     * Create a new component instance.
     *
     * @param string $variant
     * @param string|null $type
     * @param string|null $size
     * @param bool $pill
     */
    public function __construct(string $variant = "", string $type = null, string $size = null, bool $pill = false)
    {
        $this->size = $this->getSize()[$size] ?? "";
        $this->type = $this->getType()[$type ?? self::TYPE_PRIMARY];
        $this->pill = $pill;
        $this->variant = $variant;
        $this->content = null;
    }

    public function getTypePrefixClass(): string
    {
        return "badge-";
    }

    public function getSizePrefixClass(): string
    {
        return "badge-";
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.wrapper.badge');
    }
}
