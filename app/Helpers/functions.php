<?php

use App\Models\Option;

/*
|--------------------------------------------------------------------------
| Set 1 option (create or update)
|--------------------------------------------------------------------------
*/

if (!function_exists('j_set_option')) {
    function j_set_option(string $key, string $value, bool $autoload = true)
    {
        return Option::updateOrCreate(
            ['option_name' => $key],
            ['option_value' => $value, 'autoload' => $autoload]
        );
    }
}

/*
|--------------------------------------------------------------------------
| Get 1 option
|--------------------------------------------------------------------------
*/
if (!function_exists('j_get_option')) {
    function j_get_option(string $key, $default = null)
    {
        return Option::where('option_name', $key)->value('option_value') ?? $default;
    }
}

/*
|--------------------------------------------------------------------------
| Delete 1 option
|--------------------------------------------------------------------------
*/
if (!function_exists('j_del_option')) {
    function j_del_option(string $key)
    {
        return Option::where('option_name', $key)->delete();
    }
}

/*
|--------------------------------------------------------------------------
| Set multiple options
|--------------------------------------------------------------------------
*/
if (!function_exists('j_set_options')) {
    function j_set_options(array $options, bool $autoload = true)
    {
        foreach ($options as $key => $value) {
            if ($key == null) continue;
            Option::updateOrCreate(
                ['option_name' => $key],
                ['option_value' => $value, 'autoload' => $autoload]
            );
        }
        return true;
    }
}

/*
|--------------------------------------------------------------------------
| Get multiple options
|--------------------------------------------------------------------------
*/
if (!function_exists('j_get_options')) {
    function j_get_options(array $keys): array
    {
        return Option::whereIn('option_name', $keys)
            ->pluck('option_value', 'option_name')
            ->toArray();
    }
}

/*
|--------------------------------------------------------------------------
| Delete multiple options
|--------------------------------------------------------------------------
*/
if (!function_exists('j_del_options')) {
    function j_del_options(array $keys)
    {
        return Option::whereIn('option_name', $keys)->delete();
    }
}

/*
|---------------------------------------------------------------------------
| Get plugins path
|---------------------------------------------------------------------------
*/
if (!function_exists('j_plugin_path')) {
    function j_plugin_path(string $path)
    {
        return app_path(DIRECTORY_SEPARATOR . '/Plugins');
    }
}
/*
|---------------------------------------------------------------------------
| Get active theme
|---------------------------------------------------------------------------
 */
if (!function_exists('j_active_theme')) {
    function j_active_theme()
    {
        return cache()->remember('active_theme', 60, function () {
            return j_get_option('active_theme', 'default');
        });
    }
}
/*
 |---------------------------------------------------------------------------
 | Format and collect data to inertia with props.
 |---------------------------------------------------------------------------
 */
if (!function_exists('j_inertia_props')) {
    function j_inertia_props($props = [])
    {
        $data['jdata'] = $props;
        return $data;
    }
}
