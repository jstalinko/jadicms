<?php

namespace Plugins\Catalog\src\Filament;

use Filament\Resources\Resource;
use Filament\Resources\Pages\ListRecords;
use Plugins\Catalog\src\Models\Catalog as CatalogModel;

class CatalogResource extends Resource
{
    protected static ?string $model = CatalogModel::class;

    public static function getPages(): array
    {
        return [
            'index' => ListRecords::route('/'),
        ];
    }
}
