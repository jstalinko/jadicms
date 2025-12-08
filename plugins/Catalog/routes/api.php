<?php

use Illuminate\Support\Facades\Route;

Route::get('/plugin-test', fn() => ['plugin' => 'ok']);
