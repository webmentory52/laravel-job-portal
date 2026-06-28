<?php

namespace App\Livewire\Admin\Jobs;

use App\Library\Traits\JobActionsTrait;
use App\Models\CandidateJob;
use App\Models\Company;
use App\Notifications\JobStatusUpdated;
use Flux\Flux;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

#[Title('Job Listing | Admin')]
class JobListing extends Component
{
    use WithPagination, JobActionsTrait;

    #[Url]
    public $perPage = 10;

    public $search = '';

    #[Url]
    public $company_id = null;

    public function __construct()
    {
        $this->redirectTo = 'admin.jobs.index';
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updateStatus($jobId, $status)
    {
        $job = CandidateJob::findOrFail($jobId);
        $job->update(['status' => $status]);

        // Send notification
        $job->user->notify(new JobStatusUpdated(
            candidateJob: $job,
            title: "Job Status Updated",
            body: "Your job \"{$job->title}\" has been {$status}.",
            clickUrl: route('admin.jobs.create')
        ));

        Toaster::success('Job status updated.');
    }

    #[Computed]
    public function company()
    {
        return Company::find($this->company_id);
    }

    public function render()
    {
        $query = CandidateJob::query();

        // Apply search filter
        $query->when($this->search, fn ($q, $search) => $q->where('title', 'like', "%{$search}%"));

        // Apply company filter
        $query->when($this->company_id, fn ($q, $companyId) => $q->where('company_id', $companyId));

        $jobs = $query->latest('created_at')
                        ->paginate($this->perPage);

        return view('livewire.admin.jobs.job-listing', compact('jobs'));
    }
}
