<?php

namespace App\Livewire\Admin\Jobs;

use App\Library\Traits\JobActionsTrait;
use App\Models\CandidateJob;
use Flux\Flux;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Job Listing | Admin')]
class JobListing extends Component
{
    use WithPagination, JobActionsTrait;

    #[Url]
    public $perPage = 10;

    public $search = '';

    public function __construct()
    {
        $this->redirectTo = 'admin.jobs.index';
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = CandidateJob::query();

        // Apply search filter
        $query->when($this->search, fn ($q, $search) => $q->where('title', 'like', "%{$search}%"));

        $jobs = $query->latest('created_at')
                        ->paginate($this->perPage);

        return view('livewire.admin.jobs.job-listing', compact('jobs'));
    }
}
