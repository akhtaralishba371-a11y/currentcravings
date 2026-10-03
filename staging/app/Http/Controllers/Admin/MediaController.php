<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class MediaController extends Controller
{
    private string $disk = 'public';

    // ── Index: browse folder ──────────────────────────────────────────────────
    public function index(Request $request): View
    {
        $folder = $this->sanitizePath($request->get('folder', ''));

        // All directories (for sidebar tree)
        $allDirs = $this->buildDirTree('');

        // Current folder contents
        $dirs  = collect(Storage::disk($this->disk)->directories($folder))
            ->map(fn ($d) => [
                'name'  => basename($d),
                'path'  => $d,
                'count' => count(Storage::disk($this->disk)->files($d)),
            ])->values();

        $rawFiles = Storage::disk($this->disk)->files($folder);
        $search   = trim($request->get('search', ''));

        $files = collect($rawFiles)
            ->filter(fn ($f) => $search === '' || str_contains(strtolower(basename($f)), strtolower($search)))
            ->map(fn ($f) => $this->fileInfo($f))
            ->sortByDesc('modified')
            ->values();

        // Stats
        $totalFiles = count(Storage::disk($this->disk)->allFiles(''));
        $totalSize  = collect(Storage::disk($this->disk)->allFiles(''))->sum(
            fn ($f) => Storage::disk($this->disk)->size($f)
        );

        return view('admin.media.index', compact(
            'folder', 'allDirs', 'dirs', 'files', 'search', 'totalFiles', 'totalSize'
        ));
    }

    // ── Upload files ──────────────────────────────────────────────────────────
    public function upload(Request $request): JsonResponse
    {
        $request->validate([
            'files.*' => ['required', 'file', 'max:10240',
                'mimes:jpg,jpeg,png,gif,webp,svg,pdf,mp4,mov,avi'],
            'folder'  => ['nullable', 'string', 'max:200'],
        ]);

        $folder    = $this->sanitizePath($request->get('folder', ''));
        $uploaded  = [];

        foreach ($request->file('files', []) as $file) {
            $name = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                  . '-' . time()
                  . '.' . $file->getClientOriginalExtension();

            $path = $file->storeAs($folder ?: 'uploads', $name, $this->disk);
            $uploaded[] = $this->fileInfo($path);
        }

        return response()->json(['success' => true, 'files' => $uploaded]);
    }

    // ── Create folder ─────────────────────────────────────────────────────────
    public function createFolder(Request $request): RedirectResponse
    {
        $request->validate(['name' => ['required', 'string', 'max:100', 'regex:/^[a-zA-Z0-9_\-]+$/']]);
        $parent = $this->sanitizePath($request->get('folder', ''));
        $path   = ($parent ? $parent . '/' : '') . Str::slug($request->name);

        if (! Storage::disk($this->disk)->exists($path)) {
            Storage::disk($this->disk)->makeDirectory($path);
        }

        return redirect()->route('admin.media.index', ['folder' => $path])
            ->with('success', 'Folder "' . $request->name . '" created.');
    }

    // ── Delete file ───────────────────────────────────────────────────────────
    public function deleteFile(Request $request): JsonResponse
    {
        $path = $this->sanitizePath($request->get('path', ''));

        if (! $path || ! Storage::disk($this->disk)->exists($path)) {
            return response()->json(['success' => false, 'message' => 'File not found.'], 404);
        }

        Storage::disk($this->disk)->delete($path);

        return response()->json(['success' => true]);
    }

    // ── Delete folder ─────────────────────────────────────────────────────────
    public function deleteFolder(Request $request): RedirectResponse
    {
        $path = $this->sanitizePath($request->get('path', ''));

        if ($path && Storage::disk($this->disk)->exists($path)) {
            Storage::disk($this->disk)->deleteDirectory($path);
        }

        $parent = dirname($path);
        return redirect()->route('admin.media.index', ['folder' => $parent === '.' ? '' : $parent])
            ->with('success', 'Folder deleted.');
    }

    // ── Rename file ───────────────────────────────────────────────────────────
    public function renameFile(Request $request): JsonResponse
    {
        $request->validate(['path' => 'required|string', 'name' => 'required|string|max:200']);

        $oldPath = $this->sanitizePath($request->path);
        $ext     = pathinfo($oldPath, PATHINFO_EXTENSION);
        $newName = Str::slug(pathinfo($request->name, PATHINFO_FILENAME)) . ($ext ? '.' . $ext : '');
        $newPath = dirname($oldPath) . '/' . $newName;
        $newPath = ltrim($newPath, '/');

        if (! Storage::disk($this->disk)->exists($oldPath)) {
            return response()->json(['success' => false, 'message' => 'File not found.'], 404);
        }

        Storage::disk($this->disk)->move($oldPath, $newPath);

        return response()->json(['success' => true, 'file' => $this->fileInfo($newPath)]);
    }

    // ── Helpers ───────────────────────────────────────────────────────────────
    private function sanitizePath(string $path): string
    {
        $path = str_replace(['..', '\\'], '', $path);
        return trim($path, '/');
    }

    private function fileInfo(string $path): array
    {
        $disk = Storage::disk($this->disk);
        $name = basename($path);
        $ext  = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        $size = $disk->exists($path) ? $disk->size($path) : 0;
        $url  = route('media.public', ['path' => $path], false);

        $isImage = in_array($ext, ['jpg','jpeg','png','gif','webp','svg']);

        return [
            'path'     => $path,
            'name'     => $name,
            'ext'      => $ext,
            'size'     => $size,
            'size_fmt' => $this->formatBytes($size),
            'url'      => $url,
            'is_image' => $isImage,
            'modified' => $disk->exists($path) ? $disk->lastModified($path) : 0,
            'modified_fmt' => $disk->exists($path)
                ? \Carbon\Carbon::createFromTimestamp($disk->lastModified($path))->format('M j, Y g:i A')
                : '—',
            'folder'   => dirname($path) === '.' ? '' : dirname($path),
        ];
    }

    private function formatBytes(int $bytes): string
    {
        if ($bytes >= 1048576) return round($bytes / 1048576, 1) . ' MB';
        if ($bytes >= 1024)    return round($bytes / 1024, 1) . ' KB';
        return $bytes . ' B';
    }

    private function buildDirTree(string $base): array
    {
        $dirs = Storage::disk($this->disk)->directories($base);
        $tree = [];
        foreach ($dirs as $dir) {
            $tree[] = [
                'path'     => $dir,
                'name'     => basename($dir),
                'children' => $this->buildDirTree($dir),
            ];
        }
        return $tree;
    }
}
