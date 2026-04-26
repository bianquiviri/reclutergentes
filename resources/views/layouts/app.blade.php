<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Secure-Talent') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    @livewireStyles
</head>
<body class="font-sans antialiased" style="background:var(--color-background);color:var(--color-foreground);">

<div class="min-h-screen flex">

    {{-- ══════════════ SIDEBAR ══════════════ --}}
    <aside class="w-64 flex-shrink-0 flex flex-col relative overflow-hidden"
           style="background:var(--color-surface);border-right:1px solid var(--color-border);">

        {{-- Ambient glow --}}
        <div class="absolute inset-0 pointer-events-none"
             style="background:radial-gradient(ellipse at 30% 10%, oklch(0.55 0.24 270 / 0.15) 0%, transparent 60%);"></div>

        {{-- Logo --}}
        <div class="relative px-6 py-6 flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center shadow-lg"
                 style="background:linear-gradient(135deg,oklch(0.55 0.24 270),oklch(0.62 0.20 200));">
                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01"/>
                </svg>
            </div>
            <div>
                <h1 class="text-base font-bold tracking-tight" style="color:var(--color-foreground);">
                    <span class="gradient-brand-text">Secure</span>Talent
                </h1>
                <p class="text-[10px]" style="color:var(--color-muted-foreground);">Elite ATS</p>
            </div>
        </div>

        {{-- Nav --}}
        <nav class="relative flex-1 px-3 space-y-1 pb-4">
            <p class="px-3 pt-2 pb-1 text-[10px] uppercase tracking-widest font-semibold"
               style="color:var(--color-muted-foreground);">Main</p>

            <a href="/dashboard" id="nav-dashboard"
               class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <svg class="w-4.5 h-4.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                </svg>
                {{ __('messages.dashboard') }}
            </a>

            <a href="#" id="nav-candidates" class="nav-item">
                <svg class="w-4.5 h-4.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                {{ __('messages.candidates') }}
            </a>

            <a href="#" id="nav-jobs" class="nav-item">
                <svg class="w-4.5 h-4.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                {{ __('messages.job_offers') }}
            </a>

            <p class="px-3 pt-4 pb-1 text-[10px] uppercase tracking-widest font-semibold"
               style="color:var(--color-muted-foreground);">Pipeline</p>

            <a href="#" id="nav-kanban" class="nav-item">
                <svg class="w-4.5 h-4.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/>
                </svg>
                Kanban Board
            </a>
        </nav>

        {{-- User footer --}}
        <div class="relative px-4 py-4" style="border-top:1px solid var(--color-border);">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold shadow animate-pulse-glow"
                     style="background:linear-gradient(135deg,oklch(0.55 0.24 270),oklch(0.62 0.20 200));color:white;">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-semibold truncate" style="color:var(--color-foreground);">
                        {{ auth()->user()->name ?? 'Admin' }}
                    </p>
                    <p class="text-[10px] truncate" style="color:var(--color-muted-foreground);">
                        {{ auth()->user()->role ?? 'admin' }}
                    </p>
                </div>
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" title="Logout"
                            class="p-1.5 rounded-lg transition-colors hover:bg-red-500/10"
                            style="color:var(--color-muted-foreground);">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    {{-- ══════════════ MAIN ══════════════ --}}
    <div class="flex-1 flex flex-col min-w-0">

        {{-- Topbar --}}
        <header class="h-16 flex items-center justify-between px-8 flex-shrink-0"
                style="background:var(--color-surface);border-bottom:1px solid var(--color-border);">
            <div class="relative w-80">
                <span class="absolute inset-y-0 left-3 flex items-center pointer-events-none"
                      style="color:var(--color-muted-foreground);">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </span>
                <input type="text" id="global-search"
                       placeholder="{{ __('messages.search') }}"
                       class="input-field pl-9 py-2 text-xs">
            </div>

            <div class="flex items-center gap-4">
                @livewire('locale-switcher')

                {{-- Notification bell --}}
                <button class="relative p-2 rounded-xl transition-colors hover:bg-white/5"
                        style="color:var(--color-muted-foreground);">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <span class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full"
                          style="background:oklch(0.55 0.24 270);"></span>
                </button>
            </div>
        </header>

        {{-- Content --}}
        <main class="flex-1 overflow-y-auto p-8">
            {{ $slot }}
        </main>
    </div>
</div>

@livewireScripts
</body>
</html>
