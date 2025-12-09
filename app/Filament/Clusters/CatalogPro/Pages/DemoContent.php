<?php

namespace App\Filament\Clusters\CatalogPro\Pages;

use App\Filament\Clusters\CatalogPro\CatalogProCluster;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use BackedEnum;

class DemoContent extends Page
{
    protected string $view = 'CatalogPro::filament.clusters.catalog-pro.pages.demo-content';

    protected static ?string $cluster = CatalogProCluster::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::ArrowDown;
    protected static ?int $navigationSort = 3;
}
