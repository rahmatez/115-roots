<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $upcomingEvents = Event::published()->upcoming()->get();
        $pastEvents = Event::published()
            ->where('event_date', '<', now()->startOfDay())
            ->orderByDesc('event_date')
            ->get();

        return view('events.index', compact('upcomingEvents', 'pastEvents'));
    }

    public function show(Event $event)
    {
        if (! $event->is_published) {
            abort(404);
        }

        $event->load(['galleryItems' => fn ($q) => $q->published()->ordered()]);

        return view('events.show', compact('event'));
    }
}
