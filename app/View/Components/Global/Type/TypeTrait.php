<?php

namespace App\View\Components\Global\Type;

trait TypeTrait {
    public function getTypePrefixClass(): string
    {
        return "";
    }
    public function getType(): array
    {
        $prefix = $this->getTypePrefixClass();
        return [
            TypeInterface::TYPE_PRIMARY => $prefix.TypeInterface::TYPE_PRIMARY,
            TypeInterface::TYPE_SECONDARY => $prefix.TypeInterface::TYPE_SECONDARY,
            TypeInterface::TYPE_SUCCESS => $prefix.TypeInterface::TYPE_SUCCESS,
            TypeInterface::TYPE_DANGER => $prefix.TypeInterface::TYPE_DANGER,
            TypeInterface::TYPE_WARNING => $prefix.TypeInterface::TYPE_WARNING,
            TypeInterface::TYPE_INFO => $prefix.TypeInterface::TYPE_INFO,
            TypeInterface::TYPE_LIGHT => $prefix.TypeInterface::TYPE_LIGHT,
            TypeInterface::TYPE_DARK => $prefix.TypeInterface::TYPE_DARK,
        ];
    }
}
