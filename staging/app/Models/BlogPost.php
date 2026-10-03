<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'category',
        'tags',
        'meta_title',
        'meta_description',
        'canonical_url',
        'is_index',
        'views',
        'is_published',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'tags' => 'array',
            'is_index' => 'boolean',
            'is_published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function getFeaturedImagePathAttribute(): ?string
    {
        return $this->normalizePublicPath($this->attributes['featured_image'] ?? null);
    }

    public function getFeaturedImageUrlAttribute(): ?string
    {
        if (!$this->featured_image_path) {
            return null;
        }

        return route('media.public', ['path' => $this->featured_image_path], false);
    }

    public function getContentAttribute(?string $value): string
{
    $value = $value ?? '';

    // Fix broken relative/absolute storage paths
    $value = preg_replace_callback(
        '/src=["\']([^"\']*storage\/([^"\']+))["\']/i',
        function ($m) {
            $path = $this->normalizePublicPath($m[2]);

            if (!$path) {
                return $m[0];
            }

            $url = route('media.public', ['path' => $path], false);

            return 'src="' . $url . '"';
        },
        $value
    );

    // Strip AI-generated data-start / data-end attributes
    $value = preg_replace('/ data-(start|end)="\d+"/', '', $value);

    return $value;
}
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->where(function ($q) {
                $q->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            });
    }

    private function normalizePublicPath(?string $path): ?string
    {
        if (!filled($path)) {
            return null;
        }

        $path = trim(str_replace('\\', '/', (string) $path));
        if ($path === '') {
            return null;
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            $parsedPath = parse_url($path, PHP_URL_PATH);
            if (is_string($parsedPath) && $parsedPath !== '') {
                $path = $parsedPath;
            }
        }

        $path = ltrim($path, '/');
        $path = preg_replace('#^(media|storage|public)/#i', '', $path, 1);
        $path = ltrim((string) $path, '/');

        return $path !== '' ? $path : null;
    }
}
