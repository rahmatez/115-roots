<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Event;
use App\Models\Product;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = collect([
            ['loc' => route('homepage'), 'priority' => '1.0'],
            ['loc' => route('shop.index'), 'priority' => '0.9'],
            ['loc' => route('blog.index'), 'priority' => '0.9'],
            ['loc' => route('gallery'), 'priority' => '0.8'],
            ['loc' => route('about-us'), 'priority' => '0.8'],
            ['loc' => route('faqs'), 'priority' => '0.7'],
            ['loc' => route('contact'), 'priority' => '0.7'],
            ['loc' => route('events.index'), 'priority' => '0.8'],
        ]);

        Blog::published()->get(['slug', 'updated_at'])->each(function ($blog) use ($urls) {
            $urls->push([
                'loc' => route('blog.show', $blog->slug),
                'lastmod' => $blog->updated_at->toAtomString(),
                'priority' => '0.7',
            ]);
        });

        Event::published()->get(['slug', 'updated_at'])->each(function ($event) use ($urls) {
            $urls->push([
                'loc' => route('events.show', $event->slug),
                'lastmod' => $event->updated_at->toAtomString(),
                'priority' => '0.7',
            ]);
        });

        Product::published()->get(['slug', 'updated_at'])->each(function ($product) use ($urls) {
            $urls->push([
                'loc' => route('shop.show', $product->slug),
                'lastmod' => $product->updated_at->toAtomString(),
                'priority' => '0.6',
            ]);
        });

        return response()->view('sitemap', compact('urls'))
            ->header('Content-Type', 'application/xml');
    }
}
