@php $active = str_starts_with(request('folder', ''), $node['path']); @endphp
<div>
    <a href="{{ route('admin.media.index', ['folder' => $node['path']]) }}"
       class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request('folder') === $node['path'] ? 'bg-rose-50 text-rose-700' : 'text-slate-600 hover:bg-slate-50' }}">
        <svg class="w-4 h-4 shrink-0 {{ $active ? 'text-amber-500' : 'text-slate-400' }}" fill="currentColor" viewBox="0 0 24 24">
            <path d="M3 7a2 2 0 012-2h4l2 2h8a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/>
        </svg>
        <span class="truncate">{{ $node['name'] }}</span>
    </a>
    @if(!empty($node['children']))
        <div class="ml-4 mt-0.5 space-y-0.5">
            @foreach($node['children'] as $child)
                @include('admin.media._folder-node', ['node' => $child])
            @endforeach
        </div>
    @endif
</div>
