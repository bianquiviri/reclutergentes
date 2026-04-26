<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Secure-Talent</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased flex items-center justify-center min-h-screen p-4"
      style="background:var(--color-background);">

    {{-- Ambient background blobs --}}
    <div class="fixed inset-0 overflow-hidden pointer-events-none" aria-hidden="true">
        <div class="absolute -top-40 -left-40 w-96 h-96 rounded-full blur-3xl opacity-30"
             style="background:oklch(0.55 0.24 270);"></div>
        <div class="absolute -bottom-40 -right-20 w-80 h-80 rounded-full blur-3xl opacity-20"
             style="background:oklch(0.68 0.22 200);"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full blur-3xl opacity-5"
             style="background:oklch(0.55 0.24 270);"></div>
    </div>

    <div class="relative w-full max-w-md animate-fade-up">

        {{-- Logo --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl shadow-2xl mb-4"
                 style="background:linear-gradient(135deg,oklch(0.55 0.24 270),oklch(0.62 0.20 200));">
                <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <h1 class="text-3xl font-black tracking-tight">
                <span class="gradient-brand-text">Secure</span><span style="color:var(--color-foreground);">Talent</span>
            </h1>
            <p class="text-sm mt-2" style="color:var(--color-muted-foreground);">
                Inicia sesión en tu espacio de reclutamiento
            </p>
        </div>

        {{-- Card --}}
        <div class="glass-card rounded-2xl p-8 shadow-2xl">

            {{-- Errors --}}
            @if($errors->any())
                <div class="mb-6 px-4 py-3 rounded-xl text-sm font-medium"
                     style="background:oklch(0.58 0.24 25 / 0.15);color:oklch(0.68 0.22 25);border:1px solid oklch(0.58 0.24 25 / 0.30);">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="/login" method="POST" class="space-y-5" id="login-form">
                @csrf

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider mb-2"
                           style="color:var(--color-muted-foreground);">
                        Correo electrónico
                    </label>
                    <input type="email" name="email" id="email" required
                           value="{{ old('email') }}"
                           class="input-field"
                           placeholder="nombre@empresa.com">
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-xs font-semibold uppercase tracking-wider"
                               style="color:var(--color-muted-foreground);">
                            Contraseña
                        </label>
                        <a href="#" class="text-xs font-medium transition-colors hover:underline"
                           style="color:oklch(0.72 0.22 270);">¿Olvidaste?</a>
                    </div>
                    <input type="password" name="password" id="password" required
                           class="input-field"
                           placeholder="••••••••">
                </div>

                <div class="flex items-center gap-3 pt-1">
                    <input type="checkbox" name="remember" id="remember"
                           class="w-4 h-4 rounded accent-violet-500">
                    <label for="remember" class="text-sm" style="color:var(--color-muted-foreground);">
                        Mantener sesión iniciada
                    </label>
                </div>

                <button type="submit" id="login-btn" class="btn-primary w-full py-3 text-sm mt-2">
                    Iniciar sesión
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </button>
            </form>

            {{-- Divider --}}
            <div class="my-6 flex items-center gap-3">
                <div class="flex-1 h-px" style="background:var(--color-border);"></div>
                <span class="text-xs" style="color:var(--color-muted-foreground);">o continúa con</span>
                <div class="flex-1 h-px" style="background:var(--color-border);"></div>
            </div>

            {{-- Social --}}
            <div class="grid grid-cols-2 gap-3">
                <button class="flex items-center justify-center gap-2 py-2.5 rounded-xl text-sm font-medium transition-all hover:scale-[1.02]"
                        style="background:var(--color-input);border:1px solid var(--color-border);color:var(--color-foreground);">
                    <svg class="h-4 w-4" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    Google
                </button>
                <button class="flex items-center justify-center gap-2 py-2.5 rounded-xl text-sm font-medium transition-all hover:scale-[1.02]"
                        style="background:var(--color-input);border:1px solid var(--color-border);color:var(--color-foreground);">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.32 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.79M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"/>
                    </svg>
                    LinkedIn
                </button>
            </div>
        </div>

        <p class="text-center text-sm mt-6" style="color:var(--color-muted-foreground);">
            ¿No tienes cuenta?
            <a href="/register" class="font-semibold hover:underline transition-colors"
               style="color:oklch(0.72 0.22 270);">Regístrate gratis</a>
        </p>
    </div>

</body>
</html>
