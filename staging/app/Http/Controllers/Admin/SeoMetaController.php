<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Product;
use App\Models\SeoMetaTag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SeoMetaController extends Controller
{
    public function index(): View
    {
        $blueprints = collect($this->pageBlueprints());
        $existing = SeoMetaTag::query()->orderBy('page_label')->get()->keyBy('page_key');

        $pages = $blueprints->map(function (array $page) use ($existing) {
            $meta = $existing->get($page['page_key']);

            return [
                'page_key' => $page['page_key'],
                'page_label' => $page['page_label'],
                'meta_title' => $meta->meta_title ?? '',
                'meta_description' => $meta->meta_description ?? '',
                'canonical_url' => $meta->canonical_url ?? ($page['canonical_url'] ?? ''),
                'is_index' => $meta ? (bool) $meta->is_index : true,
            ];
        })->values();

        $knownKeys = $blueprints->pluck('page_key');
        $customPages = $existing
            ->filter(fn (SeoMetaTag $meta) => ! $knownKeys->contains($meta->page_key))
            ->map(fn (SeoMetaTag $meta) => [
                'page_key' => $meta->page_key,
                'page_label' => $meta->page_label,
                'meta_title' => $meta->meta_title ?? '',
                'meta_description' => $meta->meta_description ?? '',
                'canonical_url' => $meta->canonical_url ?? '',
                'is_index' => (bool) $meta->is_index,
            ])
            ->values();

        return view('admin.seo-meta.index', [
            'pages' => $pages,
            'customPages' => $customPages,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'rows' => ['required', 'array'],
            'rows.*.page_key' => ['required', 'string', 'max:190'],
            'rows.*.page_label' => ['required', 'string', 'max:190'],
            'rows.*.meta_title' => ['nullable', 'string', 'max:255'],
            'rows.*.meta_description' => ['nullable', 'string', 'max:1000'],
            'rows.*.canonical_url' => ['nullable', 'string', 'max:500'],
            'rows.*.is_index' => ['nullable', 'boolean'],
        ]);

        foreach ($data['rows'] as $row) {
            SeoMetaTag::query()->updateOrCreate(
                ['page_key' => trim((string) $row['page_key'])],
                [
                    'page_label' => trim((string) $row['page_label']),
                    'meta_title' => filled($row['meta_title'] ?? null) ? trim((string) $row['meta_title']) : null,
                    'meta_description' => filled($row['meta_description'] ?? null) ? trim((string) $row['meta_description']) : null,
                    'canonical_url' => filled($row['canonical_url'] ?? null) ? trim((string) $row['canonical_url']) : null,
                    'is_index' => (bool) ($row['is_index'] ?? false),
                ]
            );
        }

        return redirect()
            ->route('admin.seo-meta.index')
            ->with('success', 'SEO meta tags updated successfully.');
    }

    /**
     * @return array<int,array{page_key:string,page_label:string,canonical_url:string}>
     */
    private function pageBlueprints(): array
    {
        $pages = [
            ['page_key' => 'home', 'page_label' => 'Home', 'canonical_url' => route('home')],
            ['page_key' => 'about', 'page_label' => 'About', 'canonical_url' => route('about')],
            ['page_key' => 'contact', 'page_label' => 'Contact', 'canonical_url' => route('contact')],
            ['page_key' => 'privacy-policy', 'page_label' => 'Privacy Policy', 'canonical_url' => route('privacy-policy')],
            ['page_key' => 'delivery-shipping', 'page_label' => 'Delivery & Shipping', 'canonical_url' => route('delivery-shipping')],
            ['page_key' => 'allergen-info', 'page_label' => 'Allergen Info', 'canonical_url' => route('allergen-info')],
            ['page_key' => 'refunds-returns', 'page_label' => 'Refund Policy', 'canonical_url' => route('refunds-returns')],
            ['page_key' => 'terms-of-service', 'page_label' => 'Terms of Service', 'canonical_url' => route('terms-of-service')],
            ['page_key' => 'menu.index', 'page_label' => 'Menu (All)', 'canonical_url' => route('menu.index')],
            ['page_key' => 'menu.show.cookies', 'page_label' => 'Menu - Cookies', 'canonical_url' => route('menu.show', 'cookies')],
            ['page_key' => 'menu.show.brownies', 'page_label' => 'Menu - Brownies', 'canonical_url' => route('menu.show', 'brownies')],
            ['page_key' => 'menu.show.tres-leches', 'page_label' => 'Menu - Tres Leches', 'canonical_url' => route('menu.show', 'tres-leches')],
            ['page_key' => 'menu.show.drinks', 'page_label' => 'Menu - Drinks', 'canonical_url' => route('menu.show', 'drinks')],
            ['page_key' => 'menu.show.boxes', 'page_label' => 'Menu - Boxes', 'canonical_url' => route('menu.show', 'boxes')],
            ['page_key' => 'menu.product', 'page_label' => 'Product Detail (Generic)', 'canonical_url' => url('/{categorySlug}/{slug}')],
            ['page_key' => 'blog.index', 'page_label' => 'Blog Listing', 'canonical_url' => route('blog.index')],
            ['page_key' => 'blog.show', 'page_label' => 'Blog Detail (Generic)', 'canonical_url' => url('/blog/{slug}')],
            ['page_key' => 'cart.index', 'page_label' => 'Cart', 'canonical_url' => route('cart.index')],
            ['page_key' => 'checkout.index', 'page_label' => 'Checkout', 'canonical_url' => route('checkout.index')],
            ['page_key' => 'boxes.build', 'page_label' => 'Build Your Box', 'canonical_url' => route('boxes.build')],
            ['page_key' => 'area.kettering', 'page_label' => 'Area - Kettering', 'canonical_url' => route('area.kettering')],
            ['page_key' => 'area.wellingborough', 'page_label' => 'Area - Wellingborough', 'canonical_url' => route('area.wellingborough')],
            ['page_key' => 'area.rushden', 'page_label' => 'Area - Rushden', 'canonical_url' => route('area.rushden')],
            ['page_key' => 'area.northampton', 'page_label' => 'Area - Northampton', 'canonical_url' => route('area.northampton')],
            ['page_key' => 'area.irthlingborough', 'page_label' => 'Area - Irthlingborough', 'canonical_url' => route('area.irthlingborough')],
            ['page_key' => 'area.corby', 'page_label' => 'Area - Corby', 'canonical_url' => route('area.corby')],
            ['page_key' => 'area.brackley', 'page_label' => 'Area - Brackley', 'canonical_url' => route('area.brackley')],
        ];

        $blogPages = BlogPost::query()
            ->published()
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->get(['title', 'slug'])
            ->map(fn (BlogPost $post) => [
                'page_key' => 'blog.show.'.$post->slug,
                'page_label' => 'Blog - '.$post->title,
                'canonical_url' => route('blog.show', $post->slug),
            ])
            ->all();

        $productPages = Product::query()
            ->with('category:id,slug')
            ->active()
            ->orderBy('name')
            ->get(['id', 'name', 'slug', 'category_id'])
            ->filter(fn (Product $product) => filled($product->slug) && filled($product->category?->slug))
            ->map(fn (Product $product) => [
                'page_key' => 'menu.product.'.$product->category->slug.'.'.$product->slug,
                'page_label' => 'Product - '.$product->name,
                'canonical_url' => route('menu.product', [
                    'categorySlug' => $product->category->slug,
                    'slug' => $product->slug,
                ]),
            ])
            ->all();

        return array_merge($pages, $blogPages, $productPages);
    }
}
