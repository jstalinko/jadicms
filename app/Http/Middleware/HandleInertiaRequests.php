<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request)
    {
        $setting = [
            'base_url' => j_get_option('base_url', url('/')),
            'site_name' => j_get_option('site_name', env('APP_NAME')),
            'tagline' => j_get_option('tagline'),
            'icon' => j_get_option('icon'),
            'meta_keywords' => j_get_option('meta_keywords'),
            'meta_description' => j_get_option('meta_description'),
            'meta_tags' => j_get_option('meta_tags', '{}'),
            'menus' => json_decode(j_get_option('menus', '[]'), true),
        ];

        return array_merge(parent::share($request), [
            'flash' => [
                'message' => fn() => $request->session()->get('message')
            ],
            'setting' => $setting
        ]);
    }
}
