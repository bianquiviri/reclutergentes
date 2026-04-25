<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Secure-Talent</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-background flex items-center justify-center min-h-screen p-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <span class="text-3xl font-black tracking-tighter text-primary">SECURE<span class="text-foreground">TALENT</span></span>
            <p class="text-muted-foreground mt-2">Sign in to your account</p>
        </div>

        <div class="bg-card border border-border rounded-2xl shadow-xl p-8">
            <form action="/login" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-foreground mb-2">Email Address</label>
                    <input type="email" name="email" required 
                        class="block w-full px-4 py-3 border border-border rounded-xl bg-background text-sm focus:ring-2 focus:ring-primary focus:border-primary transition-all"
                        placeholder="name@company.com">
                </div>

                <div>
                    <div class="flex justify-between mb-2">
                        <label class="block text-sm font-medium text-foreground">Password</label>
                        <a href="#" class="text-sm text-primary hover:underline">Forgot?</a>
                    </div>
                    <input type="password" name="password" required 
                        class="block w-full px-4 py-3 border border-border rounded-xl bg-background text-sm focus:ring-2 focus:ring-primary focus:border-primary transition-all"
                        placeholder="••••••••">
                </div>

                <button type="submit" class="w-full py-3 bg-primary text-primary-foreground rounded-xl font-bold hover:opacity-90 transition-all shadow-md">
                    Sign In
                </button>
            </form>

            <div class="mt-8">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-border"></div>
                    </div>
                    <div class="relative flex justify-center text-xs uppercase">
                        <span class="bg-card px-2 text-muted-foreground">Or continue with</span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-4">
                    <button class="flex justify-center items-center py-2 border border-border rounded-xl hover:bg-muted transition-colors">
                        <svg class="h-5 w-5" viewBox="0 0 24 24"><path fill="currentColor" d="M12.545,10.239v3.821h5.445c-0.712,2.315-2.647,3.972-5.445,3.972c-3.332,0-6.033-2.701-6.033-6.032s2.701-6.032,6.033-6.032c1.498,0,2.866,0.549,3.921,1.453l2.814-2.814C17.503,2.988,15.139,2,12.545,2C7.021,2,2.543,6.477,2.543,12s4.478,10,10.002,10c8.396,0,10.249-7.85,9.426-11.748L12.545,10.239z"/></svg>
                    </button>
                    <button class="flex justify-center items-center py-2 border border-border rounded-xl hover:bg-muted transition-colors">
                        <svg class="h-5 w-5" viewBox="0 0 24 24"><path fill="currentColor" d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.32 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.79M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"/></svg>
                    </button>
                </div>
            </div>
        </div>

        <p class="text-center text-sm text-muted-foreground mt-8">
            Don't have an account? <a href="/register" class="text-primary font-semibold hover:underline">Sign up for free</a>
        </p>
    </div>
</body>
</html>
