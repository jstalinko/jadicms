<?php

namespace App\Filament\Clusters\CatalogPro\Pages;

use App\Filament\Clusters\CatalogPro\CatalogProCluster;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class About extends Page
{
    protected string $view = 'CatalogPro::filament.clusters.catalog-pro.pages.about';

    protected static ?string $cluster = CatalogProCluster::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::InformationCircle;
    protected static ?int $navigationSort = 4;
}
