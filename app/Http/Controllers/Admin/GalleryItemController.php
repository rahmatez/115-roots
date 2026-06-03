<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\GalleryItem;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\GalleryItemRequest;

class GalleryItemController extends Controller
{
    public function index()
    {
        $galleryItems = GalleryItem::with('event')->ordered()->paginate(12);

        return view('admin.gallery_items.index', compact('galleryItems'));
    }

    public function create()
    {
        $events = Event::orderByDesc('event_date')->get(['id', 'title']);

        return view('admin.gallery_items.create', compact('events'));
    }

    public function store(GalleryItemRequest $request)
    {
        $image = $request->file('image')->store('gallery', 'public');

        GalleryItem::create([
            'title' => $request->title,
            'image' => $image,
            'sort_order' => $request->input('sort_order', 0),
            'is_published' => $request->boolean('is_published', true),
            'event_id' => $request->input('event_id'),
        ]);

        return redirect()->route('admin.gallery_items.index')->with([
            'message' => 'Gallery item created!',
            'alert-type' => 'success',
        ]);
    }

    public function edit(GalleryItem $gallery_item)
    {
        $events = Event::orderByDesc('event_date')->get(['id', 'title']);

        return view('admin.gallery_items.edit', [
            'galleryItem' => $gallery_item,
            'events' => $events,
        ]);
    }

    public function update(GalleryItemRequest $request, GalleryItem $gallery_item)
    {
        $data = [
            'title' => $request->title,
            'sort_order' => $request->input('sort_order', 0),
            'is_published' => $request->boolean('is_published', true),
            'event_id' => $request->input('event_id'),
        ];

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($gallery_item->image);
            $data['image'] = $request->file('image')->store('gallery', 'public');
        }

        $gallery_item->update($data);

        return redirect()->route('admin.gallery_items.index')->with([
            'message' => 'Gallery item updated!',
            'alert-type' => 'info',
        ]);
    }

    public function destroy(GalleryItem $gallery_item)
    {
        Storage::disk('public')->delete($gallery_item->image);
        $gallery_item->delete();

        return redirect()->back()->with([
            'message' => 'Gallery item deleted!',
            'alert-type' => 'danger',
        ]);
    }
}
