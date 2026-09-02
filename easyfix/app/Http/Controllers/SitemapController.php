<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Return only public, canonical pages so private dashboards and tracking URLs
     * never end up in search results.
     */
    public function index(): Response
    {
        $pages = [
            ['loc' => route('home', absolute: true), 'priority' => '1.0'],
            ['loc' => route('subcontractor', absolute: true), 'priority' => '0.9'],
            ['loc' => route('blog.index', absolute: true), 'priority' => '0.8'],
            ['loc' => route('faq', absolute: true), 'priority' => '0.7'],
            ['loc' => route('about', absolute: true), 'priority' => '0.6'],
            ['loc' => route('professionals.create', absolute: true), 'priority' => '0.6'],
            ['loc' => route('terms', absolute: true), 'priority' => '0.3'],
            ['loc' => route('privacy', absolute: true), 'priority' => '0.3'],
        ];

        $posts = BlogPost::query()
            ->published()
            ->select(['title', 'slug', 'featured_image', 'published_at', 'updated_at'])
            ->ordered()
            ->get();

        return response()->view('sitemap', compact('pages', 'posts'), 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
        ]);
    }
}
