<?php

namespace Plugins\Catalog\src\Http\Controllers;

use App\Http\Controllers\Controller;

class CatalogController extends Controller
{
    public function index()
    {
        return view('Catalog::app');
    }
}
