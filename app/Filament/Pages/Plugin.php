<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use BackedEnum;
use UnitEnum;
use Filament\Support\Icons\Heroicon;
class Plugin extends Page
{

    protected static ?int $navigationSort = 7;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::PuzzlePiece;

    protected static string|UnitEnum|null $navigationGroup = 'Customize';

    protected static ?string $navigationLabel = 'Plugins';
    protected string $view = 'filament.pages.plugin';
}
