<?php

use Plugins\Blog\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::get('/plugin-blog', [BlogController::class, 'index']);