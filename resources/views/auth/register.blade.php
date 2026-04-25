<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register | Secure-Talent</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-background flex items-center justify-center min-h-screen p-4">
    <div class="w-full max-w-md py-12">
        <div class="text-center mb-8">
            <span class="text-3xl font-black tracking-tighter text-primary">SECURE<span class="text-foreground">TALENT</span></span>
            <p class="text-muted-foreground mt-2">Create your professional profile</p>
        </div>

        <div class="bg-card border border-border rounded-2xl shadow-xl p-8">
            <form action="/register" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-foreground mb-1">Full Name</label>
                    <input type="text" name="name" required 
                        class="block w-full px-4 py-3 border border-border rounded-xl bg-background text-sm focus:ring-2 focus:ring-primary focus:border-primary transition-all"
                        placeholder="Elena Rodriguez">
                </div>

                <div>
                    <label class="block text-sm font-medium text-foreground mb-1">Email Address</label>
                    <input type="email" name="email" required 
                        class="block w-full px-4 py-3 border border-border rounded-xl bg-background text-sm focus:ring-2 focus:ring-primary focus:border-primary transition-all"
                        placeholder="elena@example.com">
                </div>

                <div>
                    <label class="block text-sm font-medium text-foreground mb-1">Password</label>
                    <input type="password" name="password" required 
                        class="block w-full px-4 py-3 border border-border rounded-xl bg-background text-sm focus:ring-2 focus:ring-primary focus:border-primary transition-all"
                        placeholder="••••••••">
                </div>

                <div>
                    <label class="block text-sm font-medium text-foreground mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation" required 
                        class="block w-full px-4 py-3 border border-border rounded-xl bg-background text-sm focus:ring-2 focus:ring-primary focus:border-primary transition-all"
                        placeholder="••••••••">
                </div>

                <div class="flex items-start py-2">
                    <input type="checkbox" class="mt-1 form-checkbox text-primary rounded border-border" required>
                    <label class="ml-2 text-xs text-muted-foreground">
                        I agree to the <a href="#" class="text-primary hover:underline">Terms of Service</a> and <a href="#" class="text-primary hover:underline">Privacy Policy</a>.
                    </label>
                </div>

                <button type="submit" class="w-full py-3 bg-primary text-primary-foreground rounded-xl font-bold hover:opacity-90 transition-all shadow-md mt-4">
                    Create Account
                </button>
            </form>
        </div>

        <p class="text-center text-sm text-muted-foreground mt-8">
            Already have an account? <a href="/login" class="text-primary font-semibold hover:underline">Sign In</a>
        </p>
    </div>
</body>
</html>
