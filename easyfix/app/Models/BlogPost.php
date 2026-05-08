<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'meta_title',
        'meta_description',
        'blog_category_id',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (BlogPost $post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->where('published_at', '<=', now());
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    public function getFeaturedImageUrlAttribute(): ?string
    {
        if (! $this->featured_image) {
            return null;
        }

        return static::absoluteUrl(Storage::disk('public')->url($this->featured_image));
    }

    public function getSocialDescriptionAttribute(): string
    {
        $excerpt = trim((string) $this->excerpt);

        if ($excerpt !== '') {
            return Str::limit($excerpt, 160);
        }

        return Str::limit(trim(strip_tags((string) $this->content)), 160);
    }

    public function getSocialImageUrlAttribute(): string
    {
        return $this->featured_image_url ?: static::defaultOgImageUrl();
    }

    public function getCanonicalUrlAttribute(): string
    {
        return route('blog.show', $this->slug, true);
    }

    public static function defaultOgImageUrl(): string
    {
        return url('/og-image.png');
    }

    protected static function absoluteUrl(string $path): string
    {
        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        return url($path);
    }
}
