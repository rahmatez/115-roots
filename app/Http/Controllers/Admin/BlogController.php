<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\Category;
use App\Support\SlugGenerator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\BlogRequest;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->with('category')->paginate(5);

        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::get(['name', 'id']);

        return view('admin.blogs.create', compact('categories'));
    }

    public function store(BlogRequest $request)
    {
        if ($request->validated()) {
            $image = $request->file('image')->store('blog/images', 'public');
            $slug = SlugGenerator::unique($request->title, Blog::class);
            $publishedAt = $request->input('status') === Blog::STATUS_PUBLISHED
                ? ($request->input('published_at') ?: now())
                : null;

            Blog::create($request->except(['image', 'published_at']) + [
                'slug' => $slug,
                'image' => $image,
                'published_at' => $publishedAt,
            ]);
        }

        return redirect()->route('admin.blogs.index')->with([
            'message' => 'Success Created !',
            'alert-type' => 'success',
        ]);
    }

    public function edit(Blog $blog)
    {
        $categories = Category::get(['name', 'id']);

        return view('admin.blogs.edit', compact('blog', 'categories'));
    }

    public function update(BlogRequest $request, Blog $blog)
    {
        if ($request->validated()) {
            $slug = SlugGenerator::unique($request->title, Blog::class, $blog->id);
            $publishedAt = $request->input('status') === Blog::STATUS_PUBLISHED
                ? ($request->input('published_at') ?: ($blog->published_at ?? now()))
                : null;

            $data = $request->except(['image', 'published_at']) + [
                'slug' => $slug,
                'published_at' => $publishedAt,
            ];

            if ($request->image) {
                File::delete('storage/' . $blog->image);
                $data['image'] = $request->file('image')->store('blog/images', 'public');
            }

            $blog->update($data);
        }

        return redirect()->route('admin.blogs.index')->with([
            'message' => 'Success Updated !',
            'alert-type' => 'info',
        ]);
    }

    public function destroy(Blog $blog)
    {
        File::delete('storage/' . $blog->image);
        $blog->delete();

        return redirect()->back()->with([
            'message' => 'Success Deleted !',
            'alert-type' => 'danger',
        ]);
    }
}
