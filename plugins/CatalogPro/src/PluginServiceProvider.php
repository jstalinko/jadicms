<?php

namespace Plugins\CatalogPro\src;

use Filament\Facades\Filament;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class PluginServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Plugin Routes
        |--------------------------------------------------------------------------
         */
        if (file_exists(dirname(__DIR__) . "/routes/web.php")) {
            Route::middleware('web')
                ->group(dirname(__DIR__) . "/routes/web.php");
        }
        if (file_exists(dirname(__DIR__) . "/routes/api.php")) {
            Route::middleware('api')
                ->prefix('api')
                ->group(dirname(__DIR__) . "/routes/api.php");
        }

        /*
        |--------------------------------------------------------------------------
        | Plugin Migrations
        |--------------------------------------------------------------------------
         */
        if (is_dir(dirname(__DIR__) . "/database/migrations")) {
            $this->loadMigrationsFrom(dirname(__DIR__) . "/database/migrations");
        }

        /*
        |--------------------------------------------------------------------------
        | Plugin Views
        |--------------------------------------------------------------------------
         */
        $this->loadViewsFrom(dirname(__DIR__) . "/resources/views", "CatalogPro");
    }

    public function register()
    {
        /*
        |--------------------------------------------------------------------------
        | Register Filament Page (v3/v4 compatible)
        |--------------------------------------------------------------------------
         */
        Filament::getPanel('admin')
            ->pages([
                \Plugins\CatalogPro\src\Filament\Pages\CatalogProIndex::class,
            ])
            ->resources([
                //\Plugins\CatalogPro\src\Filament\Resources\CatalogProResource::class,
            ]);
    }
}
