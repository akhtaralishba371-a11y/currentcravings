@php $isEdit = $testimonial->exists; @endphp
<form method="post" enctype="multipart/form-data" action="{{ $isEdit ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}" class="space-y-4 max-w-2xl">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif
    <div>
        <label class="block text-sm font-medium text-stone-700">Name</label>
        <input type="text" name="name" value="{{ old('name', $testimonial->name) }}" required class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2">
    </div>
    <div>
        <label class="block text-sm font-medium text-stone-700">Location</label>
        <input type="text" name="location" value="{{ old('location', $testimonial->location) }}" class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2">
    </div>
    <div>
        <label class="block text-sm font-medium text-stone-700">Content</label>
        <textarea name="content" rows="5" required class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2">{{ old('content', $testimonial->content) }}</textarea>
    </div>
    <div>
        <label class="block text-sm font-medium text-stone-700">Rating (1–5)</label>
        <input type="number" name="rating" min="1" max="5" value="{{ old('rating', $testimonial->rating ?? 5) }}" class="mt-1 w-24 rounded-lg border border-stone-300 px-3 py-2">
    </div>
    <div>
        <label class="block text-sm font-medium text-stone-700">Photo</label>
        <input type="file" name="image" accept="image/*" class="mt-1 block w-full text-sm">
        @if($isEdit && $testimonial->image)
            <p class="text-xs text-stone-500 mt-1">Current: {{ $testimonial->image }}</p>
        @endif
    </div>
    <div class="flex gap-4 text-sm">
        <label class="flex items-center gap-2"><input type="checkbox" name="is_approved" value="1" @checked(old('is_approved', $testimonial->is_approved ?? true))> Approved</label>
        <label class="flex items-center gap-2"><input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $testimonial->is_featured))> Featured</label>
    </div>
    <div class="pt-4 flex gap-3">
        <button type="submit" class="rounded-lg bg-rose-500 hover:bg-rose-600 text-white font-semibold px-5 py-2">{{ $isEdit ? 'Update' : 'Create' }}</button>
        <a href="{{ route('admin.testimonials.index') }}" class="rounded-lg border border-stone-300 px-5 py-2 text-stone-700 hover:bg-stone-50">Cancel</a>
    </div>
</form>
