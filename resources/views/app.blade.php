<!doctype html>
<html data-theme="{{ j_active_theme() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    @include('seo')
    @vite('resources/js/app.js')
    <!--  @routes  optional: kalau pakai ziggy -->
</head>

<body>
    @inertia
</body>

</html>
