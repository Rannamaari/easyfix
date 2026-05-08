@props([
    'title',
    'description',
    'image',
    'url',
    'type' => 'website',
    'publishedTime' => null,
    'modifiedTime' => null,
    'author' => null,
])

<meta name="description" content="{{ $description }}">
<link rel="canonical" href="{{ $url }}">

<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:image" content="{{ $image }}">
<meta property="og:url" content="{{ $url }}">
<meta property="og:type" content="{{ $type }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">

@if($publishedTime)
<meta property="article:published_time" content="{{ $publishedTime }}">
@endif

@if($modifiedTime)
<meta property="article:modified_time" content="{{ $modifiedTime }}">
@endif

@if($author)
<meta property="article:author" content="{{ $author }}">
@endif

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $image }}">
