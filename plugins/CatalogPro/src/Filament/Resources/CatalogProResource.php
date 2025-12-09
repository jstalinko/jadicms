<?php

namespace Plugins\CatalogPro\src\Filament\Resources;

use App\Models\Post;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class CatalogProResource extends Resource
{


    protected static string|BackedEnum|null $navigationIcon = Heroicon::Square2Stack;

    protected string $view = 'CatalogPro::app';
    protected static ?string $model = Post::class;

    protected static ?string $navigationLabel = 'Catalog Pro';
    protected static ?string $slug = 'catalog-pro';
    protected static string|UnitEnum|null $navigationGroup = 'Plugins';
}
