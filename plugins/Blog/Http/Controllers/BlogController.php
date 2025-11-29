<?php

namespace Plugins\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function index()
    {
        return view('Blog::index');
    }
}