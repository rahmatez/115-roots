<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Event;
use App\Models\Page;
use App\Models\Product;
use App\Services\InstagramFeedService;

class HomeController extends Controller
{
    public function __construct(
        private InstagramFeedService $instagram
    ) {}

    public function index()
    {
        $blogs = Blog::published()->latest('published_at')->latest()->take(6)->get();
        $siteSettings = Page::findBySlug('site_settings');
        $aboutPage = Page::findBySlug('about');
        $products = Product::published()->ordered()->get();
        $upcomingEvents = Event::published()->upcoming()->take(3)->get();
        $instagramMedia = $this->instagram->getMedia(12);
        $instagramProfileUrl = $this->instagram->profileUrl();

        return view('homepage', compact(
            'blogs',
            'siteSettings',
            'aboutPage',
            'products',
            'upcomingEvents',
            'instagramMedia',
            'instagramProfileUrl'
        ));
    }
}
