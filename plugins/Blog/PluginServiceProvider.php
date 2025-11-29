<?php

namespace Plugins\Blog;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Plugins\Blog\Filament\BlogResource;

class PluginServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Views
        $this->loadViewsFrom(__DIR__.'/Views', 'Blog');

        // Web routes
        Route::middleware('web')
            ->namespace('Plugins\Blog\Http\Controllers')
            ->group(__DIR__.'/web.php');

        // API routes
        Route::middleware('api')
            ->prefix('api')
            ->namespace('Plugins\Blog\Http\Controllers')
            ->group(__DIR__.'/api.php');

        // Migrations (opsional)
        if (is_dir(__DIR__.'/Database/Migrations')) {
            $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
        }

        // Filament hook (opsional)
        if (class_exists("\Filament\Facades\Filament")) {
            \Filament\Facades\Filament::serving(function () {
              //  \Filament\Facades\Filament::registerResources([BlogResource::class])
            });
        }
    }
}
