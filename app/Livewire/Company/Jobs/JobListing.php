<?php

namespace App\Livewire\Company\Jobs;

use App\Library\Enums\JobStatusEnum;
use App\Library\Traits\JobActionsTrait;
use App\Models\CandidateJob;
use App\Models\User;
use App\Notifications\JobExpiredNotification;
use Flux\Flux;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

#[Layout('layouts.site')]
#[Title('Job Listing')]
class JobListing extends Component
{
    use WithPagination, JobActionsTrait;

    public function __construct()
    {
        $this->redirectTo = "company.jobs.index";
    }

    public function render()
    {
        $candidateJobs = CandidateJob::where("company_id", auth()->user()->getCompany()?->id)
                        ->latest()
                        ->paginate(20);

        return view('livewire.company.jobs.job-listing', compact('candidateJobs'));
    }
}
