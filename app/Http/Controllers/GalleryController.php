<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;

class GalleryController extends Controller
{
    public function index()
    {
        $galleryItems = GalleryItem::published()->ordered()->get();

        return view('gallery', compact('galleryItems'));
    }
}
