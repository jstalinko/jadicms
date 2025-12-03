@php
    $setting = [
        'base_url' => j_get_option('base_url', url('/')),
        'site_name' => j_get_option('site_name', env('APP_NAME')),
        'tagline' => j_get_option('tagline'),
        'icon' => j_get_option('icon'),
        'meta_keywords' => j_get_option('meta_keywords'),
        'meta_description' => j_get_option('meta_description'),
        'meta_tags' => j_get_option('meta_tags', '{}'),
    ];
    $meta_tags = json_decode($setting['meta_tags'], true);
@endphp

<title>{{ $setting['site_name'] }} - {{ $setting['tagline'] }}</title>
<!-- link alternate -->
<link rel="alternate" href="{{ $setting['base_url'] }}" hreflang="{{ app()->getLocale() }}">
<link rel="canonical" href="{{ $setting['base_url'] }}">
<link rel="alternate" type="application/rss+xml" href="{{ $setting['base_url'] }}/rss">
<base href="{{ $setting['base_url'] }}">

<!-- meta tag -->
<meta name="description" content="{{ $setting['meta_description'] }}">
<meta name="keywords" content="{{ $setting['meta_keywords'] }}">
<meta name="author" content="{{ $setting['site_name'] }}">
<meta name="robots" content="index, follow">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Open Graph -->
<meta property="og:title" content="{{ $setting['site_name'] }}">
<meta property="og:description" content="{{ $setting['meta_description'] }}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ $setting['base_url'] }}">
<meta property="og:image" content="{{ asset($setting['icon']) }}">
<meta property="og:site_name" content="{{ $setting['site_name'] }}">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $setting['site_name'] }}">
<meta name="twitter:description" content="{{ $setting['meta_description'] }}">
<meta name="twitter:image" content="{{ asset($setting['icon']) }}">
<meta name="twitter:site" content="{{ $setting['site_name'] }}">

<!-- Schema.org -->
<meta itemprop="name" content="{{ $setting['site_name'] }}">
<meta itemprop="description" content="{{ $setting['meta_description'] }}">
<meta itemprop="image" content="{{ asset($setting['icon']) }}">

<!-- Favicon -->
<link rel="icon" href="{{ asset($setting['icon']) }}" type="image/x-icon">
<link rel="shortcut icon" href="{{ asset($setting['icon']) }}" type="image/x-icon">


<!-- Meta Tags -->
@if (count($meta_tags) > 0)
    @foreach ($meta_tags as $meta_tag)
        <meta name="{{ $meta_tag['meta_name'] }}" content="{{ $meta_tag['meta_content'] }}">
    @endforeach
@endif
