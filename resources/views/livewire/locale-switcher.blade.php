<div class="relative inline-block text-left">
    <div class="flex items-center space-x-2">
        <button wire:click="switchLocale('es')" class="text-xs font-medium px-2 py-1 rounded-md {{ $currentLocale === 'es' ? 'bg-primary text-primary-foreground' : 'text-muted-foreground hover:bg-accent' }} transition-colors">
            ES
        </button>
        <div class="h-4 w-[1px] bg-border"></div>
        <button wire:click="switchLocale('en')" class="text-xs font-medium px-2 py-1 rounded-md {{ $currentLocale === 'en' ? 'bg-primary text-primary-foreground' : 'text-muted-foreground hover:bg-accent' }} transition-colors">
            EN
        </button>
    </div>
</div>
