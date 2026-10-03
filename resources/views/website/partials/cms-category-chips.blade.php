{{-- Shown on the main menu page when categories exist in the CMS --}}
@isset($cmsCategories)
    @if($cmsCategories->isNotEmpty())
        <section class="px-8 py-6 bg-surface border-y border-primary/10">
            <div class="max-w-7xl mx-auto flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <p class="text-xs font-bold uppercase tracking-widest text-primary">Live from admin</p>
                    <p class="text-on-surface-variant text-sm mt-1">Categories you manage in the CMS also appear here.</p>
                </div>
                <div class="flex flex-wrap gap-2">
                    @foreach($cmsCategories as $cat)
                        <a href="{{ route('menu.show', $cat->slug) }}"
                           class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-primary-container text-primary hover:bg-primary hover:text-white transition-colors">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endisset
