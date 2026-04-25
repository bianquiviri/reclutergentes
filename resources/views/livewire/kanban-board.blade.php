<div class="flex h-full w-full space-x-4 overflow-x-auto pb-4 px-4" 
     x-data="{ dragging: false }">
    
    @foreach($statuses as $status)
        <div class="flex w-80 flex-col flex-shrink-0 rounded-lg bg-secondary/20 border border-border">
            <div class="flex items-center justify-between p-4">
                <h3 class="text-xs font-semibold uppercase tracking-tight text-muted-foreground">
                    {{ __("messages.status.$status") }}
                </h3>
                <span class="rounded-full bg-background px-2 py-1 text-[10px] font-medium border border-border shadow-sm">
                    {{ $applications->get($status)?->count() ?? 0 }}
                </span>
            </div>

            <div class="flex-1 space-y-3 p-3 min-h-[500px]"
                 x-init="Sortable.create($el, {
                    group: 'candidates',
                    animation: 150,
                    ghostClass: 'opacity-50',
                    onEnd: (evt) => {
                        $wire.updateApplicationStatus(evt.item.getAttribute('data-id'), '{{ $status }}')
                    }
                 })">
                
                @foreach($applications->get($status, []) as $app)
                    <div data-id="{{ $app->id }}" 
                         class="group relative rounded-xl border border-border bg-card p-4 shadow-sm transition-all hover:shadow-md cursor-grab active:cursor-grabbing">
                        
                        <div class="flex flex-col space-y-2">
                            <span class="text-sm font-medium leading-none">{{ $app->candidateProfile->full_name }}</span>
                            <div class="flex items-center text-xs text-muted-foreground">
                                <svg class="mr-1 h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                {{ $app->candidateProfile->english_level ?? 'N/A' }}
                            </div>
                        </div>

                        @if($app->test_score)
                            <div class="mt-3 flex items-center justify-between">
                                <span class="text-[10px] font-bold text-primary bg-primary/10 px-2 py-0.5 rounded">
                                    SCORE: {{ $app->test_score }}%
                                </span>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
