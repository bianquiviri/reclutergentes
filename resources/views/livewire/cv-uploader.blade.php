<div class="space-y-6">
    @if(!$parsedData)
        <!-- Upload State -->
        <div class="border-2 border-dashed border-border rounded-2xl p-8 text-center bg-card/50 transition-all hover:bg-card hover:border-primary/50 relative overflow-hidden group">
            
            <input type="file" wire:model="cv" accept=".pdf" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" {{ $isParsing ? 'disabled' : '' }}>
            
            <div class="flex flex-col items-center justify-center space-y-4">
                <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center text-primary group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                </div>
                
                <div>
                    <h3 class="text-lg font-bold text-foreground">Sube tu Currículum</h3>
                    <p class="text-sm text-muted-foreground mt-1">PDF, hasta 10MB. Nuestra IA extraerá tus datos al instante.</p>
                </div>

                @if($cv && !$isParsing)
                    <div class="bg-primary/10 text-primary px-4 py-2 rounded-xl text-sm font-semibold mt-4">
                        {{ $cv->getClientOriginalName() }}
                    </div>
                    <button wire:click.prevent="processCv" class="btn-primary mt-4 z-20 relative">
                        Analizar CV con IA
                    </button>
                @endif
                
                @if($isParsing)
                    <div class="mt-4 flex flex-col items-center">
                        <svg class="animate-spin h-6 w-6 text-primary mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span class="text-sm font-medium text-primary">La IA está extrayendo tus datos...</span>
                    </div>
                @endif
                
                @error('cv') <span class="text-red-500 text-xs mt-2">{{ $message }}</span> @enderror
            </div>
        </div>

    @else
        <!-- Confirm State -->
        <div class="bg-card border border-border rounded-2xl p-6 shadow-sm animate-fade-up">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-full bg-green-500/20 flex items-center justify-center text-green-500">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-foreground">Datos extraídos con éxito</h3>
                    <p class="text-xs text-muted-foreground">Por favor revisa tu información antes de aplicar.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                <div class="bg-muted/50 p-4 rounded-xl border border-border/50">
                    <span class="text-[10px] uppercase font-bold text-muted-foreground tracking-wider block mb-1">Nombre Completo</span>
                    <span class="text-sm font-semibold text-foreground">{{ $parsedData['name'] }}</span>
                </div>
                <div class="bg-muted/50 p-4 rounded-xl border border-border/50">
                    <span class="text-[10px] uppercase font-bold text-muted-foreground tracking-wider block mb-1">Correo Electrónico</span>
                    <span class="text-sm font-semibold text-foreground">{{ $parsedData['email'] }}</span>
                </div>
                <div class="bg-muted/50 p-4 rounded-xl border border-border/50">
                    <span class="text-[10px] uppercase font-bold text-muted-foreground tracking-wider block mb-1">Teléfono</span>
                    <span class="text-sm font-semibold text-foreground">{{ $parsedData['phone'] ?? 'No detectado' }}</span>
                </div>
                <div class="bg-muted/50 p-4 rounded-xl border border-border/50">
                    <span class="text-[10px] uppercase font-bold text-muted-foreground tracking-wider block mb-1">Nivel de Inglés Detectado</span>
                    <span class="text-sm font-semibold text-primary">{{ $parsedData['english_level'] ?? 'No detectado' }}</span>
                </div>
            </div>
            
            <div class="bg-muted/50 p-4 rounded-xl border border-border/50 mb-8">
                <span class="text-[10px] uppercase font-bold text-muted-foreground tracking-wider block mb-3">Habilidades Extraídas</span>
                <div class="flex flex-wrap gap-2">
                    @forelse($parsedData['skills'] ?? [] as $skill)
                        <span class="px-2.5 py-1 rounded-md bg-background border border-border text-xs font-semibold text-foreground">{{ $skill }}</span>
                    @empty
                        <span class="text-xs text-muted-foreground">No se detectaron habilidades específicas.</span>
                    @endforelse
                </div>
            </div>

            <div class="flex justify-end gap-3">
                <button wire:click="$set('parsedData', null)" class="px-5 py-2.5 rounded-xl text-sm font-semibold text-foreground border border-border hover:bg-muted transition-colors">
                    Re-subir CV
                </button>
                <button wire:click="confirmApplication" class="btn-primary">
                    Confirmar y Aplicar
                </button>
            </div>
        </div>
    @endif
    
    <!-- Success Message Listened from JS -->
    <div x-data="{ show: false }" x-on:application-submitted.window="show = true; setTimeout(() => show = false, 4000)">
        <div x-show="show" style="display: none;" class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-4 rounded-2xl shadow-2xl font-bold flex items-center gap-3 animate-fade-up z-50">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            ¡Aplicación enviada con éxito! El equipo de reclutamiento la revisará pronto.
        </div>
    </div>
</div>
