<div class="flex h-full w-full space-x-6 overflow-x-auto pb-6 px-4" 
     x-data="{ dragging: false }">
    
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
                    <div data-id="{{ $app->id }}" 
                         class="group relative rounded-2xl border border-border bg-card p-5 shadow-sm transition-all hover:shadow-xl hover:-translate-y-1 cursor-grab active:cursor-grabbing">
                        
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
    @endforeach
</div>
