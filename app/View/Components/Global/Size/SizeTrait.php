<?php

namespace App\View\Components\Global\Size;

trait SizeTrait {
    public function getSizePrefixClass(): string
    {
        return "";
    }
    public function getSize(): array
    {
        $prefix = $this->getSizePrefixClass();
        return [
            SizeInterface::SIZE_LARGE => $prefix.SizeInterface::SIZE_LARGE,
            SizeInterface::SIZE_SMALL => $prefix.SizeInterface::SIZE_SMALL,
        ];
    }
}
