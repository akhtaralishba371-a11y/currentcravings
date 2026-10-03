<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class BlogPostController extends Controller
{
    public function uploadImage(Request $request)
    {
        $request->validate(['file' => ['required', 'image', 'max:5120']]);
        $path = $request->file('file')->store('blog/content', 'public');
        return response()->json(['location' => route('media.public', ['path' => $path], false)]);
    }

    public function index(): View
    {
        $posts = BlogPost::query()->latest('id')->paginate(15);

        return view('admin.blog_posts.index', compact('posts'));
    }

    public function create(): View
    {
        return view('admin.blog_posts.create', ['post' => new BlogPost]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'featured_image' => ['nullable', 'image', 'max:5120'],
        ]);
        $data = $this->validated($request, null);
        $data['featured_image'] = $request->hasFile('featured_image')
            ? $request->file('featured_image')->store('blog', 'public')
            : null;
        BlogPost::query()->create($data);

        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog post created.');
    }

    public function edit(BlogPost $blog_post): View
    {
        return view('admin.blog_posts.edit', ['post' => $blog_post]);
    }

    public function update(Request $request, BlogPost $blog_post): RedirectResponse
    {
        $request->validate([
            'featured_image' => ['nullable', 'image', 'max:5120'],
        ]);
        $data = $this->validated($request, $blog_post);
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        } else {
            unset($data['featured_image']);
        }
        $blog_post->update($data);

        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog post updated.');
    }

    public function destroy(BlogPost $blog_post): RedirectResponse
    {
        $blog_post->delete();

        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog post deleted.');
    }

    private function validated(Request $request, ?BlogPost $post): array
    {
        $slugRule = Rule::unique('blog_posts', 'slug');
        if ($post) {
            $slugRule->ignore($post->id);
        }

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', $slugRule],
            'excerpt' => ['required', 'string'],
            'content' => ['required', 'string'],
            'category' => ['required', 'string', 'max:255'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:1000'],
            'canonical_url' => ['nullable', 'string', 'max:500'],
            'tags_text' => ['nullable', 'string'],
            'views' => ['nullable', 'integer', 'min:0'],
            'published_at' => ['nullable', 'date_format:Y-m-d\TH:i'],
        ]);

        $data['is_published'] = $request->boolean('is_published');
        $data['is_index'] = $request->boolean('is_index', true);
        $data['views'] = (int) ($data['views'] ?? 0);
        $data['slug'] = filled($data['slug'] ?? null) ? $data['slug'] : Str::slug($data['title']);
        $data['meta_title'] = filled($data['meta_title'] ?? null) ? trim((string) $data['meta_title']) : null;
        $data['meta_description'] = filled($data['meta_description'] ?? null) ? trim((string) $data['meta_description']) : null;
        $data['canonical_url'] = filled($data['canonical_url'] ?? null) ? trim((string) $data['canonical_url']) : null;
        $data['published_at'] = filled($data['published_at'] ?? null)
            ? Carbon::createFromFormat('Y-m-d\TH:i', (string) $data['published_at'], config('app.timezone'))
            : null;

        $tags = collect(explode(',', $data['tags_text'] ?? ''))
            ->map(fn ($t) => trim((string) $t))
            ->filter()
            ->values()
            ->all();
        unset($data['tags_text']);
        $data['tags'] = $tags === [] ? null : $tags;

        return $data;
    }
}
