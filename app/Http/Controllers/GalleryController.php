<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Services\InstagramFeedService;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function __construct(
        private InstagramFeedService $instagram
    ) {}

    public function index(Request $request)
    {
        $instagramMedia = $this->instagram->getMedia();
        $instagramProfileUrl = $this->instagram->profileUrl();
        $instagramConfigured = $this->instagram->isConfigured();
        $instagramUsername = Page::findBySlug('site_settings')?->settings['instagram_username']
            ?? config('instagram.username', 'suicidesquad11.5');

        return view('gallery', compact(
            'instagramMedia',
            'instagramProfileUrl',
            'instagramConfigured',
            'instagramUsername'
        ));
    }
}
