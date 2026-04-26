<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Hero Section -->
    <div class="text-center mb-16">
        <h1 class="text-4xl font-extrabold tracking-tight text-foreground sm:text-5xl md:text-6xl">
            <span class="block">{{ __('Find your next') }}</span>
            <span class="block text-primary">Elite Talent Opportunity</span>
        </h1>
        <p class="mt-3 max-w-md mx-auto text-base text-muted-foreground sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
            Secure-Talent connects top professionals with international recruitment agencies.
        </p>
        
        <div class="mt-10 max-w-2xl mx-auto">
            <div class="relative">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search by title, location..." 
                    class="block w-full px-5 py-4 text-lg border border-border rounded-2xl bg-card shadow-sm focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                    <svg class="h-6 w-6 text-muted-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar Filters -->
        <aside class="w-full lg:w-64 space-y-8">
            <div>
                <h3 class="text-sm font-semibold text-foreground uppercase tracking-wider mb-4">Location</h3>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="radio" wire:model.live="category" value="" class="form-radio text-primary rounded border-border">
                        <span class="ml-2 text-sm text-muted-foreground">All Locations</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" wire:model.live="category" value="Remote" class="form-radio text-primary rounded border-border">
                        <span class="ml-2 text-sm text-muted-foreground">Remote</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" wire:model.live="category" value="Madrid" class="form-radio text-primary rounded border-border">
                        <span class="ml-2 text-sm text-muted-foreground">Madrid</span>
                    </label>
                </div>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-foreground uppercase tracking-wider mb-4">Employment Type</h3>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="checkbox" class="form-checkbox text-primary rounded border-border">
                        <span class="ml-2 text-sm text-muted-foreground">Full-time</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="form-checkbox text-primary rounded border-border">
                        <span class="ml-2 text-sm text-muted-foreground">Contract</span>
                    </label>
                </div>
            </div>
        </aside>

        <!-- Job Grid -->
        <div class="flex-1">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($offers as $offer)
                    <div class="bg-card border border-border rounded-2xl p-6 hover:shadow-lg transition-all group">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="text-xl font-bold text-foreground group-hover:text-primary transition-colors">
                                    {{ $offer->getTranslation('title', app()->getLocale()) }}
                                </h4>
                                <p class="text-sm text-muted-foreground">{{ $offer->location }} • {{ $offer->salary_range }}</p>
                            </div>
                            <span class="px-3 py-1 bg-primary/10 text-primary text-xs font-semibold rounded-full capitalize">
                                {{ $offer->status }}
                            </span>
                        </div>
                        <p class="text-sm text-muted-foreground line-clamp-3 mb-6">
                            {{ Str::limit($offer->getTranslation('description', app()->getLocale()), 120) }}
                        </p>
                        <div class="flex items-center justify-between mt-auto">
                            <div class="flex space-x-2">
                                <span class="px-2 py-1 bg-muted text-muted-foreground text-[10px] uppercase font-bold rounded">Laravel</span>
                                <span class="px-2 py-1 bg-muted text-muted-foreground text-[10px] uppercase font-bold rounded">Cybersec</span>
                            </div>
                            <button wire:click="showOffer({{ $offer->id }})" class="inline-flex items-center text-sm font-semibold text-primary hover:underline focus:outline-none">
                                Ver Oferta
                                <svg class="ml-1 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $offers->links() }}
            </div>
        </div>
    </div>
    <!-- Modal for Offer Details -->
    @if($selectedOffer)
        <div class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-background/80 backdrop-blur-sm transition-opacity" wire:click="closeOffer"></div>

            <!-- Modal Content -->
            <div class="relative bg-card border border-border rounded-3xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-hidden flex flex-col animate-fade-up">
                
                <div class="px-6 py-5 border-b border-border flex justify-between items-center bg-surface">
                    <h2 class="text-xl font-bold text-foreground">Detalles de la Oferta</h2>
                    <button wire:click="closeOffer" class="text-muted-foreground hover:text-foreground transition-colors p-2 rounded-full hover:bg-muted">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="p-6 overflow-y-auto flex-1">
                    <div class="mb-6">
                        <h3 class="text-2xl font-extrabold text-foreground mb-2">
                            {{ $selectedOffer->getTranslation('title', app()->getLocale()) }}
                        </h3>
                        <div class="flex flex-wrap gap-2 items-center">
                            <span class="badge badge-primary">{{ $selectedOffer->location }}</span>
                            <span class="badge badge-teal">{{ $selectedOffer->salary_range }}</span>
                            <span class="badge badge-emerald capitalize">{{ $selectedOffer->status }}</span>
                        </div>
                    </div>

                    <div class="prose prose-sm dark:prose-invert max-w-none text-muted-foreground">
                        <p class="whitespace-pre-line leading-relaxed">{{ $selectedOffer->getTranslation('description', app()->getLocale()) }}</p>
                    </div>
                </div>

                <div class="px-6 py-5 border-t border-border flex justify-end gap-3 bg-surface">
                    <button wire:click="closeOffer" class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-colors border border-border hover:bg-muted" style="color:var(--color-foreground);">
                        Cerrar
                    </button>
                    <!-- Redirect to login since this is public facing right now -->
                    <a href="/login" class="btn-primary">
                        Aplicar a esta vacante
                        <svg class="ml-1 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
