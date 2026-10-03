@extends('admin.layouts.app')
@section('title', 'Message')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <h1 class="text-2xl font-bold">Message from {{ $message->name }}</h1>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.contact-messages.edit', $message) }}" class="rounded-lg bg-stone-200 hover:bg-stone-300 px-4 py-2 text-sm font-semibold text-center w-full sm:w-auto">Edit / mark read</a>
            <a href="{{ route('admin.contact-messages.index') }}" class="rounded-lg border border-stone-300 px-4 py-2 text-sm text-center w-full sm:w-auto">Back</a>
        </div>
    </div>
    <dl class="mt-8 space-y-4 max-w-2xl bg-white rounded-xl border border-stone-200 p-6">
        <div><dt class="text-xs font-semibold text-stone-500 uppercase">Email</dt><dd class="mt-1">{{ $message->email }}</dd></div>
        <div><dt class="text-xs font-semibold text-stone-500 uppercase">Phone</dt><dd class="mt-1">{{ $message->phone ?? '—' }}</dd></div>
        <div><dt class="text-xs font-semibold text-stone-500 uppercase">Topic</dt><dd class="mt-1">{{ $message->topic }}</dd></div>
        <div><dt class="text-xs font-semibold text-stone-500 uppercase">Subject</dt><dd class="mt-1">{{ $message->subject }}</dd></div>
        <div><dt class="text-xs font-semibold text-stone-500 uppercase">Message</dt><dd class="mt-1 whitespace-pre-wrap">{{ $message->message }}</dd></div>
        @if($message->additional_data)
            <div><dt class="text-xs font-semibold text-stone-500 uppercase">Additional data</dt><dd class="mt-1 font-mono text-xs">{{ json_encode($message->additional_data) }}</dd></div>
        @endif
    </dl>
@endsection


