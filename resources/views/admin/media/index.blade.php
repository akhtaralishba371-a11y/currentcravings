@extends('admin.layouts.app')
@section('title', 'Media Library')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Media Library</h1>
        <p class="text-slate-500 text-sm mt-0.5">{{ $totalFiles }} files &middot; {{ $totalSize >= 1048576 ? round($totalSize/1048576,1).' MB' : round($totalSize/1024,1).' KB' }} used</p>
    </div>
    <button onclick="document.getElementById('uploadModal').classList.remove('hidden')"
        class="inline-flex items-center gap-2 bg-rose-600 hover:bg-rose-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
        Upload Files
    </button>
</div>

<div class="flex gap-5">

    {{-- Sidebar: folder tree --}}
    <aside class="hidden lg:block w-52 shrink-0">
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-4 py-3 border-b border-slate-100 flex items-center justify-between">
                <span class="text-xs font-bold text-slate-600 uppercase tracking-wide">Folders</span>
                <button onclick="document.getElementById('folderModal').classList.remove('hidden')"
                    class="text-rose-500 hover:text-rose-700 text-xs font-bold">+ New</button>
            </div>
            <div class="p-2 space-y-0.5">
                <a href="{{ route('admin.media.index') }}"
                   class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ $folder === '' ? 'bg-rose-50 text-rose-700' : 'text-slate-600 hover:bg-slate-50' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7a2 2 0 012-2h4l2 2h8a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/></svg>
                    All Files
                </a>
                @foreach($allDirs as $dir)
                    @include('admin.media._folder-node', ['node' => $dir])
                @endforeach
            </div>
        </div>
    </aside>

    {{-- Main content --}}
    <div class="flex-1 min-w-0">

        {{-- Breadcrumb + search --}}
        <div class="flex flex-wrap items-center gap-3 mb-4">
            @if($folder)
            <nav class="flex items-center gap-1 text-sm text-slate-500">
                <a href="{{ route('admin.media.index') }}" class="hover:text-rose-600">Root</a>
                @php $parts = explode('/', $folder); $built = ''; @endphp
                @foreach($parts as $part)
                    @php $built = $built ? $built.'/'.$part : $part; @endphp
                    <span>/</span>
                    <a href="{{ route('admin.media.index', ['folder' => $built]) }}" class="hover:text-rose-600 {{ $built === $folder ? 'font-semibold text-slate-800' : '' }}">{{ $part }}</a>
                @endforeach
            </nav>
            @endif
            <form method="GET" action="{{ route('admin.media.index') }}" class="ml-auto flex gap-2">
                @if($folder)<input type="hidden" name="folder" value="{{ $folder }}">@endif
                <input type="text" name="search" value="{{ $search }}" placeholder="Search files…"
                    class="border border-slate-200 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-rose-300 w-48">
                <button class="bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm px-3 py-1.5 rounded-lg font-medium">Search</button>
            </form>
        </div>

        {{-- Sub-folders --}}
        @if($dirs->isNotEmpty())
        <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 gap-3 mb-5">
            @foreach($dirs as $dir)
            <div class="group relative bg-white border border-slate-200 rounded-xl p-3 flex items-center gap-3 hover:border-rose-300 transition-colors">
                <a href="{{ route('admin.media.index', ['folder' => $dir['path']]) }}" class="absolute inset-0 rounded-xl"></a>
                <svg class="w-8 h-8 text-amber-400 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M3 7a2 2 0 012-2h4l2 2h8a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/></svg>
                <div class="min-w-0">
                    <div class="text-sm font-semibold text-slate-800 truncate">{{ $dir['name'] }}</div>
                    <div class="text-xs text-slate-400">{{ $dir['count'] }} files</div>
                </div>
                <form method="POST" action="{{ route('admin.media.folder.delete') }}" class="relative z-10 ml-auto opacity-0 group-hover:opacity-100"
                      onsubmit="return confirm('Delete folder and all its contents?')">
                    @csrf
                    <input type="hidden" name="path" value="{{ $dir['path'] }}">
                    <button type="submit" class="text-slate-400 hover:text-red-500 p-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </button>
                </form>
            </div>
            @endforeach
        </div>
        @endif

        {{-- Files grid --}}
        @if($files->isEmpty())
            <div class="bg-white rounded-xl border border-slate-200 py-20 text-center text-slate-400">
                <svg class="w-12 h-12 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <p class="text-sm font-medium">No files here yet.</p>
                <button onclick="document.getElementById('uploadModal').classList.remove('hidden')"
                    class="mt-3 text-rose-600 hover:text-rose-800 text-sm font-semibold underline">Upload files</button>
            </div>
        @else
        <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-3">
            @foreach($files as $file)
            <div class="group bg-white border border-slate-200 rounded-xl overflow-hidden hover:border-rose-300 hover:shadow-md transition-all"
                 x-data="{ renaming: false, name: '{{ addslashes($file['name']) }}' }">

                {{-- Preview --}}
                <div class="h-36 bg-slate-50 flex items-center justify-center overflow-hidden relative">
                    @if($file['is_image'])
                        <img src="{{ $file['url'] }}" alt="{{ $file['name'] }}" class="w-full h-full object-cover">
                    @else
                        <div class="flex flex-col items-center gap-1 text-slate-400">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                            <span class="text-xs font-bold uppercase">{{ $file['ext'] }}</span>
                        </div>
                    @endif
                    {{-- Actions overlay --}}
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                        <a href="{{ $file['url'] }}" target="_blank"
                           class="bg-white/90 hover:bg-white text-slate-800 p-1.5 rounded-lg" title="View">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </a>
                        <button @click="renaming = true"
                            class="bg-white/90 hover:bg-white text-slate-800 p-1.5 rounded-lg" title="Rename">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </button>
                        <button onclick="copyUrl('{{ $file['url'] }}')"
                            class="bg-white/90 hover:bg-white text-slate-800 p-1.5 rounded-lg" title="Copy URL">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        </button>
                        <button onclick="deleteFile('{{ $file['path'] }}', this)"
                            class="bg-red-500/90 hover:bg-red-600 text-white p-1.5 rounded-lg" title="Delete">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                </div>

                {{-- Info / rename --}}
                <div class="p-2.5">
                    <template x-if="!renaming">
                        <p class="text-xs font-medium text-slate-700 truncate" :title="name">{{ $file['name'] }}</p>
                    </template>
                    <template x-if="renaming">
                        <form @submit.prevent="submitRename('{{ $file['path'] }}', name, $el); renaming = false" class="flex gap-1">
                            <input x-model="name" class="border border-slate-300 rounded px-1.5 py-0.5 text-xs flex-1 min-w-0 focus:outline-none focus:ring-1 focus:ring-rose-400" @keydown.escape="renaming = false">
                            <button type="submit" class="text-emerald-600 hover:text-emerald-800 text-xs font-bold px-1">✓</button>
                            <button type="button" @click="renaming = false" class="text-slate-400 hover:text-slate-600 text-xs px-1">✕</button>
                        </form>
                    </template>
                    <p class="text-[10px] text-slate-400 mt-0.5">{{ $file['size_fmt'] }} &middot; {{ $file['modified_fmt'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

{{-- Upload Modal --}}
<div id="uploadModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-bold text-slate-800">Upload Files</h2>
            <button onclick="document.getElementById('uploadModal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div id="dropZone"
             class="border-2 border-dashed border-slate-300 rounded-xl p-8 text-center cursor-pointer hover:border-rose-400 transition-colors"
             onclick="document.getElementById('fileInput').click()"
             ondragover="event.preventDefault(); this.classList.add('border-rose-400')"
             ondragleave="this.classList.remove('border-rose-400')"
             ondrop="handleDrop(event)">
            <svg class="w-10 h-10 mx-auto text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
            <p class="text-sm text-slate-500">Drag & drop or <span class="text-rose-600 font-semibold">browse</span></p>
            <p class="text-xs text-slate-400 mt-1">JPG, PNG, GIF, WEBP, SVG, PDF, MP4 — max 10 MB each</p>
        </div>
        <input type="file" id="fileInput" multiple accept="image/*,video/*,.pdf,.svg" class="hidden" onchange="uploadFiles(this.files)">
        <div id="uploadProgress" class="mt-3 space-y-2 hidden"></div>
        <input type="hidden" id="uploadFolder" value="{{ $folder }}">
    </div>
</div>

{{-- Create Folder Modal --}}
<div id="folderModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-bold text-slate-800">New Folder</h2>
            <button onclick="document.getElementById('folderModal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form method="POST" action="{{ route('admin.media.folder.create') }}">
            @csrf
            <input type="hidden" name="folder" value="{{ $folder }}">
            <input type="text" name="name" placeholder="folder-name" required
                pattern="[a-zA-Z0-9_\-]+"
                title="Letters, numbers, hyphens and underscores only"
                class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-rose-300 mb-4">
            <button type="submit" class="w-full bg-rose-600 hover:bg-rose-700 text-white font-semibold py-2 rounded-lg text-sm transition-colors">
                Create Folder
            </button>
        </form>
    </div>
</div>

{{-- Toast --}}
<div id="toast" class="hidden fixed bottom-5 right-5 z-50 bg-slate-800 text-white text-sm font-medium px-4 py-2.5 rounded-xl shadow-lg"></div>

@endsection

@push('scripts')
<script src="//unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
const CSRF = '{{ csrf_token() }}';

function showToast(msg, color = '#1e293b') {
    const t = document.getElementById('toast');
    t.textContent = msg;
    t.style.background = color;
    t.classList.remove('hidden');
    setTimeout(() => t.classList.add('hidden'), 3000);
}

function copyUrl(url) {
    navigator.clipboard.writeText(location.origin + url).then(() => showToast('URL copied!'));
}

function deleteFile(path, btn) {
    if (!confirm('Delete this file?')) return;
    fetch('{{ route('admin.media.file.delete') }}', {
        method: 'DELETE',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
        body: JSON.stringify({ path })
    }).then(r => r.json()).then(d => {
        if (d.success) { btn.closest('.group').remove(); showToast('File deleted.', '#dc2626'); }
        else showToast(d.message || 'Error.', '#dc2626');
    });
}

function submitRename(path, name, form) {
    fetch('{{ route('admin.media.file.rename') }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
        body: JSON.stringify({ path, name })
    }).then(r => r.json()).then(d => {
        if (d.success) { showToast('Renamed!'); setTimeout(() => location.reload(), 800); }
        else showToast(d.message || 'Error.', '#dc2626');
    });
}

function handleDrop(e) {
    e.preventDefault();
    document.getElementById('dropZone').classList.remove('border-rose-400');
    uploadFiles(e.dataTransfer.files);
}

function uploadFiles(files) {
    if (!files.length) return;
    const progress = document.getElementById('uploadProgress');
    progress.classList.remove('hidden');
    progress.innerHTML = '';

    const folder = document.getElementById('uploadFolder').value;
    const fd = new FormData();
    fd.append('folder', folder);
    Array.from(files).forEach(f => fd.append('files[]', f));

    const bar = document.createElement('div');
    bar.className = 'text-xs text-slate-600';
    bar.textContent = `Uploading ${files.length} file(s)…`;
    progress.appendChild(bar);

    fetch('{{ route('admin.media.upload') }}', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': CSRF },
        body: fd
    }).then(r => r.json()).then(d => {
        if (d.success) {
            showToast(`${d.files.length} file(s) uploaded!`, '#059669');
            setTimeout(() => location.reload(), 800);
        } else {
            bar.textContent = 'Upload failed.';
            bar.classList.add('text-red-500');
        }
    }).catch(() => {
        bar.textContent = 'Upload error.';
        bar.classList.add('text-red-500');
    });
}
</script>
@endpush
