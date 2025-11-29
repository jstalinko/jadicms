<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Support\Icons\Heroicon;
use Filament\Pages\Page;
use UnitEnum;

class Theme extends Page
{
    protected static ?int $navigationSort = 6;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::PaintBrush;

    protected static string|UnitEnum|null $navigationGroup = 'Customize';

    protected static ?string $navigationLabel = 'Theme';
 
    protected string $view = 'filament.pages.theme';
}
