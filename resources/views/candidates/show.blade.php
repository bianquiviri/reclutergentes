<x-app-layout>
    @php
        $candidate = \App\Models\CandidateProfile::find($id);
    @endphp

    @if(!$candidate)
        <div class="text-center py-20">
            <h2 class="text-2xl font-bold text-muted-foreground">Candidate not found.</h2>
            <a href="/kanban" class="text-primary hover:underline mt-4 inline-block">Return to Board</a>
        </div>
    @else
        <div class="max-w-6xl mx-auto">
            <div class="flex justify-between items-start mb-8">
                <div class="flex items-center space-x-6">
                    <div class="h-20 w-20 rounded-2xl bg-primary flex items-center justify-center text-primary-foreground text-3xl font-black shadow-lg">
                        {{ substr($candidate->name, 0, 1) }}
                    </div>
                    <div>
                        <h1 class="text-4xl font-black tracking-tight text-foreground">{{ $candidate->name }}</h1>
                        <div class="flex items-center space-x-4 mt-2">
                            <span class="flex items-center text-sm text-muted-foreground">
                                <svg class="mr-1.5 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                {{ $candidate->email }}
                            </span>
                            <span class="flex items-center text-sm text-muted-foreground">
                                <svg class="mr-1.5 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $candidate->address }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <button class="p-3 bg-card border border-border rounded-xl hover:bg-accent transition-colors">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                    </button>
                    <button class="px-6 py-3 bg-primary text-primary-foreground rounded-xl font-bold hover:opacity-90 transition-all shadow-md">
                        Hire Candidate
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Info -->
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-card border border-border rounded-2xl p-8 shadow-sm">
                        <h3 class="text-xl font-bold text-foreground mb-6">Parsed Content (IA)</h3>
                        <div class="prose prose-slate max-w-none">
                            <pre class="bg-muted p-4 rounded-xl text-xs text-muted-foreground overflow-x-auto">{{ json_encode($candidate->parsed_content, JSON_PRETTY_PRINT) }}</pre>
                        </div>
                    </div>

                    <div class="bg-card border border-border rounded-2xl p-8 shadow-sm">
                        <h3 class="text-xl font-bold text-foreground mb-6">Experience & Skills</h3>
                        <div class="space-y-4">
                            <div class="flex flex-wrap gap-2">
                                @foreach($candidate->parsed_content['skills'] ?? [] as $skill)
                                    <span class="px-4 py-2 bg-muted text-foreground text-sm font-medium rounded-full border border-border">
                                        {{ $skill }}
                                    </span>
                                @endforeach
                            </div>
                            <p class="text-muted-foreground">{{ $candidate->parsed_content['experience'] ?? 'No experience data available.' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Details -->
                <div class="space-y-8">
                    <div class="bg-card border border-border rounded-2xl p-8 shadow-sm">
                        <h3 class="text-lg font-bold text-foreground mb-6">Assessment</h3>
                        <div class="space-y-6">
                            <div>
                                <p class="text-sm text-muted-foreground mb-2">English Level</p>
                                <span class="px-3 py-1 bg-primary text-primary-foreground text-xs font-black rounded-lg">
                                    {{ $candidate->english_level }}
                                </span>
                            </div>
                            <div>
                                <p class="text-sm text-muted-foreground mb-2">Test Score</p>
                                <div class="w-full bg-muted rounded-full h-3">
                                    <div class="bg-primary h-3 rounded-full" style="width: 85%"></div>
                                </div>
                                <p class="text-right text-xs font-bold mt-1">85%</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-card border border-border rounded-2xl p-8 shadow-sm">
                        <h3 class="text-lg font-bold text-foreground mb-6">Documents</h3>
                        <div class="flex items-center p-4 border border-dashed border-border rounded-xl hover:bg-accent cursor-pointer transition-colors group">
                            <svg class="h-8 w-8 text-muted-foreground group-hover:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            <div class="ml-4">
                                <p class="text-sm font-bold">Resume.pdf</p>
                                <p class="text-xs text-muted-foreground">View CV encrypted</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
