<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::with('category')->published()->ordered();

        if ($search = $request->query('search')) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        if ($categorySlug = $request->query('category')) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $categorySlug));
        }

        $posts = $query->paginate(4)->appends($request->query());
        $categories = BlogCategory::orderBy('name')->get();

        return view('blog.index', compact('posts', 'categories'));
    }

    public function show(string $slug)
    {
        $post = BlogPost::published()->where('slug', $slug)->firstOrFail();

        return view('blog.show', compact('post'));
    }
}
