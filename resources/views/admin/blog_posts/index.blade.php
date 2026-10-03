@extends('admin.layouts.app')
@section('title', 'Blog posts')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <h1 class="text-2xl font-bold">Blog posts</h1>
        <a href="{{ route('admin.blog-posts.create') }}" class="rounded-lg bg-rose-500 hover:bg-rose-600 text-white text-sm font-semibold px-4 py-2">New post</a>
    </div>
    <div class="mt-6 bg-white rounded-xl border border-stone-200 shadow-sm overflow-x-auto">
        <table class="min-w-[720px] w-full text-sm">
            <thead class="bg-stone-50 text-left text-stone-600">
            <tr>
                <th class="px-4 py-3 font-semibold">Title</th>
                <th class="px-4 py-3 font-semibold">Category</th>
                <th class="px-4 py-3 font-semibold">Published</th>
                <th class="px-4 py-3 font-semibold w-40"></th>
            </tr>
            </thead>
            <tbody class="divide-y divide-stone-100">
            @forelse($posts as $post)
                <tr class="hover:bg-stone-50">
                    <td class="px-4 py-3 font-medium">{{ $post->title }}</td>
                    <td class="px-4 py-3">{{ $post->category }}</td>
                    <td class="px-4 py-3">{{ $post->is_published ? 'Yes' : 'No' }}</td>
                    <td class="px-4 py-3 text-right space-x-2">
                        <a href="{{ route('admin.blog-posts.edit', $post) }}" class="text-rose-600 hover:underline">Edit</a>
                        <form action="{{ route('admin.blog-posts.destroy', $post) }}" method="post" class="inline" onsubmit="return confirm('Delete?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-4 py-8 text-center text-stone-500">No posts.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $posts->links() }}</div>
@endsection

