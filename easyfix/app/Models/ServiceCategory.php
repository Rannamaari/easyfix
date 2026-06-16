<?php

namespace App\Models;

use BladeUI\Icons\Exceptions\SvgNotFound;
use BladeUI\Icons\Factory as IconFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class ServiceCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::saving(function ($category) {
            $category->icon = $category->normalizedIcon();
        });
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function jobRequests(): HasMany
    {
        return $this->hasMany(JobRequest::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    public function normalizedIcon(): ?string
    {
        if (blank($this->icon)) {
            return null;
        }

        $icon = Str::of($this->icon)
            ->trim()
            ->replace(['heroicon-o-', 'heroicon-m-', 'heroicon-s-'], '')
            ->replace('_', '-')
            ->value();

        if (preg_match('/[A-Z]/', $icon)) {
            $icon = Str::of($icon)
                ->replaceMatches('/Icon$/', '')
                ->snake('-')
                ->value();
        }

        return Str::of($icon)
            ->lower()
            ->trim('- ')
            ->value();
    }

    public function heroiconComponent(): string
    {
        $icon = $this->normalizedIcon();

        if ($icon) {
            $component = "heroicon-o-{$icon}";

            if ($this->iconComponentExists($component)) {
                return $component;
            }
        }

        return 'heroicon-o-wrench-screwdriver';
    }

    protected function iconComponentExists(string $component): bool
    {
        try {
            app(IconFactory::class)->svg($component);

            return true;
        } catch (SvgNotFound) {
            return false;
        }
    }
}
