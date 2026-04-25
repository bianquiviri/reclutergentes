<?php

namespace App\Livewire;

use App\Models\Application;
use Livewire\Component;
use Illuminate\Support\Facades\App;

class KanbanBoard extends Component
{
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

    public function render()
    {
        $statuses = ['new', 'review', 'test', 'interview', 'hired', 'rejected'];
        $applications = Application::with(['candidateProfile', 'jobOffer'])->get()->groupBy('status');

        return view('livewire.kanban-board', [
            'statuses' => $statuses,
            'applications' => $applications
        ]);
    }
}
