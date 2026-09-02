<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
@foreach($pages as $page)
    <url>
        <loc>{{ $page['loc'] }}</loc>
        <changefreq>weekly</changefreq>
        <priority>{{ $page['priority'] }}</priority>
    </url>
@endforeach
@foreach($posts as $post)
    <url>
        <loc>{{ $post->canonical_url }}</loc>
        <lastmod>{{ $post->updated_at->utc()->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
@if($post->featured_image_url)
        <image:image>
            <image:loc>{{ $post->featured_image_url }}</image:loc>
            <image:title>{{ $post->title }}</image:title>
        </image:image>
@endif
    </url>
@endforeach
</urlset>
