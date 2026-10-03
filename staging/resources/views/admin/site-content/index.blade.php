@extends('admin.layouts.app')
@section('title', 'Site Content')

@section('content')
<div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="text-2xl font-bold">Site Content</h1>
        <p class="text-sm text-stone-500 mt-1">Edit text and images shown on each page of the website.</p>
    </div>
    <a href="{{ route('home') }}" target="_blank" class="text-xs text-rose-500 hover:text-rose-700 font-semibold flex items-center gap-1">
        View Website ->
    </a>
</div>

@php
$activeTab = old('_active_tab', request('tab', array_key_first($contents->toArray())));
$tabIcons = [
    'Home - Hero'       => 'HM',
    'Home - Hero Cards' => 'HC',
    'Home - Banner'     => 'HB',
    'Home - About'      => 'HA',
    'Menu Page'         => 'MN',
    'About Page'        => 'AB',
    'Contact Page'      => 'CT',
    'Checkout Page'     => 'CK',
    'Privacy Policy Page' => 'PP',
    'Terms of Service Page' => 'TS',
    'Refunds & Returns Page' => 'RF',
    'Allergen Info Page' => 'AL',
    'Delivery & Shipping Page' => 'DS',
    'General'           => 'GN',
];
@endphp

<div class="flex flex-col gap-6 items-start lg:flex-row">

    {{-- Sidebar Tabs --}}
    <aside class="w-full shrink-0 lg:w-56 lg:sticky lg:top-6">
        <nav class="bg-white rounded-xl border border-stone-200 shadow-sm overflow-x-auto lg:overflow-hidden">
            @foreach($contents as $section => $items)
            <a href="?tab={{ urlencode($section) }}"
               class="flex items-center gap-2 px-4 py-3 text-sm font-medium border-b border-stone-100 last:border-0 transition-colors whitespace-nowrap
                      {{ $activeTab === $section ? 'bg-rose-50 text-rose-700 font-bold border-l-4 border-l-rose-500' : 'text-stone-600 hover:bg-stone-50' }}">
                <span>{{ $tabIcons[$section] ?? '*' }}</span>
                <span>{{ $section }}</span>
            </a>
            @endforeach
        </nav>
        <p class="text-xs text-stone-400 mt-3 px-1">Changes appear on the website immediately after saving.</p>
    </aside>

    {{-- Content Area --}}
    <div class="flex-1 min-w-0">
        @foreach($contents as $section => $items)
        <div class="{{ $activeTab === $section ? 'block' : 'hidden' }}">

            <form method="POST" action="{{ route('admin.site-content.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="_active_tab" value="{{ $section }}">

                <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden mb-4">
                    <div class="flex items-center gap-3 bg-stone-50 border-b border-stone-200 px-6 py-4">
                        <span class="text-2xl">{{ $tabIcons[$section] ?? '*' }}</span>
                        <div>
                            <h2 class="font-bold text-stone-800">{{ $section }}</h2>
                            <p class="text-xs text-stone-400 mt-0.5">
                                @if($section === 'Home - Hero') Main hero area at the top of Home page.
                                @elseif($section === 'Home - Hero Cards') The 4 mini hero slider cards on Home page.
                                @elseif(str_contains($section,'Banner')) The pink cookie banner section on the home page.
                                @elseif($section === 'Home - About') The "About Bakery Owner" section on the home page.
                                @elseif($section === 'Menu Page') Text shown at the top of the Menu page.
                                @elseif($section === 'About Page') Content shown on the dedicated About Us page.
                                @elseif($section === 'Contact Page') Contact details shown on the Contact page.
                                @elseif($section === 'Checkout Page') Text shown on the Checkout page.
                                @elseif($section === 'Privacy Policy Page') Content shown on the Privacy Policy page.
                                @elseif($section === 'Terms of Service Page') Content shown on the Terms of Service page.
                                @elseif($section === 'Refunds & Returns Page') Content shown on the Refunds & Returns page.
                                @elseif($section === 'Allergen Info Page') Content shown on the Allergen Info page.
                                @elseif($section === 'Delivery & Shipping Page') Content shown on the Delivery & Shipping page.
                                @else Site-wide settings like logo, tagline and social links.
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="p-6 space-y-6">
                        @foreach($items as $item)
                        <div class="border-b border-stone-100 pb-6 last:border-0 last:pb-0">
                            <label class="block text-sm font-bold text-stone-700 mb-1">
                                {{ $item->label }}
                                <span class="ml-2 text-xs font-normal text-stone-400 bg-stone-100 px-2 py-0.5 rounded-full">{{ $item->type }}</span>
                            </label>

                            @if($item->type !== 'image')
                                @if(filled($item->value))
                                    <p class="text-xs text-stone-500 mb-2 flex items-start gap-1">
                                        <span class="shrink-0">Hint:</span>
                                        <span>Current value: <em>"{{ Str::limit($item->value, 120) }}"</em></span>
                                    </p>
                                @elseif(filled($item->placeholder))
                                    <p class="text-xs text-stone-400 mb-2 flex items-start gap-1">
                                        <span class="shrink-0">Hint:</span>
                                        <span>Default: <em>"{{ Str::limit($item->placeholder, 120) }}"</em></span>
                                    </p>
                                @endif
                            @endif

                            @if($item->type === 'image')
                                <div class="flex flex-col gap-4 sm:flex-row sm:items-start">
                                    @if($item->value)
                                        <img src="{{ Str::startsWith($item->value,'http') ? $item->value : route('media.public', ['path' => $item->value], false) }}"
                                             class="h-24 w-24 rounded-xl border border-stone-200 object-cover shrink-0" alt="{{ $item->label }}">
                                    @else
                                        <div class="h-24 w-24 rounded-xl border-2 border-dashed border-stone-200 flex items-center justify-center text-stone-300 text-xs shrink-0">No image</div>
                                    @endif
                                    <div class="flex-1">
                                        <input type="file" name="_file_{{ $item->key }}" accept="image/*"
                                               class="block w-full text-sm text-stone-600 file:mr-3 file:py-1.5 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-rose-50 file:text-rose-600 hover:file:bg-rose-100">
                                        <p class="text-xs text-stone-400 mt-1">Upload a new image to replace the current one. Recommended: JPG or PNG.</p>
                                    </div>
                                </div>

                            @elseif($item->type === 'checkbox')
                                <label class="inline-flex items-center gap-3 cursor-pointer">
                                    <input type="checkbox" name="{{ $item->key }}" value="1"
                                           @checked(($item->value ?? $item->placeholder ?? '0') === '1')
                                           class="h-4 w-4 rounded border-stone-300 text-rose-500 focus:ring-rose-300">
                                    <span class="text-sm text-stone-700">Enabled</span>
                                </label>
                                @if($item->key === 'stock_guard_enabled')
                                    <p class="text-xs text-stone-400 mt-1">Turn OFF to ignore stock-based out-of-stock checks site-wide.</p>
                                @elseif(str_ends_with($item->key, '_seo_index'))
                                    <p class="text-xs text-stone-400 mt-1">Turn OFF to output <code>noindex, nofollow</code> meta for this page.</p>
                                @endif

                            @elseif($item->type === 'textarea')
                                @php $isHtmlEditorField = str_ends_with($item->key, '_body_html'); @endphp
                                <textarea name="{{ $item->key }}" rows="{{ $isHtmlEditorField ? 14 : 3 }}"
                                          placeholder="{{ $item->placeholder }}"
                                          class="w-full rounded-xl border border-stone-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-rose-300 focus:border-rose-400 resize-none {{ $isHtmlEditorField ? 'js-sitecontent-html-editor' : '' }}">{{ $item->value }}</textarea>
                                @if($isHtmlEditorField)
                                    <p class="text-xs text-stone-400 mt-1">Rich editor enabled for this HTML body field.</p>
                                @endif

                            @else
                                <input type="text" name="{{ $item->key }}"
                                       value="{{ $item->value }}"
                                       placeholder="{{ $item->placeholder }}"
                                       class="w-full rounded-xl border border-stone-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-rose-300 focus:border-rose-400">
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-4">
                    <button type="submit" class="rounded-xl bg-rose-500 hover:bg-rose-600 text-white font-bold px-6 py-2.5 text-sm transition-colors">
                        Save {{ $section }}
                    </button>
                    @if(session('success') && old('_active_tab') === $section)
                        <span class="text-sm text-emerald-600 font-semibold">Saved!</span>
                    @endif
                </div>
            </form>

        </div>
        @endforeach
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.tiny.cloud/1/zn3zc3nrox0v9ksh5xojbwphfwg62pskd6l3jqmzazuh0tg0/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (!window.tinymce) return;
    const editors = document.querySelectorAll('textarea.js-sitecontent-html-editor');
    if (!editors.length) return;

    tinymce.init({
        selector: 'textarea.js-sitecontent-html-editor',
        height: 560,
        menubar: 'file edit view insert format tools table',
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'wordcount', 'emoticons',
            'codesample', 'quickbars', 'autosave'
        ],
        toolbar: [
            'undo redo',
            'blocks fontsize',
            'bold italic underline strikethrough',
            'forecolor backcolor',
            'alignleft aligncenter alignright alignjustify',
            'bullist numlist outdent indent',
            'link image media',
            'table codesample',
            'emoticons charmap',
            'removeformat',
            'fullscreen code',
            'restoredraft'
        ].join(' | '),
        toolbar_mode: 'sliding',
        block_formats: 'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Heading 4=h4; Blockquote=blockquote; Preformatted=pre',
        convert_urls: false,
        relative_urls: false,
        remove_script_host: false,
        paste_data_images: true,
        quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote',
        quickbars_image_toolbar: 'alignleft aligncenter alignright | rotateleft rotateright | imageoptions',
        content_style: [
            'body { font-family: Inter, sans-serif; font-size: 14px; color: #3a3526; line-height: 1.7; margin: 14px; }',
            'h1,h2,h3,h4 { font-weight: 800; line-height: 1.3; }',
            'a { color: #e8627d; }',
            'img { max-width: 100%; height: auto; border-radius: 8px; }',
            'blockquote { border-left: 4px solid #f27d99; margin: 0; padding: 8px 16px; background: #fff5f7; color: #7c3f52; }'
        ].join(' '),
        setup: function (editor) {
            editor.on('change input', function () {
                editor.save();
            });
        }
    });

    document.querySelectorAll('form[action*="site-content"]').forEach(function (form) {
        form.addEventListener('submit', function () {
            if (window.tinymce) {
                window.tinymce.triggerSave();
            }
        });
    });
});
</script>
@endpush



