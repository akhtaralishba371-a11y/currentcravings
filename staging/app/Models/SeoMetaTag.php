<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SeoMetaTag extends Model
{
    protected $fillable = [
        'page_key',
        'page_label',
        'meta_title',
        'meta_description',
        'canonical_url',
        'is_index',
    ];

    protected function casts(): array
    {
        return [
            'is_index' => 'boolean',
        ];
    }

    public static function forRequest(Request $request): ?self
    {
        $route = $request->route();
        $routeName = $route?->getName();
        $params = $route?->parameters() ?? [];
        $keys = [];

        if ($routeName === 'menu.show' && isset($params['slug'])) {
            $keys[] = 'menu.show.'.$params['slug'];
            $keys[] = 'menu.show';
        } elseif ($routeName === 'menu.category' && isset($params['slug'])) {
            $keys[] = 'menu.category.'.$params['slug'];
            $keys[] = 'menu.category';
        } elseif ($routeName === 'blog.show' && isset($params['slug'])) {
            $keys[] = 'blog.show.'.$params['slug'];
            $keys[] = 'blog.show';
        } elseif ($routeName === 'menu.product' && isset($params['categorySlug']) && isset($params['slug'])) {
            $keys[] = 'menu.product.'.$params['categorySlug'].'.'.$params['slug'];
            $keys[] = 'menu.product';
        }

        if ($routeName) {
            $keys[] = $routeName;
        }

        $path = '/'.ltrim($request->path(), '/');
        if ($path === '//') {
            $path = '/';
        }
        if ($path === '/') {
            $keys[] = 'home';
        }

        $keys = array_values(array_unique(array_filter($keys)));
        if ($keys === []) {
            return null;
        }

        $items = static::query()
            ->whereIn('page_key', $keys)
            ->get()
            ->keyBy('page_key');

        foreach ($keys as $key) {
            if ($items->has($key)) {
                return $items->get($key);
            }
        }

        return null;
    }
}
