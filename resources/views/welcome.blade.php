<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Secure-Talent | Elite Recruitment ATS</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased bg-background text-foreground">
    <nav class="bg-card border-b border-border sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <span class="text-2xl font-black tracking-tighter text-primary">SECURE<span class="text-foreground">TALENT</span></span>
                </div>
                <div class="flex items-center space-x-6">
                    @livewire('locale-switcher')
                    <a href="/login" class="text-sm font-medium text-muted-foreground hover:text-foreground transition-colors">Sign In</a>
                    <a href="/register" class="px-4 py-2 bg-primary text-primary-foreground rounded-lg text-sm font-semibold hover:opacity-90 transition-all shadow-sm">Get Started</a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @livewire('job-board')
    </main>

    <footer class="bg-card border-t border-border py-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-muted-foreground text-sm">© 2024 Secure-Talent ATS. Built for Elite Recruitment Agencies.</p>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
