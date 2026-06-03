<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Event;
use App\Models\GalleryItem;
use App\Models\Product;
use App\Models\ContactMessage;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'blogs' => Blog::count(),
            'categories' => Category::count(),
            'products' => Product::count(),
            'events' => Event::count(),
            'gallery_items' => GalleryItem::count(),
            'contact_new' => ContactMessage::where('status', ContactMessage::STATUS_NEW)->count(),
            'contact_total' => ContactMessage::count(),
        ];

        $recentBlogs = Blog::with('category')->latest()->take(5)->get();
        $recentMessages = ContactMessage::newest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentBlogs', 'recentMessages'));
    }
}
