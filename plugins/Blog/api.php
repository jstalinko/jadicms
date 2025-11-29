<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/plugin-test', fn() => ['plugin' => true]);