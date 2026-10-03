@php
    $isEdit = $category->exists;
@endphp
<form method="post" action="{{ $isEdit ? route('admin.categories.update', $category) : route('admin.categories.store') }}" class="space-y-4 max-w-xl">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif
    <div>
        <label class="block text-sm font-medium text-stone-700">Name</label>
        <input type="text" name="name" value="{{ old('name', $category->name) }}" required
               class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2">
    </div>
    <div>
        <label class="block text-sm font-medium text-stone-700">Slug <span class="text-stone-400 font-normal">(optional)</span></label>
        <input type="text" name="slug" value="{{ old('slug', $category->slug) }}"
               class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2" placeholder="auto from name">
    </div>
    <div>
        <label class="block text-sm font-medium text-stone-700">Icon / label</label>
        <input type="text" name="icon" value="{{ old('icon', $category->icon) }}"
               class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2">
    </div>
    <div>
        <label class="block text-sm font-medium text-stone-700">Sort order</label>
        <input type="number" name="order" value="{{ old('order', $category->order ?? 0) }}" min="0"
               class="mt-1 w-32 rounded-lg border border-stone-300 px-3 py-2">
    </div>
    <label class="flex items-center gap-2 text-sm">
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $category->is_active ?? true))>
        Active
    </label>
    <div class="pt-4 flex gap-3">
        <button type="submit" class="rounded-lg bg-rose-500 hover:bg-rose-600 text-white font-semibold px-5 py-2">{{ $isEdit ? 'Update' : 'Create' }}</button>
        <a href="{{ route('admin.categories.index') }}" class="rounded-lg border border-stone-300 px-5 py-2 text-stone-700 hover:bg-stone-50">Cancel</a>
    </div>
</form>
