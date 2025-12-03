<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Post;

class JadiFrontendController extends Controller
{

    public function home()
    {
        $props['posts'] = Post::orderBy('created_at', 'desc')->get();
        $data['props'] = $props;
        return Inertia::render('Home', $data);
    }
    public function detailPost(Request $request)
    {
        $slug = $request->slug;
        $post = Post::where('slug', $slug)->first();
        return Inertia::render('Single', [
            'post' => $post
        ]);
    }
}
