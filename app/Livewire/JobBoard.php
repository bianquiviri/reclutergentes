<?php

namespace App\Livewire;

use App\Models\JobOffer;
use Livewire\Component;
use Livewire\WithPagination;

class JobBoard extends Component
{
    use WithPagination;

    public $search = '';
    public $category = '';
    public $workMode = '';
    public $selectedOffer = null;
    public $showApplyForm = false;

    protected $updatesQueryString = ['search', 'category', 'workMode'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function showOffer($id)
    {
        $this->selectedOffer = JobOffer::find($id);
        $this->showApplyForm = false;
    }

    public function closeOffer()
    {
        $this->selectedOffer = null;
        $this->showApplyForm = false;
    }

    public function render()
    {
        $offers = JobOffer::query()
            ->where('status', 'active')
            ->when($this->search, function ($query) {
                $query->where('title->' . app()->getLocale(), 'like', '%' . $this->search . '%')
                      ->orWhere('location', 'like', '%' . $this->search . '%');
            })
            ->when($this->category, function ($query) {
                // Assuming category might be in description or a dedicated column (will use location for now as proxy)
                $query->where('location', 'like', '%' . $this->category . '%');
            })
            ->paginate(6);

        return view('livewire.job-board', [
            'offers' => $offers
        ]);
    }
}
