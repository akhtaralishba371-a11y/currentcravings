@extends('admin.layouts.app')
@section('title', 'Testimonials')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <h1 class="text-2xl font-bold">Testimonials</h1>
        <a href="{{ route('admin.testimonials.create') }}" class="rounded-lg bg-rose-500 hover:bg-rose-600 text-white text-sm font-semibold px-4 py-2">New testimonial</a>
    </div>
    <div class="mt-6 bg-white rounded-xl border border-stone-200 shadow-sm overflow-x-auto">
        <table class="min-w-[720px] w-full text-sm">
            <thead class="bg-stone-50 text-left text-stone-600">
            <tr>
                <th class="px-4 py-3 font-semibold">Name</th>
                <th class="px-4 py-3 font-semibold">Rating</th>
                <th class="px-4 py-3 font-semibold">Approved</th>
                <th class="px-4 py-3 font-semibold">Featured</th>
                <th class="px-4 py-3 font-semibold w-40"></th>
            </tr>
            </thead>
            <tbody class="divide-y divide-stone-100">
            @forelse($testimonials as $t)
                <tr class="hover:bg-stone-50">
                    <td class="px-4 py-3 font-medium">{{ $t->name }}</td>
                    <td class="px-4 py-3">{{ $t->rating }}</td>
                    <td class="px-4 py-3">{{ $t->is_approved ? 'Yes' : 'No' }}</td>
                    <td class="px-4 py-3">{{ $t->is_featured ? 'Yes' : 'No' }}</td>
                    <td class="px-4 py-3 text-right space-x-2">
                        <a href="{{ route('admin.testimonials.edit', $t) }}" class="text-rose-600 hover:underline">Edit</a>
                        <form action="{{ route('admin.testimonials.destroy', $t) }}" method="post" class="inline" onsubmit="return confirm('Delete?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-4 py-8 text-center text-stone-500">No testimonials.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $testimonials->links() }}</div>
@endsection

