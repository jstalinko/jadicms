<?php

use Illuminate\Support\Facades\Route;
use Plugins\Catalog\src\Http\Controllers\CatalogController;

Route::get('/plugin-catalog', [CatalogController::class, 'index']);
