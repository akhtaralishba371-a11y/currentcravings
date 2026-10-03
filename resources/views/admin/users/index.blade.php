@extends('admin.layouts.app')
@section('title', 'Admin Users')

@section('content')
<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="text-2xl font-bold">Admin Users</h1>
        <p class="text-sm text-stone-500 mt-1">Manage who has access to the admin panel.</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="inline-flex w-full items-center justify-center rounded-lg bg-rose-500 hover:bg-rose-600 text-white font-semibold px-4 py-2 text-sm sm:w-auto">+ Add User</a>
</div>

<div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-x-auto">
    <table class="min-w-[760px] w-full text-sm">
        <thead class="bg-stone-50 border-b border-stone-200">
            <tr>
                <th class="text-left px-5 py-3 font-semibold text-stone-600">Name</th>
                <th class="text-left px-5 py-3 font-semibold text-stone-600">Email</th>
                <th class="text-left px-5 py-3 font-semibold text-stone-600">Role</th>
                <th class="text-left px-5 py-3 font-semibold text-stone-600">Created</th>
                <th class="px-5 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-stone-100">
            @foreach($users as $user)
            <tr class="hover:bg-stone-50">
                <td class="px-5 py-3 font-medium text-stone-800">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-rose-100 flex items-center justify-center text-rose-600 font-bold text-xs shrink-0">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        {{ $user->name }}
                        @if($user->id === auth()->id())
                            <span class="text-xs bg-stone-100 text-stone-500 px-2 py-0.5 rounded-full">You</span>
                        @endif
                    </div>
                </td>
                <td class="px-5 py-3 text-stone-600">{{ $user->email }}</td>
                <td class="px-5 py-3">
                    @if($user->is_admin)
                        <span class="inline-flex items-center gap-1 text-xs font-bold px-2.5 py-1 rounded-full bg-rose-50 text-rose-700 border border-rose-200">
                            👑 Admin
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 text-xs font-bold px-2.5 py-1 rounded-full bg-stone-100 text-stone-500">
                            User
                        </span>
                    @endif
                </td>
                <td class="px-5 py-3 text-stone-400 text-xs">{{ $user->created_at->format('M j, Y') }}</td>
                <td class="px-5 py-3">
                    <div class="flex items-center gap-2 justify-end">
                        <a href="{{ route('admin.users.edit', $user) }}" class="text-xs font-semibold text-stone-600 hover:text-rose-600">Edit</a>
                        @if($user->id !== auth()->id())
                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Delete {{ $user->name }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-xs font-semibold text-red-400 hover:text-red-600">Delete</button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
