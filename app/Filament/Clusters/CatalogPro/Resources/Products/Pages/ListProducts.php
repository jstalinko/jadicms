<?php

namespace App\Filament\Clusters\CatalogPro\Resources\Products\Pages;

use App\Filament\Clusters\CatalogPro\Resources\Products\ProductResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    public function getTitle(): Htmlable|string
    {
        return 'Products';
    }

    public function getModelLabel(): ?string
    {
        return 'Product';
    }
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
