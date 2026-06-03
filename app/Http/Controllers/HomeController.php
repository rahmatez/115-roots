<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Event;
use App\Models\GalleryItem;
use App\Models\Page;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $blogs = Blog::published()->latest('published_at')->latest()->take(6)->get();
        $siteSettings = Page::findBySlug('site_settings');
        $aboutPage = Page::findBySlug('about');
        $products = Product::published()->ordered()->get();
        $upcomingEvents = Event::published()->upcoming()->take(3)->get();
        $galleryPreview = GalleryItem::published()->ordered()->take(9)->get();

        return view('homepage', compact(
            'blogs',
            'siteSettings',
            'aboutPage',
            'products',
            'upcomingEvents',
            'galleryPreview'
        ));
    }
}
