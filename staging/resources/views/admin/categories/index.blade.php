@extends('admin.layouts.app')
@section('title', 'Categories')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <h1 class="text-2xl font-bold">Categories</h1>
        <a href="{{ route('admin.categories.create') }}" class="rounded-lg bg-rose-500 hover:bg-rose-600 text-white text-sm font-semibold px-4 py-2">New category</a>
    </div>
    <div class="mt-6 bg-white rounded-xl border border-stone-200 shadow-sm overflow-x-auto">
        <table class="min-w-[720px] w-full text-sm">
            <thead class="bg-stone-50 text-left text-stone-600">
            <tr>
                <th class="px-4 py-3 font-semibold">Name</th>
                <th class="px-4 py-3 font-semibold">Slug</th>
                <th class="px-4 py-3 font-semibold">Order</th>
                <th class="px-4 py-3 font-semibold">Active</th>
                <th class="px-4 py-3 font-semibold w-40"></th>
            </tr>
            </thead>
            <tbody class="divide-y divide-stone-100">
            @forelse($categories as $category)
                <tr class="hover:bg-stone-50">
                    <td class="px-4 py-3 font-medium">{{ $category->name }}</td>
                    <td class="px-4 py-3 text-stone-600">{{ $category->slug }}</td>
                    <td class="px-4 py-3">{{ $category->order }}</td>
                    <td class="px-4 py-3">{{ $category->is_active ? 'Yes' : 'No' }}</td>
                    <td class="px-4 py-3 text-right space-x-2">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="text-rose-600 hover:underline">Edit</a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="post" class="inline" onsubmit="return confirm('Delete this category?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-4 py-8 text-center text-stone-500">No categories yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $categories->links() }}</div>
@endsection


