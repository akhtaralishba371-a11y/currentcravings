@extends('admin.layouts.app')
@section('title', 'Contact messages')

@section('content')
    <h1 class="text-2xl font-bold">Contact messages</h1>
    <div class="mt-6 bg-white rounded-xl border border-stone-200 shadow-sm overflow-x-auto">
        <table class="min-w-[720px] w-full text-sm">
            <thead class="bg-stone-50 text-left text-stone-600">
            <tr>
                <th class="px-4 py-3 font-semibold">From</th>
                <th class="px-4 py-3 font-semibold">Subject</th>
                <th class="px-4 py-3 font-semibold">Read</th>
                <th class="px-4 py-3 font-semibold">Date</th>
                <th class="px-4 py-3 font-semibold w-36"></th>
            </tr>
            </thead>
            <tbody class="divide-y divide-stone-100">
            @forelse($messages as $m)
                <tr class="hover:bg-stone-50 {{ $m->is_read ? '' : 'bg-amber-50/50' }}">
                    <td class="px-4 py-3">
                        <div class="font-medium">{{ $m->name }}</div>
                        <div class="text-stone-500 text-xs">{{ $m->email }}</div>
                    </td>
                    <td class="px-4 py-3">{{ $m->subject }}</td>
                    <td class="px-4 py-3">{{ $m->is_read ? 'Yes' : 'No' }}</td>
                    <td class="px-4 py-3 text-stone-600">{{ $m->created_at->format('M j, Y g:i a') }}</td>
                    <td class="px-4 py-3 text-right space-x-2">
                        <a href="{{ route('admin.contact-messages.show', $m) }}" class="text-rose-600 hover:underline">View</a>
                        <form action="{{ route('admin.contact-messages.destroy', $m) }}" method="post" class="inline" onsubmit="return confirm('Delete?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-4 py-8 text-center text-stone-500">No messages.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $messages->links() }}</div>
@endsection

