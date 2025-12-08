<?php

namespace Plugins\Catalog\src;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class PluginServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Views
        $this->loadViewsFrom(__DIR__ . '/Views', 'Catalog');

        // Web routes
        if (file_exists(base_path("plugins/Catalog/routes/web.php"))) {

            Route::middleware('web')
                ->group(base_path("plugins/Catalog/routes/web.php"));
        }

        // API routes
        if (file_exists(base_path("plugins/Catalog/routes/api.php"))) {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path("plugins/Catalog/routes/api.php"));
        }

        // Migrations
        if (is_dir(__DIR__ . '/Database/Migrations')) {
            $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
        }
    }
}
