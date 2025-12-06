<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class JadiFrontendController extends Controller
{

    public function home()
    {
        $props['posts'] = Post::orderBy('created_at', 'desc')->with('meta')->with('labels')->where('type', 'post')->get();
        return Inertia::render('Home', j_inertia_props($props));
    }
    public function detailPost(Request $request)
    {
        $slug = $request->slug;
        $post = Post::where('slug', $slug)->with('meta')->with('labels')->with('author')->firstOrFail();
        $comments = Comment::where('post_id', $post->id)->orderBy('created_at', 'desc')->get();
        $relatedPosts = Post::where('type', 'post')
            ->where('id', '!=', $post->id)
            ->inRandomOrder()
            ->limit(6)
            ->get();
        $props['post'] = $post;
        $props['comments'] = $comments;
        $props['relatedPosts'] = $relatedPosts;
        return Inertia::render('Single', j_inertia_props($props));
    }
    public function detailPage(Request $request)
    {
        $slug = $request->slug;
        $page = Post::where('slug', $slug)->where('type', 'page')->with('meta')->with('labels')->with('author')->firstOrFail();
        $props['post'] = $page;
        $props['comments'] = [];
        $props['relatedPosts'] = [];
        return Inertia::render('Single', j_inertia_props($props));
    }
}
