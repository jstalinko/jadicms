<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakePlugin extends Command
{
    protected $signature = 'make:plugin {name}';
    protected $description = 'Generate a simple JadiCMS plugin structure';

    public function handle()
    {
        $name = $this->argument('name');
        $basePath = base_path("plugins/$name");

        if (File::exists($basePath)) {
            $this->error("Plugin already exists!");
            return;
        }

        // Create folders
        File::makeDirectory("$basePath", 0755, true);
        File::makeDirectory("$basePath/Http/Controllers", 0755, true);
        File::makeDirectory("$basePath/Models", 0755, true);
        File::makeDirectory("$basePath/Filament", 0755, true);
        File::makeDirectory("$basePath/Inertia", 0755, true);

        // Service Provider
        File::put("$basePath/PluginServiceProvider.php", $this->provider($name));

        // Routes
        File::put("$basePath/web.php", $this->webRoute($name));
        File::put("$basePath/api.php", $this->apiRoute());

        // Simple model
        File::put("$basePath/Models/$name.php", $this->model($name));

        // Controller
        File::put("$basePath/Http/Controllers/{$name}Controller.php", $this->controller($name));

        // Filament Resource
        File::put("$basePath/Filament/{$name}Resource.php", $this->filamentResource($name));

        // Inertia Page
        File::put("$basePath/Inertia/Index.vue", $this->inertiaVue());

        $this->info("Plugin '$name' generated successfully!");
    }


    private function provider($name)
    {
        return <<<PHP
<?php

namespace Plugins\\$name;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class PluginServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Web
        Route::middleware('web')
            ->group(__DIR__.'/web.php');

        // API
        Route::middleware('api')
            ->prefix('api')
            ->group(__DIR__.'/api.php');

        // Filament auto load
        if (class_exists("\\Filament\\Facades\\Filament")) {
            \\Filament\\Facades\\Filament::serving(function () {
                //
            });
        }
    }
}
PHP;
    }

    private function webRoute($name)
    {
        return <<<PHP
<?php

use Plugins\\$name\\Http\\Controllers\\{$name}Controller;

Route::get('/plugin-$name', [{$name}Controller::class, 'index']);
PHP;
    }

    private function apiRoute()
    {
        return <<<PHP
<?php

use Illuminate\Http\Request;

Route::get('/plugin-test', fn() => ['plugin' => true]);
PHP;
    }

    private function model($name)
    {
        return <<<PHP
<?php

namespace Plugins\\$name\\Models;

use Illuminate\Database\Eloquent\Model;

class $name extends Model
{
    protected \$fillable = ['title'];

    protected \$table = strtolower('$name');
}
PHP;
    }

    private function controller($name)
    {
        return <<<PHP
<?php

namespace Plugins\\$name\\Http\\Controllers;

use App\Http\Controllers\Controller;
use Inertia\\Inertia;

class {$name}Controller extends Controller
{
    public function index()
    {
        return Inertia::render('Plugins/$name/Index');
    }
}
PHP;
    }

    private function filamentResource($name)
    {
        return <<<PHP
<?php

namespace Plugins\\$name\\Filament;

use Filament\\Resources\\Resource;
use Filament\\Resources\\Pages\\ListRecords;

class {$name}Resource extends Resource
{
    protected static ?string \$model = \\Plugins\\$name\\Models\\$name::class;

    public static function getPages(): array
    {
        return [
            'index' => ListRecords::route('/'),
        ];
    }
}
PHP;
    }

    private function inertiaVue()
    {
        return <<<VUE
<template>
    <div class="p-8">
        <h1 class="text-3xl font-bold">Plugin Loaded via Inertia + Vue</h1>
    </div>
</template>

<script setup>
</script>
VUE;
    }
}
