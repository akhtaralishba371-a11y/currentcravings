<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $q = strtolower(trim((string) $request->query('q', '')));
        if ($q !== '') {
            $redirects = [
                'cookies' => ['cookie', 'cookies'],
                'brownies' => ['brownie', 'brownies'],
                'tres-leches' => ['tres', 'leches', 'tres leches'],
                'drinks' => ['drink', 'drinks'],
                'boxes' => ['box', 'boxes', 'gift'],
            ];

            foreach ($redirects as $slug => $keywords) {
                foreach ($keywords as $keyword) {
                    if (str_contains($q, $keyword)) {
                        return redirect()->route('menu.show', ['slug' => $slug]);
                    }
                }
            }

            return redirect()->route('menu.index');
        }

        $cmsCategories = Category::query()
            ->where('is_active', true)
            ->orderBy('order')
            ->orderBy('name')
            ->get();

        $featuredProducts = Product::active()
            ->with('category')
            ->whereHas('category', fn ($q) => $q->where('is_active', true))
            ->orderBy('order')
            ->orderBy('name')
            ->get()
            ->groupBy(fn ($p) => $p->category?->slug);

        return view('website.menu', compact('cmsCategories', 'featuredProducts'));
    }

    public function product(string $categorySlug, string $slug)
    {
        $product = Product::query()
            ->active()
            ->where('slug', $slug)
            ->whereHas('category', function ($query) use ($categorySlug) {
                $query->where('slug', $categorySlug);
            })
            ->with('category')
            ->firstOrFail();

        return view('website.product-show', compact('product'));
    }

    public function productLegacy(string $slug)
    {
        $product = Product::query()
            ->active()
            ->where('slug', $slug)
            ->with('category')
            ->firstOrFail();

        if ($product->category?->slug) {
            return redirect()->route('menu.product', [
                'categorySlug' => $product->category->slug,
                'slug' => $product->slug,
            ])->setStatusCode(301);
        }

        return view('website.product-show', compact('product'));
    }

    public function productLegacyCategory(string $categorySlug, string $slug)
    {
        return redirect()->route('menu.product', [
            'categorySlug' => $categorySlug,
            'slug' => $slug,
        ])->setStatusCode(301);
    }

    public function showLegacy(string $slug)
    {
        return redirect()->route('menu.show', ['slug' => $slug])->setStatusCode(301);
    }

    public function show(string $slug)
    {
        $category = Category::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->first();

        if ($category) {
            $products = $category->products()
                ->active()
                ->with('category')
                ->orderBy('order')
                ->orderBy('name')
                ->get();

            return view('website.menu-category', [
                'category' => $category,
                'products' => $products,
            ]);
        }

        $view = $this->menuViewForSlug($slug);

        if (! $view) {
            abort(404);
        }

        return view($view);
    }

    public function category(string $slug)
    {
        return $this->show($slug);
    }

    protected function menuViewForSlug(string $slug): ?string
    {
        $map = [
            'boxes' => 'website.menu-boxes',
            'brownies' => 'website.menu-brownies',
            'cookies' => 'website.menu-cookies',
            'drinks' => 'website.menu-drinks',
            'tres-leches' => 'website.menu-tres-leches',
        ];

        return $map[$slug] ?? null;
    }
}
