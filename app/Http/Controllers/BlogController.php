<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $blogs = Blog::published()
            ->with('category')
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = $request->input('q');
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('excerpt', 'like', "%{$search}%");
                });
            })
            ->latest('published_at')
            ->latest()
            ->paginate(9);

        return view('blogs.index', compact('blogs'));
    }

    public function show(Blog $blog)
    {
        if ($blog->status !== Blog::STATUS_PUBLISHED || ($blog->published_at && $blog->published_at->isFuture())) {
            abort(404);
        }

        $relatedBlogs = Blog::published()
            ->where('id', '!=', $blog->id)
            ->where('category_id', $blog->category_id)
            ->take(3)
            ->get();
        $categories = Category::all();

        $blog->incrementReadCount();

        return view('blogs.show', compact('blog', 'relatedBlogs', 'categories'));
    }

    public function category(Category $category, Request $request)
    {
        $blogs = Blog::published()
            ->where('category_id', $category->id)
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = $request->input('q');
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('excerpt', 'like', "%{$search}%");
                });
            })
            ->latest('published_at')
            ->latest()
            ->paginate(9);

        return view('blogs.category', compact('blogs', 'category'));
    }
}
