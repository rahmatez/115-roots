<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();

        return view('blogs.index', compact('blogs'));
    }

    public function show(Blog $blog)
    {
        $relatedBlogs = Blog::where('id', '!=', $blog->id)
            ->where('category_id', $blog->category_id)
            ->take(3)
            ->get();
        $categories = Category::all();

        $blog->incrementReadCount();

        return view('blogs.show', compact('blog', 'relatedBlogs', 'categories'));
    }

    public function category(Category $category)
    {
        $blogs = Blog::where('category_id', $category->id)->get();

        return view('blogs.category', compact('blogs', 'category'));
    }
}
