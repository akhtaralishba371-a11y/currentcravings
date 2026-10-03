<?php

namespace App\Http\Controllers\Frontend;

use App\Models\BlogPost;

class BlogController extends Controller
{
    public function index()
    {
        $allPosts = BlogPost::published()
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->get();

        $featuredPost = $allPosts->first();
        $posts = $featuredPost
            ? $allPosts->skip(1)->values()
            : collect();

        return view('website.blog', compact('featuredPost', 'posts'));
    }

    public function show(string $slug)
    {
        $post = BlogPost::published()->where('slug', $slug)->firstOrFail();
        $post->increment('views');

        $recentPosts = BlogPost::published()
            ->where('id', '!=', $post->id)
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->limit(5)
            ->get();

        return view('website.blog-show', compact('post', 'recentPosts'));
    }
}
