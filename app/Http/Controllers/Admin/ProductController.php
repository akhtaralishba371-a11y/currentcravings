<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::query()->with('category')->orderBy('order')->orderBy('name');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->integer('category_id'));
        }
        if ($request->filled('search')) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $products   = $query->paginate(20)->withQueryString();
        $categories = Category::query()->orderBy('name')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function toggleActive(Product $product): RedirectResponse
    {
        $product->update(['is_active' => ! $product->is_active]);

        return back()->with('success', $product->name.' '.($product->is_active ? 'activated' : 'deactivated').'.');
    }

    public function bulkAction(Request $request): RedirectResponse
    {
        $ids    = $request->input('ids', []);
        $action = $request->input('bulk_action');

        if (empty($ids) || ! $action) {
            return back()->with('error', 'Select products and an action.');
        }

        match ($action) {
            'activate'   => Product::whereIn('id', $ids)->update(['is_active' => true]),
            'deactivate' => Product::whereIn('id', $ids)->update(['is_active' => false]),
            'delete'     => Product::whereIn('id', $ids)->delete(),
            default      => null,
        };

        return back()->with('success', 'Bulk action applied to '.count($ids).' product(s).');
    }

    public function create(): View
    {
        $categories = Category::query()->orderBy('name')->get();

        return view('admin.products.create', [
            'product' => new Product,
            'categories' => $categories,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'image' => ['nullable', 'image', 'max:5120'],
            'gallery.*' => ['nullable', 'image', 'max:5120'],
        ]);
        $data = $this->validated($request, null);
        $data['image'] = $request->hasFile('image')
            ? $request->file('image')->store('products', 'public')
            : null;
        $data['gallery'] = $this->storeGalleryUploads($request);
        Product::query()->create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created.');
    }

    public function edit(Product $product): View
    {
        $categories = Category::query()->orderBy('name')->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'image' => ['nullable', 'image', 'max:5120'],
            'gallery.*' => ['nullable', 'image', 'max:5120'],
        ]);
        $data = $this->validated($request, $product);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        } else {
            unset($data['image']);
        }
        $newGallery = $this->storeGalleryUploads($request);
        if ($newGallery !== []) {
            $existing = is_array($product->gallery) ? $product->gallery : [];
            $data['gallery'] = array_values(array_merge($existing, $newGallery));
        } else {
            unset($data['gallery']);
        }
        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted.');
    }

    private function validated(Request $request, ?Product $product): array
    {
        $slugRule = Rule::unique('products', 'slug');
        if ($product) {
            $slugRule->ignore($product->id);
        }

        $data = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', $slugRule],
            'description' => ['required', 'string'],
            'short_description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'compare_price' => ['nullable', 'numeric', 'min:0'],
            'stock' => ['nullable', 'integer', 'min:0'],
            'order' => ['nullable', 'integer', 'min:0'],
            'variants_json' => ['nullable', 'string'],
            'ingredients_text' => ['nullable', 'string'],
        ]);

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_new'] = $request->boolean('is_new');
        $data['is_bestseller'] = $request->boolean('is_bestseller');
        $data['is_active'] = $request->boolean('is_active');
        $data['stock'] = (int) ($data['stock'] ?? 0);
        $data['order'] = (int) ($data['order'] ?? 0);
        $data['slug'] = filled($data['slug'] ?? null) ? $data['slug'] : Str::slug($data['name']);

        $variantsRaw = $data['variants_json'] ?? '';
        unset($data['variants_json']);
        $decoded = json_decode($variantsRaw, true);
        $data['variants'] = is_array($decoded) ? $decoded : null;

        $ingredientsLines = preg_split('/\r\n|\r|\n/', $data['ingredients_text'] ?? '');
        unset($data['ingredients_text']);
        $ingredients = collect($ingredientsLines)->map(fn ($l) => trim((string) $l))->filter()->values()->all();
        $data['ingredients'] = $ingredients === [] ? null : $ingredients;

        return $data;
    }

    /**
     * @return list<string>
     */
    private function storeGalleryUploads(Request $request): array
    {
        if (! $request->hasFile('gallery')) {
            return [];
        }
        $paths = [];
        foreach ($request->file('gallery', []) as $file) {
            if ($file && $file->isValid()) {
                $paths[] = $file->store('products/gallery', 'public');
            }
        }

        return $paths;
    }
}
