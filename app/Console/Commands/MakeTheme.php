<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;

class MakeTheme extends Command
{
    protected $signature = 'make:theme {name}';
    protected $description = 'Create a new theme structure';

    public function handle()
    {
        $name = $this->argument('name');
        $theme = Str::lower($name);
        $fs = new Filesystem;

        $basePath = resource_path("js/Themes/{$theme}");

        // Directories
        $directories = [
            "{$basePath}",
            "{$basePath}/Components",
            "{$basePath}/Pages",
        ];

        foreach ($directories as $dir) {
            if (!$fs->exists($dir)) {
                $fs->makeDirectory($dir, 0755, true);
            }
        }

        // .keep file
        $fs->put("{$basePath}/Components/.keep", "");

        // --------------------------
        // Create Home.vue
        // --------------------------
        $homeVue = <<<VUE
<template>
    <div>
        <h1>Home Page - {$name} Theme</h1>
    </div>
</template>

<script setup>
// Home Component
</script>

<style scoped>
</style>
VUE;

        $fs->put("{$basePath}/Pages/Home.vue", $homeVue);

        // --------------------------
        // Create Single.vue
        // --------------------------
        $singleVue = <<<VUE
<template>
    <div>
        <h1>Single Page - {$name} Theme</h1>
    </div>
</template>

<script setup>
// Single Component
</script>

<style scoped>
</style>
VUE;

        $fs->put("{$basePath}/Pages/Single.vue", $singleVue);

        // --------------------------
        // Create theme.json
        // --------------------------
        $themeJson = <<<JSON
{
    "theme_name": "{$name}",
    "theme_author": "jadicms",
    "theme_version": "1.0.0",
    "theme_description": "Default Theme",
    "theme_url": "https://javaradigital.com",
    "theme_demo_url": "https://jadicms.com",
    "theme_screenshot": "https://placehold.co/300x200/8d6e63/FFFFFF?text={$name}+THEME",
    "theme_license": "MIT",
    "theme_tags": [
        "default",
        "blog",
        "article",
        "news",
        "cms"
    ]
}
JSON;

        $fs->put("{$basePath}/theme.json", $themeJson);

        $this->info("Theme '{$name}' created successfully!");

        return Command::SUCCESS;
    }
}
