<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\GalleryItem;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::published()->orderByDesc('event_date')->get(['id', 'title', 'slug']);

        $galleryItems = GalleryItem::published()
            ->with('event')
            ->when($request->filled('event'), function ($query) use ($request) {
                $query->where('event_id', $request->input('event'));
            })
            ->ordered()
            ->get();

        $selectedEvent = $request->filled('event')
            ? Event::find($request->input('event'))
            : null;

        return view('gallery', compact('galleryItems', 'events', 'selectedEvent'));
    }
}
