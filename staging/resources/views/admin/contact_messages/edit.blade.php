@extends('admin.layouts.app')
@section('title', 'Edit message')

@section('content')
    <h1 class="text-2xl font-bold">Contact message</h1>
    <p class="text-stone-600 mt-1">{{ $message->name }} — {{ $message->email }}</p>
    <form method="post" action="{{ route('admin.contact-messages.update', $message) }}" class="mt-8 space-y-4 max-w-2xl">
        @csrf
        @method('PUT')
        <label class="flex items-center gap-2 text-sm">
            <input type="checkbox" name="is_read" value="1" @checked(old('is_read', $message->is_read))>
            Mark as read
        </label>
        <div>
            <label class="block text-sm font-medium text-stone-700">Additional data (JSON object, optional)</label>
            <textarea name="additional_data_json" rows="4" class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 font-mono text-xs">{{ old('additional_data_json', $message->additional_data ? json_encode($message->additional_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : '') }}</textarea>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="rounded-lg bg-rose-500 hover:bg-rose-600 text-white font-semibold px-5 py-2">Save</button>
            <a href="{{ route('admin.contact-messages.show', $message) }}" class="rounded-lg border border-stone-300 px-5 py-2">Cancel</a>
        </div>
    </form>
@endsection
