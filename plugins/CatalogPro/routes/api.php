<?php

namespace Plugins\CatalogPro\src\Routes;

use Illuminate\Support\Facades\Route;

Route::get('/plugin-catalog-pro', fn() => response()->json(['success' => true, 'message' => 'Route loaded']))->name('plugin-catalog-pro');
