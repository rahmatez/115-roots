<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Response;

class FeedController extends Controller
{
    public function index(): Response
    {
        $blogs = Blog::published()
            ->latest('published_at')
            ->latest()
            ->take(20)
            ->get();

        return response()->view('feed', compact('blogs'))
            ->header('Content-Type', 'application/rss+xml; charset=UTF-8');
    }
}
