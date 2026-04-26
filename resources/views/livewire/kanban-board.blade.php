<div class="flex flex-col h-full w-full" x-data="{ dragging: false }">
    
    <!-- Header Controls -->
    <div class="px-4 py-4 border-b border-border mb-6 bg-card flex items-center justify-between">
        <h2 class="text-lg font-bold text-foreground">Pipeline de Candidatos</h2>
        
        <div class="flex items-center gap-3">
            <label class="text-sm font-semibold text-muted-foreground uppercase tracking-wider">Filtrar por Oferta:</label>
            <select wire:model.live="jobOfferId" class="input-field py-2 pr-8 text-sm min-w-[300px]">
                @foreach($jobOffers as $offer)
                    <option value="{{ $offer->id }}">{{ $offer->getTranslation('title', app()->getLocale()) }} ({{ $offer->location }})</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Kanban Columns -->
    <div class="flex flex-1 space-x-6 overflow-x-auto pb-6 px-4">
    
    @foreach($statuses as $status)
        <div class="flex w-80 flex-col flex-shrink-0 rounded-2xl bg-muted/40 border border-border/50">
            <!-- Column Header -->
            <div class="flex items-center justify-between p-5">
                <div class="flex items-center space-x-2">
                    <div class="h-2 w-2 rounded-full {{ $status === 'hired' ? 'bg-green-500' : ($status === 'rejected' ? 'bg-red-500' : 'bg-primary') }}"></div>
                    <h3 class="text-sm font-black uppercase tracking-widest text-foreground/80">
                        {{ __("messages.status.$status") }}
                    </h3>
                </div>
                <span class="rounded-lg bg-card px-2.5 py-1 text-[11px] font-black text-muted-foreground border border-border shadow-sm">
                    {{ $applications->get($status)?->count() ?? 0 }}
                </span>
            </div>

            <!-- Draggable Area -->
            <div class="flex-1 space-y-4 p-4 min-h-[600px] overflow-y-auto"
                 x-init="Sortable.create($el, {
                    group: 'candidates',
                    animation: 250,
                    ghostClass: 'sortable-ghost',
                    dragClass: 'sortable-drag',
                    onEnd: (evt) => {
                        $wire.updateApplicationStatus(evt.item.getAttribute('data-id'), '{{ $status }}')
                    }
                 })">
                
                @foreach($applications->get($status, []) as $app)
                    <div data-id="{{ $app->id }}" wire:click="showApplication({{ $app->id }})"
                         class="group relative rounded-2xl border border-border bg-card p-5 shadow-sm transition-all hover:shadow-xl hover:-translate-y-1 cursor-pointer">
                        
                        <div class="flex flex-col space-y-3">
                            <div class="flex justify-between items-start">
                                <span class="text-base font-bold text-foreground leading-tight tracking-tight">
                                    {{ $app->candidateProfile->name }}
                                </span>
                                <div class="h-8 w-8 rounded-lg bg-muted flex items-center justify-center text-[10px] font-black text-muted-foreground group-hover:bg-primary/10 group-hover:text-primary transition-colors">
                                    {{ substr($app->candidateProfile->name, 0, 1) }}
                                </div>
                            </div>

                            <div class="flex items-center space-x-4 text-[11px] font-medium text-muted-foreground">
                                <span class="flex items-center">
                                    <svg class="mr-1 h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    {{ $app->candidateProfile->english_level ?? 'B2' }}
                                </span>
                                <span class="flex items-center">
                                    <svg class="mr-1 h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    {{ $app->created_at->diffForHumans(null, true) }}
                                </span>
                            </div>

                            @if($app->test_score)
                                <div class="pt-2">
                                    <div class="flex justify-between items-center mb-1.5">
                                        <span class="text-[10px] font-black uppercase tracking-tighter text-muted-foreground">Skill Test</span>
                                        <span class="text-[10px] font-black text-primary">{{ $app->test_score }}%</span>
                                    </div>
                                    <div class="w-full bg-muted rounded-full h-1.5 overflow-hidden">
                                        <div class="bg-primary h-1.5 rounded-full transition-all duration-500" style="width: {{ $app->test_score }}%"></div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        </div>
    @endforeach
    </div>

    <!-- Candidate Detail Modal -->
    @if($selectedApplication)
        <div class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6">
            <div class="fixed inset-0 bg-background/80 backdrop-blur-sm transition-opacity" wire:click="closeApplication"></div>

            <div class="relative bg-card border border-border rounded-3xl shadow-2xl w-full max-w-3xl max-h-[90vh] flex flex-col animate-fade-up">
                
                <div class="px-6 py-5 border-b border-border flex justify-between items-center bg-surface shrink-0">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-xl font-black shadow-inner" style="background:linear-gradient(135deg,oklch(0.55 0.24 270 / 0.2),oklch(0.68 0.22 200 / 0.2));color:var(--color-primary);">
                            {{ substr($selectedApplication->candidateProfile->name, 0, 1) }}
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-foreground leading-tight">{{ $selectedApplication->candidateProfile->name }}</h2>
                            <p class="text-sm text-muted-foreground">{{ $selectedApplication->candidateProfile->email }}</p>
                        </div>
                    </div>
                    <button wire:click="closeApplication" class="text-muted-foreground hover:text-foreground transition-colors p-2 rounded-full hover:bg-muted">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="p-6 overflow-y-auto flex-1 space-y-8">
                    
                    <!-- Basic Info -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-muted/30 p-3 rounded-xl border border-border/50">
                            <span class="text-[10px] uppercase font-bold text-muted-foreground tracking-wider block mb-1">Status</span>
                            <span class="text-sm font-semibold capitalize text-primary">{{ $selectedApplication->status }}</span>
                        </div>
                        <div class="bg-muted/30 p-3 rounded-xl border border-border/50">
                            <span class="text-[10px] uppercase font-bold text-muted-foreground tracking-wider block mb-1">Teléfono</span>
                            <span class="text-sm font-semibold text-foreground">{{ $selectedApplication->candidateProfile->phone ?? 'N/A' }}</span>
                        </div>
                        <div class="bg-muted/30 p-3 rounded-xl border border-border/50">
                            <span class="text-[10px] uppercase font-bold text-muted-foreground tracking-wider block mb-1">Nivel Inglés</span>
                            <span class="text-sm font-semibold text-foreground">{{ $selectedApplication->candidateProfile->english_level ?? 'N/A' }}</span>
                        </div>
                        <div class="bg-muted/30 p-3 rounded-xl border border-border/50">
                            <span class="text-[10px] uppercase font-bold text-muted-foreground tracking-wider block mb-1">Test Score</span>
                            <span class="text-sm font-semibold text-foreground">{{ $selectedApplication->test_score ? $selectedApplication->test_score . '%' : 'Pendiente' }}</span>
                        </div>
                    </div>

                    <!-- Parsed CV Content -->
                    @if($selectedApplication->candidateProfile->parsed_content)
                        <div>
                            <h3 class="text-sm font-bold uppercase tracking-widest text-muted-foreground mb-4">Información Extraída (IA)</h3>
                            
                            @if(isset($selectedApplication->candidateProfile->parsed_content['skills']) && is_array($selectedApplication->candidateProfile->parsed_content['skills']))
                            <div class="mb-4">
                                <span class="text-xs font-semibold text-foreground block mb-2">Habilidades Principales:</span>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($selectedApplication->candidateProfile->parsed_content['skills'] as $skill)
                                        <span class="px-2.5 py-1 rounded-md bg-primary/10 border border-primary/20 text-xs font-semibold text-primary">{{ $skill }}</span>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            @if(isset($selectedApplication->candidateProfile->parsed_content['raw_extracted_text']))
                            <div>
                                <span class="text-xs font-semibold text-foreground block mb-2">Extracto Original:</span>
                                <div class="bg-muted/30 p-4 rounded-xl border border-border text-xs text-muted-foreground whitespace-pre-line max-h-40 overflow-y-auto">
                                    {{ $selectedApplication->candidateProfile->parsed_content['raw_extracted_text'] }}
                                </div>
                            </div>
                            @endif
                        </div>
                    @else
                        <div class="text-center py-8 bg-muted/20 rounded-2xl border border-dashed border-border">
                            <p class="text-sm text-muted-foreground">No hay contenido de CV parseado para este candidato.</p>
                        </div>
                    @endif

                </div>

                <div class="px-6 py-4 border-t border-border flex justify-end shrink-0 bg-surface">
                    <button class="btn-primary flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Contactar
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
