<?php

namespace App\View\Components\Form;

use App\View\Components\Global\Size\SizeInterface;
use App\View\Components\Global\Size\SizeTrait;
use App\View\Components\Global\Type\TypeTrait;
use App\View\Components\Global\Type\TypeInterface;
use Illuminate\View\Component;

class Button extends Component implements SizeInterface,TypeInterface
{
    use SizeTrait,TypeTrait;

    public string $variant;
    public string $type;
    public string $size;
    public bool $outline;
    public bool $fullWidth;
    public bool $isSubmit;

    /**
     * Create a new component instance.
     *
     * @param string $variant
     * @param string|null $type
     * @param string $size
     * @param bool $outline
     * @param bool $fullWidth
     */
    public function __construct(string $variant = "", string $type = null, string $size = null, bool $outline = false, bool $fullWidth = false,bool $isSubmit=false)
    {
        //
        $this->variant = $variant;
        $this->outline = $outline;
        $this->fullWidth = $fullWidth;
        $this->size = $this->getType()[$size] ?? "";
        $this->type = $this->getType()[$type ?? self::TYPE_PRIMARY];
        $this->isSubmit = $isSubmit;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.button');
    }

    public function getTypePrefixClass(): string
    {
        if ($this->outline) {
            return "btn-outline-";
        } else {
            return "btn-";
        }
    }
    public function getSizePrefixClass(): string
    {
        return "btn-";
    }

}
