<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Secure-Talent | Elite Recruitment ATS</title>
    <meta name="description" content="Plataforma ATS de reclutamiento de élite con IA, pipeline Kanban y análisis en tiempo real.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased" style="background:var(--color-background);color:var(--color-foreground);">

    {{-- Ambient blobs --}}
    <div class="fixed inset-0 overflow-hidden pointer-events-none" aria-hidden="true">
        <div class="absolute -top-60 -right-60 w-[700px] h-[700px] rounded-full blur-3xl opacity-10"
             style="background:oklch(0.55 0.24 270);"></div>
        <div class="absolute top-1/2 -left-60 w-[500px] h-[500px] rounded-full blur-3xl opacity-8"
             style="background:oklch(0.68 0.22 200);"></div>
    </div>

    {{-- ── NAV ─────────────────────────────────────────────── --}}
    <nav class="relative sticky top-0 z-50"
         style="background:oklch(0.11 0.01 260 / 0.85);backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);border-bottom:1px solid var(--color-border);">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl flex items-center justify-center"
                         style="background:linear-gradient(135deg,oklch(0.55 0.24 270),oklch(0.62 0.20 200));">
                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                  d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01"/>
                        </svg>
                    </div>
                    <span class="text-lg font-bold tracking-tight">
                        <span class="gradient-brand-text">Secure</span><span style="color:var(--color-foreground);">Talent</span>
                    </span>
                </div>

                <div class="flex items-center gap-5">
                    @livewire('locale-switcher')
                    <a href="/login"
                       class="text-sm font-medium transition-colors hover:underline"
                       style="color:var(--color-muted-foreground);">
                        Iniciar sesión
                    </a>
                    <a href="/register" class="btn-primary py-2 px-4 text-xs">
                        Empezar gratis →
                    </a>
                </div>
            </div>
        </div>
    </nav>

    {{-- ── HERO ─────────────────────────────────────────────── --}}
    <section class="relative max-w-7xl mx-auto px-6 lg:px-8 pt-24 pb-20 text-center">
        <div class="animate-fade-up">
            <span class="badge badge-primary text-xs mb-6 inline-flex">
                ✦ Plataforma ATS con IA integrada
            </span>
            <h1 class="text-5xl lg:text-7xl font-extrabold tracking-tight leading-tight">
                Recluta al mejor talento<br>
                <span class="gradient-brand-text">sin esfuerzo</span>
            </h1>
            <p class="mt-6 text-lg max-w-2xl mx-auto" style="color:var(--color-muted-foreground);">
                Pipeline Kanban, análisis de CVs con IA, notificaciones en tiempo real y
                cifrado de datos de nivel empresarial. Todo en un solo lugar.
            </p>
            <div class="mt-10 flex items-center justify-center gap-4 flex-wrap">
                <a href="/login" class="btn-primary py-3 px-8 text-base">
                    Ver el dashboard
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
                <a href="#features"
                   class="py-3 px-8 text-base rounded-xl font-semibold transition-all hover:scale-[1.02]"
                   style="background:var(--color-card);border:1px solid var(--color-border);color:var(--color-foreground);">
                    Ver funciones
                </a>
            </div>
        </div>

        {{-- Stats strip --}}
        <div class="mt-20 grid grid-cols-3 gap-6 max-w-lg mx-auto">
            @foreach([['303','Ofertas activas'],['2','Usuarios en demo'],['100%','Open Source']] as [$n,$l])
            <div class="text-center">
                <p class="text-3xl font-extrabold gradient-brand-text">{{ $n }}</p>
                <p class="text-xs mt-1" style="color:var(--color-muted-foreground);">{{ $l }}</p>
            </div>
            @endforeach
        </div>
    </section>

    {{-- ── JOB BOARD ────────────────────────────────────────── --}}
    <section id="jobs" class="relative">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 pb-4">
            <div class="flex items-center gap-3 mb-2">
                <div class="flex-1 h-px" style="background:var(--color-border);"></div>
                <span class="text-xs font-semibold uppercase tracking-widest"
                      style="color:var(--color-muted-foreground);">Ofertas publicadas</span>
                <div class="flex-1 h-px" style="background:var(--color-border);"></div>
            </div>
        </div>
        @livewire('job-board')
    </section>

    {{-- ── FOOTER ───────────────────────────────────────────── --}}
    <footer class="relative mt-20" style="border-top:1px solid var(--color-border);">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-10 flex flex-col md:flex-row items-center justify-between gap-4">
            <span class="text-sm font-bold">
                <span class="gradient-brand-text">Secure</span><span style="color:var(--color-foreground);">Talent</span>
            </span>
            <p class="text-xs" style="color:var(--color-muted-foreground);">
                © {{ date('Y') }} Secure-Talent ATS. Construido para agencias de reclutamiento de élite.
            </p>
            <div class="flex items-center gap-1">
                <span class="w-2 h-2 rounded-full animate-pulse"
                      style="background:oklch(0.65 0.20 145);"></span>
                <span class="text-xs" style="color:var(--color-muted-foreground);">Todos los sistemas operativos</span>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
