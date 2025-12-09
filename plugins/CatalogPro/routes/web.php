<?php

namespace Plugins\CatalogPro\src\Routes;

use Illuminate\Support\Facades\Route;

Route::get('/plugin-catalog-pro', fn() => view('CatalogPro::app'))->name('plugin-catalog-pro');
