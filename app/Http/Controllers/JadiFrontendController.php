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
        j_inertia_meta(
            config('j_option_autoload.site_name') . ' - ' . config('j_option_autoload.tagline'),
            config('j_option_autoload.meta_description'),
            url('/'),
            url('/storage' . config('j_option_autoload.icon')),
            json_decode(config('j_option_autoload.meta_tags'), true)
        );

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
        j_inertia_meta(
            $post->title . ' - ' . config('j_option_autoload.site_name'),
            $post->excerpt,
            url($post->slug),
            url('storage' . $post->image),
            json_decode(config('j_option_autoload.meta_tags'), true)
        );
        $props['post'] = $post;
        $props['comments'] = $comments;
        $props['relatedPosts'] = $relatedPosts;
        return Inertia::render('Single', j_inertia_props($props));
    }
    public function detailPage(Request $request)
    {

        $slug = $request->slug;
        $page = Post::where('slug', $slug)->where('type', 'page')->with('meta')->with('labels')->with('author')->firstOrFail();
        j_inertia_meta(
            $page->title . ' - ' . config('j_option_autoload.site_name'),
            $page->excerpt,
            url('page/' . $page->slug),
            url('storage' . $page->image),
            json_decode(config('j_option_autoload.meta_tags'), true)
        );
        $props['post'] = $page;
        $props['comments'] = [];
        $props['relatedPosts'] = [];
        return Inertia::render('Single', j_inertia_props($props));
    }

    public function categoryPost(Request $request)
    {
        $slug = $request->slug;
        $posts = Post::getPostByCategory($slug)->with('labels')->with('meta')->with('author')->get();
        j_inertia_meta(
            $posts->first()->category_name . ' - ' . config('j_option_autoload.site_name'),
            $posts->first()->category_name,
            url('category/' . $slug),
            url('storage' . $posts->first()->image),
            json_decode(config('j_option_autoload.meta_tags'), true)
        );
        $props['posts'] = $posts;
        $props['filterType'] = 'category';
        $props['filterValue'] = $posts->first()->category_name;
        return Inertia::render('PostFilter', j_inertia_props($props));
    }
    public function archivePost(Request $request)
    {
        $slug = $request->slug;
        $posts = Post::getPostArchive($slug)->with('labels')->with('meta')->with('author')->get();
        j_inertia_meta(
            "Post archive " . $slug . ' - ' . config('j_option_autoload.site_name'),
            "Post archive " . $slug,
            url('archive/' . $slug),
            url('storage' . $posts->first()->image),
            json_decode(config('j_option_autoload.meta_tags'), true)
        );
        $props['posts'] = $posts;
        $props['filterType'] = 'archive';
        $props['filterValue'] = $slug;
        return Inertia::render('PostFilter', j_inertia_props($props));
    }
    public function searchPost(Request $request)
    {
        $search = $request->query('q');
        $posts = Post::where('title', 'like', '%' . $search . '%')->with('labels')->with('meta')->with('author')->get();
        j_inertia_meta(
            "Search result for " . $search . ' - ' . config('j_option_autoload.site_name'),
            "Search result for " . $search,
            url('search/' . $search),
            url('storage' . $posts->first()->image),
            json_decode(config('j_option_autoload.meta_tags'), true)
        );
        $props['posts'] = $posts;
        $props['filterType'] = 'search';
        $props['filterValue'] = $search;
        return Inertia::render('PostFilter', j_inertia_props($props));
    }
}
