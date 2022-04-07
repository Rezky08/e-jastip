<?php
namespace App\View\Components\Global\Size;

interface SizeInterface{

    const SIZE_LARGE = 'lg';
    const SIZE_SMALL = 'sm';

    public function getSizePrefixClass(): string;
    public function getSize(): array;
}
