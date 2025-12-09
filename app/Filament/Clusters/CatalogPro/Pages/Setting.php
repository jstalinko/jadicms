<?php

namespace App\Filament\Clusters\CatalogPro\Pages;

use App\Filament\Clusters\CatalogPro\CatalogProCluster;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;

class Setting extends Page
{
    protected string $view = 'CatalogPro::filament.clusters.catalog-pro.pages.setting';

    protected static ?string $cluster = CatalogProCluster::class;
    protected static ?int $navigationSort = 2;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Cog6Tooth;

    public function getTitle(): string|Htmlable
    {
        return 'Settings';
    }
    public function getBreadcrumbs(): array
    {
        return [
            'index' => 'Catalog Pro',
            'setting' => 'Settings',
        ];
    }
}
