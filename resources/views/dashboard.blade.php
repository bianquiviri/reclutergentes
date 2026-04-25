<x-app-layout>
    <div class="flex justify-between items-end mb-8">
        <div>
            <h1 class="text-3xl font-bold text-foreground">{{ __('Dashboard') }}</h1>
            <p class="text-muted-foreground mt-1">{{ __('Welcome back to your recruitment control center.') }}</p>
        </div>
        <div class="flex space-x-3">
            <button class="px-4 py-2 bg-card border border-border rounded-lg text-sm font-medium hover:bg-accent transition-colors">Export Data</button>
            <button class="px-4 py-2 bg-primary text-primary-foreground rounded-lg text-sm font-bold hover:opacity-90 transition-all shadow-sm">New Job Offer</button>
        </div>
    </div>

    @livewire('dashboard')
</x-app-layout>
