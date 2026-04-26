<?php

namespace App\Livewire;

use App\Models\Application;
use Livewire\Component;
use Illuminate\Support\Facades\App;

class KanbanBoard extends Component
{
    public $jobOfferId = null;
    public $selectedApplication = null;

    /**
     * Update the status of an application.
     */
    public function updateApplicationStatus($applicationId, $newStatus)
    {
        // Security check (could be enhanced with Policies)
        // $this->authorize('update', $application);

        $application = Application::with('candidateProfile')->findOrFail($applicationId);
        $oldStatus = $application->status;
        $application->status = $newStatus;
        $application->save();

        // Notification professional style Shadcn (Toast)
        $this->dispatch('notify', [
            'type' => 'success',
            'message' => __('messages.status_updated', [
                'name' => $application->candidateProfile->full_name,
                'status' => __("messages.status.$newStatus")
            ])
        ]);
    }

    public function showApplication($id)
    {
        $this->selectedApplication = Application::with('candidateProfile')->findOrFail($id);
    }

    public function closeApplication()
    {
        $this->selectedApplication = null;
    }

    public function render()
    {
        $statuses = ['new', 'review', 'test', 'interview', 'offer', 'hired', 'rejected'];
        
        $jobOffers = \App\Models\JobOffer::orderBy('created_at', 'desc')->get();
        
        // If no job offer selected, default to the first one
        if (!$this->jobOfferId && $jobOffers->count() > 0) {
            $this->jobOfferId = $jobOffers->first()->id;
        }

        $applicationsQuery = Application::with(['candidateProfile', 'jobOffer']);
        
        if ($this->jobOfferId) {
            $applicationsQuery->where('job_offer_id', $this->jobOfferId);
        }

        $applications = $applicationsQuery->get()->groupBy('status');

        return view('livewire.kanban-board', [
            'statuses' => $statuses,
            'applications' => $applications,
            'jobOffers' => $jobOffers
        ]);
    }
}
