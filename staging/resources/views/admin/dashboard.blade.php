@extends('admin.layouts.app')
@section('title', 'Dashboard')

@push('styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
@endpush

@section('content')

{{-- Page header --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Dashboard</h1>
        <p class="text-slate-500 text-sm mt-0.5">{{ now()->format('l, F j Y') }}</p>
    </div>
    <div class="flex gap-2">
        <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 bg-rose-600 hover:bg-rose-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add Product
        </a>
        <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 text-sm font-semibold px-4 py-2 rounded-lg transition-colors">
            View Orders
        </a>
    </div>
</div>

{{-- Alerts --}}
@if($unread_messages > 0)
<div class="mb-4 flex flex-wrap items-center gap-3 rounded-xl bg-amber-50 border border-amber-200 px-4 py-3 text-amber-900 text-sm">
    <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a8 8 0 100 16A8 8 0 0010 2zm0 3a1 1 0 011 1v4a1 1 0 11-2 0V6a1 1 0 011-1zm0 8a1 1 0 100 2 1 1 0 000-2z"/></svg>
    <span>You have <strong>{{ $unread_messages }}</strong> unread message(s).</span>
    <a href="{{ route('admin.contact-messages.index') }}" class="ml-auto underline font-semibold text-amber-800 hover:text-amber-600">Review →</a>
</div>
@endif
@if($pending_orders > 0)
<div class="mb-4 flex flex-wrap items-center gap-3 rounded-xl bg-rose-50 border border-rose-200 px-4 py-3 text-rose-900 text-sm">
    <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M3 3h14a1 1 0 011 1v1H2V4a1 1 0 011-1zm-1 4h16l-1.4 9.8A2 2 0 0114.62 18H5.38a2 2 0 01-1.98-1.2L2 7z"/></svg>
    <span><strong>{{ $pending_orders }}</strong> order(s) need attention.</span>
    <a href="{{ route('admin.orders.index') }}" class="ml-auto underline font-semibold text-rose-800 hover:text-rose-600">View Orders →</a>
</div>
@endif

{{-- Stat Cards --}}
<div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-6 gap-4 mb-6">
    @php
    $stats = [
        ['label'=>'Revenue',    'value'=>'£'.number_format($total_revenue,2), 'sub'=>'paid orders',       'icon'=>'💰', 'bg'=>'bg-emerald-50', 'border'=>'border-emerald-200', 'text'=>'text-emerald-700', 'href'=>route('admin.orders.index')],
        ['label'=>'Orders',     'value'=>$counts['orders'],                   'sub'=>$pending_orders.' pending', 'icon'=>'📦', 'bg'=>'bg-rose-50',    'border'=>'border-rose-200',    'text'=>'text-rose-700',    'href'=>route('admin.orders.index')],
        ['label'=>'Products',   'value'=>$counts['products'],                 'sub'=>'in catalogue',      'icon'=>'🍪', 'bg'=>'bg-orange-50',  'border'=>'border-orange-200',  'text'=>'text-orange-700',  'href'=>route('admin.products.index')],
        ['label'=>'Categories', 'value'=>$counts['categories'],               'sub'=>'active groups',     'icon'=>'🗂️', 'bg'=>'bg-blue-50',    'border'=>'border-blue-200',    'text'=>'text-blue-700',    'href'=>route('admin.categories.index')],
        ['label'=>'Blog Posts', 'value'=>$counts['blog_posts'],               'sub'=>'published',         'icon'=>'✍️', 'bg'=>'bg-purple-50',  'border'=>'border-purple-200',  'text'=>'text-purple-700',  'href'=>route('admin.blog-posts.index')],
        ['label'=>'Messages',   'value'=>$counts['contact_messages'],         'sub'=>$unread_messages.' unread', 'icon'=>'💬', 'bg'=>'bg-amber-50',   'border'=>'border-amber-200',   'text'=>'text-amber-700',   'href'=>route('admin.contact-messages.index')],
    ];
    @endphp
    @foreach($stats as $s)
    <a href="{{ $s['href'] }}" class="rounded-xl bg-white border {{ $s['border'] }} p-4 shadow-sm hover:shadow-md transition-all group">
        <div class="text-2xl mb-2">{{ $s['icon'] }}</div>
        <div class="text-2xl font-black {{ $s['text'] }}">{{ $s['value'] }}</div>
        <div class="text-xs text-slate-500 mt-0.5 font-medium">{{ $s['label'] }}</div>
        <div class="text-[10px] text-slate-400 mt-0.5">{{ $s['sub'] }}</div>
    </a>
    @endforeach
</div>

{{-- Charts Row --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-6">

    {{-- Revenue Chart --}}
    <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h2 class="font-bold text-slate-800">Revenue — Last 7 Days</h2>
                <p class="text-xs text-slate-400 mt-0.5">Paid orders only</p>
            </div>
            <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 border border-emerald-200 px-2.5 py-1 rounded-full">
                £{{ number_format($revenue_7days->sum('revenue'), 2) }} this week
            </span>
        </div>
        <canvas id="revenueChart" height="100"></canvas>
    </div>

    {{-- Order Status Donut --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
        <h2 class="font-bold text-slate-800 mb-1">Orders by Status</h2>
        <p class="text-xs text-slate-400 mb-4">All time</p>
        <canvas id="statusChart" height="180"></canvas>
        <div class="mt-4 space-y-1.5">
            @foreach($order_status_counts as $status => $count)
            @php
            $colors = ['pending'=>'bg-amber-400','confirmed'=>'bg-blue-400','preparing'=>'bg-purple-400','out_for_delivery'=>'bg-orange-400','delivered'=>'bg-emerald-400','cancelled'=>'bg-red-400'];
            $color = $colors[$status] ?? 'bg-slate-400';
            @endphp
            <div class="flex items-center justify-between text-xs">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full {{ $color }}"></span>
                    <span class="text-slate-600 capitalize">{{ str_replace('_',' ',$status) }}</span>
                </div>
                <span class="font-bold text-slate-800">{{ $count }}</span>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Tables Row --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-5">

    {{-- Recent Orders --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
            <h2 class="font-bold text-slate-800 text-sm">Recent Orders</h2>
            <a href="{{ route('admin.orders.index') }}" class="text-xs text-rose-500 hover:text-rose-700 font-semibold">View all →</a>
        </div>
        @if($recent_orders->isEmpty())
            <div class="px-5 py-10 text-center text-slate-400 text-sm">No orders yet.</div>
        @else
        <div class="divide-y divide-slate-50">
            @foreach($recent_orders as $order)
            <a href="{{ route('admin.orders.show', $order) }}" class="flex items-center gap-3 px-5 py-3 hover:bg-slate-50 transition-colors">
                <div class="w-8 h-8 rounded-full bg-rose-100 flex items-center justify-center text-rose-600 font-bold text-xs shrink-0">
                    {{ strtoupper(substr($order->customer_name ?? 'O', 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-sm font-semibold text-slate-800 truncate">{{ $order->customer_name ?? 'Customer' }}</div>
                    <div class="text-xs text-slate-400">{{ $order->order_number }} · {{ $order->created_at->diffForHumans() }}</div>
                </div>
                <div class="text-right shrink-0">
                    <div class="text-sm font-bold text-slate-800">£{{ number_format($order->total, 2) }}</div>
                    <span class="inline-block text-[10px] font-bold px-2 py-0.5 rounded-full {{ $order->status_badge }}">
                        {{ ucfirst(str_replace('_',' ',$order->order_status)) }}
                    </span>
                </div>
            </a>
            @endforeach
        </div>
        @endif
    </div>

    {{-- Top Products --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
            <h2 class="font-bold text-slate-800 text-sm">Top Products</h2>
            <a href="{{ route('admin.products.index') }}" class="text-xs text-rose-500 hover:text-rose-700 font-semibold">Manage →</a>
        </div>
        @if($top_products->isEmpty())
            <div class="px-5 py-10 text-center text-slate-400 text-sm">No data yet.</div>
        @else
        <div class="divide-y divide-slate-50">
            @foreach($top_products as $i => $item)
            <div class="flex items-center gap-3 px-5 py-3">
                <span class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center text-xs font-bold text-slate-500 shrink-0">{{ $i+1 }}</span>
                <div class="flex-1 min-w-0">
                    <div class="text-sm font-semibold text-slate-800 truncate">{{ $item->product_name }}</div>
                    <div class="text-xs text-slate-400">{{ $item->total_qty }} units sold</div>
                </div>
                <div class="text-sm font-bold text-emerald-600">£{{ number_format($item->total_revenue, 2) }}</div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

{{-- Recent Messages + Quick Actions --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

    {{-- Messages --}}
    <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
            <h2 class="font-bold text-slate-800 text-sm">Recent Messages</h2>
            <a href="{{ route('admin.contact-messages.index') }}" class="text-xs text-rose-500 hover:text-rose-700 font-semibold">View all →</a>
        </div>
        @if($recent_messages->isEmpty())
            <div class="px-5 py-10 text-center text-slate-400 text-sm">No messages yet.</div>
        @else
        <div class="divide-y divide-slate-50">
            @foreach($recent_messages as $msg)
            <a href="{{ route('admin.contact-messages.show', $msg) }}" class="flex items-center gap-3 px-5 py-3 hover:bg-slate-50 transition-colors">
                <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center text-amber-600 font-bold text-xs shrink-0">
                    {{ strtoupper(substr($msg->name ?? 'M', 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-semibold text-slate-800 truncate">{{ $msg->name }}</span>
                        @if(!$msg->is_read)<span class="w-2 h-2 rounded-full bg-rose-500 shrink-0"></span>@endif
                    </div>
                    <div class="text-xs text-slate-400 truncate">{{ $msg->subject ?? Str::limit($msg->message, 60) }}</div>
                </div>
                <div class="text-xs text-slate-400 shrink-0">{{ $msg->created_at->diffForHumans() }}</div>
            </a>
            @endforeach
        </div>
        @endif
    </div>

    {{-- Quick Actions --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
        <h2 class="font-bold text-slate-800 text-sm mb-4">Quick Actions</h2>
        <div class="grid grid-cols-2 gap-2">
            @php
            $actions = [
                ['label'=>'Add Product',    'icon'=>'🍪', 'href'=>route('admin.products.create'),    'bg'=>'bg-orange-50 hover:bg-orange-100 border-orange-200 text-orange-700'],
                ['label'=>'Add Category',   'icon'=>'🗂️', 'href'=>route('admin.categories.create'),  'bg'=>'bg-blue-50 hover:bg-blue-100 border-blue-200 text-blue-700'],
                ['label'=>'New Blog Post',  'icon'=>'✍️', 'href'=>route('admin.blog-posts.create'),  'bg'=>'bg-purple-50 hover:bg-purple-100 border-purple-200 text-purple-700'],
                ['label'=>'Testimonial',    'icon'=>'⭐', 'href'=>route('admin.testimonials.create'),'bg'=>'bg-yellow-50 hover:bg-yellow-100 border-yellow-200 text-yellow-700'],
                ['label'=>'View Orders',    'icon'=>'📦', 'href'=>route('admin.orders.index'),        'bg'=>'bg-rose-50 hover:bg-rose-100 border-rose-200 text-rose-700'],
                ['label'=>'Site Content',   'icon'=>'🎨', 'href'=>route('admin.site-content.index'), 'bg'=>'bg-emerald-50 hover:bg-emerald-100 border-emerald-200 text-emerald-700'],
                ['label'=>'Media Library',  'icon'=>'🖼️', 'href'=>route('admin.media.index'),           'bg'=>'bg-sky-50 hover:bg-sky-100 border-sky-200 text-sky-700'],
            ];
            @endphp
            @foreach($actions as $a)
            <a href="{{ $a['href'] }}" class="flex flex-col items-center gap-1.5 p-3 rounded-xl border {{ $a['bg'] }} transition-colors text-center">
                <span class="text-xl">{{ $a['icon'] }}</span>
                <span class="text-xs font-bold leading-tight">{{ $a['label'] }}</span>
            </a>
            @endforeach
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// Revenue Chart
const revenueData = @json($revenue_7days);
const labels = revenueData.map(d => d.date);
const values = revenueData.map(d => parseFloat(d.revenue));

new Chart(document.getElementById('revenueChart'), {
    type: 'bar',
    data: {
        labels,
        datasets: [{
            label: 'Revenue (£)',
            data: values,
            backgroundColor: 'rgba(225,29,72,0.15)',
            borderColor: 'rgba(225,29,72,0.8)',
            borderWidth: 2,
            borderRadius: 6,
            borderSkipped: false,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false }, tooltip: { callbacks: { label: ctx => '£' + ctx.parsed.y.toFixed(2) } } },
        scales: { y: { beginAtZero: true, ticks: { callback: v => '£'+v } }, x: { grid: { display: false } } }
    }
});

// Status Donut
const statusData = @json($order_status_counts);
const statusLabels = Object.keys(statusData).map(s => s.replace(/_/g,' '));
const statusValues = Object.values(statusData);
const statusColors = ['#fbbf24','#60a5fa','#a78bfa','#fb923c','#34d399','#f87171'];

new Chart(document.getElementById('statusChart'), {
    type: 'doughnut',
    data: {
        labels: statusLabels,
        datasets: [{ data: statusValues, backgroundColor: statusColors, borderWidth: 2, borderColor: '#fff' }]
    },
    options: {
        responsive: true,
        cutout: '65%',
        plugins: { legend: { display: false } }
    }
});
</script>
@endpush
