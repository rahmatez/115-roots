<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Support\SlugGenerator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\EventRequest;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderByDesc('event_date')->paginate(10);

        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(EventRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = SlugGenerator::unique($request->title, Event::class);
        $data['is_published'] = $request->boolean('is_published', true);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        Event::create($data);

        return redirect()->route('admin.events.index')->with([
            'message' => 'Event created!',
            'alert-type' => 'success',
        ]);
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(EventRequest $request, Event $event)
    {
        $data = $request->validated();
        $data['slug'] = SlugGenerator::unique($request->title, Event::class, $event->id);
        $data['is_published'] = $request->boolean('is_published', true);

        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        $event->update($data);

        return redirect()->route('admin.events.index')->with([
            'message' => 'Event updated!',
            'alert-type' => 'info',
        ]);
    }

    public function destroy(Event $event)
    {
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }
        $event->delete();

        return redirect()->back()->with([
            'message' => 'Event deleted!',
            'alert-type' => 'danger',
        ]);
    }
}
