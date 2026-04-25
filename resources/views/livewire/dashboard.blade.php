<div class="space-y-8">
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-card border border-border p-6 rounded-2xl shadow-sm">
            <p class="text-sm font-medium text-muted-foreground">{{ __('Total Candidates') }}</p>
            <div class="flex items-baseline mt-2">
                <span class="text-3xl font-bold text-foreground">{{ $totalCandidates }}</span>
                <span class="ml-2 text-sm font-medium text-green-500">+12%</span>
            </div>
        </div>
        <div class="bg-card border border-border p-6 rounded-2xl shadow-sm">
            <p class="text-sm font-medium text-muted-foreground">{{ __('Active Offers') }}</p>
            <div class="flex items-baseline mt-2">
                <span class="text-3xl font-bold text-foreground">{{ $activeOffers }}</span>
                <span class="ml-2 text-sm font-medium text-muted-foreground">Stable</span>
            </div>
        </div>
        <div class="bg-card border border-border p-6 rounded-2xl shadow-sm">
            <p class="text-sm font-medium text-muted-foreground">{{ __('Applications') }}</p>
            <div class="flex items-baseline mt-2">
                <span class="text-3xl font-bold text-foreground">{{ $totalApplications }}</span>
                <span class="ml-2 text-sm font-medium text-green-500">+5%</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Pipeline Health Chart Placeholder -->
        <div class="bg-card border border-border p-8 rounded-2xl shadow-sm min-h-[300px] flex flex-col justify-center items-center">
            <div class="text-center">
                <svg class="mx-auto h-12 w-12 text-muted-foreground/30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-foreground">Pipeline Health</h3>
                <p class="mt-1 text-sm text-muted-foreground">Visual analytics coming soon.</p>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-card border border-border rounded-2xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-border">
                <h3 class="text-lg font-bold text-foreground">{{ __('Recent Activity') }}</h3>
            </div>
            <div class="divide-y divide-border">
                @foreach($recentApplications as $app)
                    <div class="p-6 hover:bg-accent transition-colors flex items-center space-x-4">
                        <div class="h-10 w-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold">
                            {{ substr($app->candidateProfile->name, 0, 1) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-foreground truncate">
                                {{ $app->candidateProfile->name }} applied for 
                                <span class="text-primary">{{ $app->jobOffer->getTranslation('title', app()->getLocale()) }}</span>
                            </p>
                            <p class="text-xs text-muted-foreground">{{ $app->created_at->diffForHumans() }}</p>
                        </div>
                        <span class="px-2 py-1 bg-muted text-[10px] uppercase font-bold rounded">
                            {{ $app->status }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
