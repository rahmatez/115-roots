<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Page;

class HomeController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->take(6)->get();
        $siteSettings = Page::findBySlug('site_settings');

        return view('homepage', compact('blogs', 'siteSettings'));
    }
}
