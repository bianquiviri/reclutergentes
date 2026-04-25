<?php

namespace App\Livewire;

use App\Models\Application;
use App\Models\CandidateProfile;
use App\Models\JobOffer;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard', [
            'totalCandidates' => CandidateProfile::count(),
            'activeOffers' => JobOffer::where('status', 'active')->count(),
            'totalApplications' => Application::count(),
            'recentApplications' => Application::with(['candidateProfile', 'jobOffer'])->latest()->take(5)->get(),
        ]);
    }
}
