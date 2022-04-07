<?php
namespace App\View\Components\Global\Type;

interface TypeInterface{

    const TYPE_PRIMARY = 'primary';
    const TYPE_SECONDARY = 'secondary';
    const TYPE_SUCCESS = 'success';
    const TYPE_DANGER = 'danger';
    const TYPE_WARNING = 'warning';
    const TYPE_INFO = 'info';
    const TYPE_LIGHT = 'light';
    const TYPE_DARK = 'dark';

    public function getTypePrefixClass(): string;
    public function getType(): array;
}
