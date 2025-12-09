<?php

namespace Plugins\CatalogPro\src\Filament\Pages;

use Filament\Pages\Page;
use UnitEnum;
use BackedEnum;
use Filament\Support\Icons\Heroicon;

class CatalogProIndex extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Square2Stack;
    protected static ?int $navigationSort = 7;
    protected static string|UnitEnum|null $navigationGroup = 'Plugins';
    protected string $view = 'CatalogPro::app';
    protected static ?string $navigationLabel = 'Catalog Pro';
}
