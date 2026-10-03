@extends('admin.layouts.app')
@section('title', 'Edit User')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold">Edit User</h1>
    <p class="text-sm text-stone-500 mt-1">Update user details or change their role.</p>
</div>

<div class="bg-white rounded-2xl border border-stone-200 shadow-sm p-6 max-w-lg">
    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-semibold text-stone-700 mb-1">Full Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                   class="w-full rounded-xl border border-stone-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-rose-300">
            @error('name')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-stone-700 mb-1">Email Address</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                   class="w-full rounded-xl border border-stone-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-rose-300">
            @error('email')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-stone-700 mb-1">
                New Password <span class="text-stone-400 font-normal">(leave blank to keep current)</span>
            </label>
            <input type="password" name="password"
                   class="w-full rounded-xl border border-stone-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-rose-300"
                   placeholder="Min 8 characters, letters & numbers">
            @error('password')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="flex items-center gap-3 p-4 bg-rose-50 border border-rose-200 rounded-xl">
            <input type="checkbox" name="is_admin" value="1" id="isAdmin"
                   @checked(old('is_admin', $user->is_admin))
                   class="w-4 h-4 accent-rose-500">
            <label for="isAdmin" class="text-sm font-semibold text-stone-700 cursor-pointer">
                👑 Grant Admin Access
                <span class="block text-xs font-normal text-stone-500 mt-0.5">This user will have full access to the admin panel.</span>
            </label>
        </div>

        <div class="flex flex-col gap-3 pt-2 sm:flex-row">
            <button type="submit" class="rounded-xl bg-rose-500 hover:bg-rose-600 text-white font-bold px-6 py-2.5 text-sm transition-colors">
                Update User
            </button>
            <a href="{{ route('admin.users.index') }}" class="rounded-xl border border-stone-300 px-6 py-2.5 text-sm text-stone-600 hover:bg-stone-50">Cancel</a>
        </div>
    </form>
</div>
@endsection
