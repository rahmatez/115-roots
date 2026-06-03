<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends Controller
{
    public function about()
    {
        $page = Page::findBySlug('about');

        return view('about-us', compact('page'));
    }

    public function contact()
    {
        $page = Page::findBySlug('contact');

        return view('contact', compact('page'));
    }

    public function faqs()
    {
        $page = Page::findBySlug('faqs');

        return view('faqs', compact('page'));
    }
}
