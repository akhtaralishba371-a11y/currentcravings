<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') — Current Cravings</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar-link { display:flex; align-items:center; gap:10px; padding:8px 12px; border-radius:8px; font-size:13px; font-weight:500; color:#94a3b8; transition:all .15s; }
        .sidebar-link:hover { background:#1e293b; color:#f1f5f9; }
        .sidebar-link.active { background:#be123c; color:#fff; }
        .sidebar-link .icon { width:18px; height:18px; flex-shrink:0; opacity:.7; }
        .sidebar-link.active .icon { opacity:1; }
        .sidebar-group-label { font-size:10px; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:#475569; padding:16px 12px 4px; }
        .badge-pill { font-size:10px; font-weight:700; padding:2px 7px; border-radius:999px; margin-left:auto; }
        [x-cloak] { display:none !important; }
    </style>
    @stack('styles')
</head>
<body class="bg-slate-100 text-slate-900 min-h-screen">
@php
    $pendingOrdersCount   = \App\Models\Order::query()->where('order_status','pending')->count();
    $unreadMessagesCount  = \App\Models\ContactMessage::query()->where('is_read',false)->count();
    $currentRoute         = request()->route()?->getName() ?? '';
    $isActive = fn(string $pattern) => request()->routeIs($pattern) ? 'active' : '';
@endphp

<div class="flex min-h-screen">

    {{-- ── SIDEBAR ── --}}
    <aside id="adminSidebar"
           class="fixed inset-y-0 left-0 z-40 w-64 bg-slate-900 flex flex-col transition-transform duration-200 -translate-x-full md:static md:translate-x-0 md:flex-shrink-0">

        {{-- Logo --}}
        <div class="flex items-center justify-between px-5 py-5 border-b border-slate-800">
            <div>
                <a href="{{ route('admin.dashboard') }}" class="text-white font-bold text-base tracking-tight leading-tight">Current Cravings</a>
                <p class="text-slate-500 text-xs mt-0.5">Admin Panel</p>
            </div>
            <button id="closeSidebar" class="md:hidden text-slate-400 hover:text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 overflow-y-auto px-3 py-3 space-y-0.5">

            <div class="sidebar-group-label">Overview</div>
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ $isActive('admin.dashboard') }}">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>

            <div class="sidebar-group-label">Shop</div>
            <a href="{{ route('admin.orders.index') }}" class="sidebar-link {{ $isActive('admin.orders.*') }}">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                Orders
                @if($pendingOrdersCount > 0)
                    <span class="badge-pill bg-amber-400 text-amber-950">{{ $pendingOrdersCount }}</span>
                @endif
            </a>
            <a href="{{ route('admin.products.index') }}" class="sidebar-link {{ $isActive('admin.products.*') }}">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                Products
            </a>
            <a href="{{ route('admin.categories.index') }}" class="sidebar-link {{ $isActive('admin.categories.*') }}">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                Categories
            </a>

            <div class="sidebar-group-label">Content</div>
            <a href="{{ route('admin.media.index') }}" class="sidebar-link {{ $isActive('admin.media.*') }}">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Media Library
            </a>
            <a href="{{ route('admin.blog-posts.index') }}" class="sidebar-link {{ $isActive('admin.blog-posts.*') }}">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Blog Posts
            </a>
            <a href="{{ route('admin.testimonials.index') }}" class="sidebar-link {{ $isActive('admin.testimonials.*') }}">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                Testimonials
            </a>
            <a href="{{ route('admin.site-content.index') }}" class="sidebar-link {{ $isActive('admin.site-content.*') }}">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/></svg>
                Site Content
            </a>

            <div class="sidebar-group-label">Customers</div>
            <a href="{{ route('admin.contact-messages.index') }}" class="sidebar-link {{ $isActive('admin.contact-messages.*') }}">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                Messages
                @if($unreadMessagesCount > 0)
                    <span class="badge-pill bg-rose-500 text-white">{{ $unreadMessagesCount }}</span>
                @endif
            </a>

            <div class="sidebar-group-label">Settings</div>
            <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ $isActive('admin.users.*') }}">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                Admin Users
            </a>
            <a href="{{ route('admin.seo-meta.index') }}" class="sidebar-link {{ $isActive('admin.seo-meta.*') }}">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                SEO Meta
            </a>
        </nav>

        {{-- Footer --}}
        <div class="px-4 py-4 border-t border-slate-800 space-y-2">
            <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2 text-xs text-slate-500 hover:text-slate-300">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                View Website
            </a>
            <form method="post" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-2 text-xs text-rose-400 hover:text-rose-300">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Log out
                </button>
            </form>
        </div>
    </aside>

    {{-- Backdrop --}}
    <div id="adminSidebarBackdrop" class="fixed inset-0 z-30 bg-black/50 hidden md:hidden"></div>

    {{-- ── MAIN ── --}}
    <div class="flex flex-col flex-1 min-w-0 min-h-screen">

        {{-- Top bar --}}
        <header class="sticky top-0 z-20 flex items-center justify-between bg-white border-b border-slate-200 px-4 py-3 shadow-sm">
            <div class="flex items-center gap-3">
                <button id="openSidebar" class="md:hidden p-1.5 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <span class="text-sm font-semibold text-slate-700">@yield('title', 'Dashboard')</span>
            </div>
            <div class="flex items-center gap-3">
                @if($pendingOrdersCount > 0)
                <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-1.5 text-xs font-semibold text-amber-700 bg-amber-50 border border-amber-200 px-3 py-1.5 rounded-full hover:bg-amber-100">
                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                    {{ $pendingOrdersCount }} pending
                </a>
                @endif
                <div class="w-8 h-8 rounded-full bg-rose-100 flex items-center justify-center text-rose-700 font-bold text-xs">
                    {{ strtoupper(substr(auth()->user()?->name ?? 'A', 0, 1)) }}
                </div>
            </div>
        </header>

        <main class="flex-1 p-4 sm:p-6 lg:p-8 overflow-x-auto">
            @if(session('success'))
                <div class="mb-5 flex items-center gap-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 text-sm font-medium">
                    <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-5 flex items-center gap-3 rounded-xl bg-red-50 border border-red-200 text-red-800 px-4 py-3 text-sm font-medium">
                    <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                    {{ session('error') }}
                </div>
            @endif
            @if($errors->any())
                <div class="mb-5 rounded-xl bg-red-50 border border-red-200 text-red-800 px-4 py-3 text-sm">
                    <ul class="list-disc pl-4 space-y-1">
                        @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</div>

<script>
(() => {
    const sidebar   = document.getElementById('adminSidebar');
    const backdrop  = document.getElementById('adminSidebarBackdrop');
    const openBtn   = document.getElementById('openSidebar');
    const closeBtn  = document.getElementById('closeSidebar');
    const open  = () => { sidebar.classList.remove('-translate-x-full'); backdrop.classList.remove('hidden'); document.body.style.overflow='hidden'; };
    const close = () => { sidebar.classList.add('-translate-x-full');    backdrop.classList.add('hidden');    document.body.style.overflow=''; };
    openBtn?.addEventListener('click', open);
    closeBtn?.addEventListener('click', close);
    backdrop?.addEventListener('click', close);
    document.addEventListener('keydown', e => e.key === 'Escape' && close());
})();
</script>
@stack('scripts')
</body>
</html>
