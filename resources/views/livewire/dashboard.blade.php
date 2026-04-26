<div class="space-y-8 animate-fade-up">

    {{-- ── Page header ──────────────────────────────────────── --}}
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold" style="color:var(--color-foreground);">
                Bienvenido de nuevo 👋
            </h2>
            <p class="text-sm mt-1" style="color:var(--color-muted-foreground);">
                Aquí está el resumen de tu pipeline de reclutamiento.
            </p>
        </div>
        <button class="btn-primary" id="new-offer-btn">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Nueva Oferta
        </button>
    </div>

    {{-- ── KPI Cards ────────────────────────────────────────── --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- Candidates --}}
        <div class="glass-card stat-card-primary rounded-2xl p-6 group hover:scale-[1.02] transition-all duration-300"
             id="stat-candidates">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-widest"
                       style="color:var(--color-muted-foreground);">{{ __('Total Candidates') }}</p>
                    <p class="text-4xl font-extrabold mt-2" style="color:var(--color-foreground);">
                        {{ $totalCandidates }}
                    </p>
                    <div class="flex items-center gap-1.5 mt-2">
                        <span class="badge badge-emerald">↑ +12%</span>
                        <span class="text-xs" style="color:var(--color-muted-foreground);">vs mes anterior</span>
                    </div>
                </div>
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center shrink-0"
                     style="background:oklch(0.55 0.24 270 / 0.15);">
                    <svg class="w-6 h-6" style="color:oklch(0.72 0.22 270);" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/>
                    </svg>
                </div>
            </div>
            {{-- mini progress bar --}}
            <div class="mt-4 h-1 rounded-full" style="background:var(--color-border);">
                <div class="h-1 rounded-full"
                     style="width:72%;background:linear-gradient(90deg,oklch(0.55 0.24 270),oklch(0.68 0.22 200));"></div>
            </div>
        </div>

        {{-- Active Offers --}}
        <div class="glass-card stat-card-teal rounded-2xl p-6 group hover:scale-[1.02] transition-all duration-300"
             id="stat-offers">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-widest"
                       style="color:var(--color-muted-foreground);">{{ __('Active Offers') }}</p>
                    <p class="text-4xl font-extrabold mt-2" style="color:var(--color-foreground);">
                        {{ $activeOffers }}
                    </p>
                    <div class="flex items-center gap-1.5 mt-2">
                        <span class="badge badge-teal">● Estable</span>
                    </div>
                </div>
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center shrink-0"
                     style="background:oklch(0.68 0.22 200 / 0.15);">
                    <svg class="w-6 h-6" style="color:oklch(0.68 0.22 200);" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 h-1 rounded-full" style="background:var(--color-border);">
                <div class="h-1 rounded-full"
                     style="width:55%;background:oklch(0.68 0.22 200);"></div>
            </div>
        </div>

        {{-- Applications --}}
        <div class="glass-card stat-card-emerald rounded-2xl p-6 group hover:scale-[1.02] transition-all duration-300"
             id="stat-applications">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-widest"
                       style="color:var(--color-muted-foreground);">{{ __('Applications') }}</p>
                    <p class="text-4xl font-extrabold mt-2" style="color:var(--color-foreground);">
                        {{ $totalApplications }}
                    </p>
                    <div class="flex items-center gap-1.5 mt-2">
                        <span class="badge badge-emerald">↑ +5%</span>
                        <span class="text-xs" style="color:var(--color-muted-foreground);">esta semana</span>
                    </div>
                </div>
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center shrink-0"
                     style="background:oklch(0.65 0.20 145 / 0.15);">
                    <svg class="w-6 h-6" style="color:oklch(0.65 0.20 145);" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 h-1 rounded-full" style="background:var(--color-border);">
                <div class="h-1 rounded-full"
                     style="width:38%;background:oklch(0.65 0.20 145);"></div>
            </div>
        </div>
    </div>

    {{-- ── Bottom row ───────────────────────────────────────── --}}
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">

        {{-- Pipeline Visual ─ 3 cols --}}
        <div class="lg:col-span-3 glass-card rounded-2xl p-8 flex flex-col" id="pipeline-chart">
            <div class="flex items-center justify-between mb-6">
                <h3 class="font-bold text-base" style="color:var(--color-foreground);">
                    Pipeline Health
                </h3>
                <span class="badge badge-primary">En vivo</span>
            </div>

            {{-- Funnel bars --}}
            <div class="space-y-4 flex-1">
                @php
                    $stages = [
                        ['label'=>'Applied',      'pct'=>100, 'color'=>'oklch(0.55 0.24 270)', 'badge'=>'badge-primary'],
                        ['label'=>'Screening',    'pct'=>68,  'color'=>'oklch(0.62 0.22 240)', 'badge'=>'badge-primary'],
                        ['label'=>'Interview',    'pct'=>42,  'color'=>'oklch(0.68 0.22 200)', 'badge'=>'badge-teal'],
                        ['label'=>'Assessment',   'pct'=>24,  'color'=>'oklch(0.65 0.20 145)', 'badge'=>'badge-emerald'],
                        ['label'=>'Offer',        'pct'=>11,  'color'=>'oklch(0.72 0.18  75)', 'badge'=>'badge-amber'],
                    ];
                @endphp
                @foreach($stages as $stage)
                    <div class="flex items-center gap-4">
                        <span class="text-xs w-24 shrink-0" style="color:var(--color-muted-foreground);">
                            {{ $stage['label'] }}
                        </span>
                        <div class="flex-1 h-2 rounded-full" style="background:var(--color-border);">
                            <div class="h-2 rounded-full transition-all duration-700"
                                 style="width:{{ $stage['pct'] }}%;background:{{ $stage['color'] }};"></div>
                        </div>
                        <span class="text-xs font-bold w-8 text-right" style="color:var(--color-foreground);">
                            {{ $stage['pct'] }}%
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Recent Activity ─ 2 cols --}}
        <div class="lg:col-span-2 glass-card rounded-2xl overflow-hidden" id="recent-activity">
            <div class="px-6 py-5 flex items-center justify-between"
                 style="border-bottom:1px solid var(--color-border);">
                <h3 class="font-bold text-base" style="color:var(--color-foreground);">
                    {{ __('Recent Activity') }}
                </h3>
            </div>

            <div class="divide-y" style="--tw-divide-opacity:1;border-color:var(--color-border);">
                @forelse($recentApplications as $app)
                    <div class="px-6 py-4 flex items-center gap-3 hover:bg-white/[0.03] transition-colors">
                        <div class="w-9 h-9 rounded-full flex items-center justify-center text-xs font-bold shrink-0 shadow"
                             style="background:linear-gradient(135deg,oklch(0.55 0.24 270 / 0.25),oklch(0.68 0.22 200 / 0.25));color:oklch(0.72 0.22 270);">
                            {{ strtoupper(substr($app->candidateProfile->name ?? '?', 0, 1)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-medium truncate" style="color:var(--color-foreground);">
                                {{ $app->candidateProfile->name ?? 'Unknown' }}
                            </p>
                            <p class="text-[10px] truncate" style="color:var(--color-muted-foreground);">
                                {{ $app->jobOffer->getTranslation('title', app()->getLocale()) }}
                            </p>
                        </div>
                        <span class="badge badge-primary text-[9px] shrink-0">{{ $app->status }}</span>
                    </div>
                @empty
                    <div class="px-6 py-12 text-center">
                        <p class="text-sm" style="color:var(--color-muted-foreground);">Sin actividad reciente</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

</div>
