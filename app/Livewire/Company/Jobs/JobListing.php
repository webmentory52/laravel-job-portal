<?php

namespace App\Livewire\Company\Jobs;

use App\Models\CandidateJob;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.site')]
#[Title('Job Listing')]
class JobListing extends Component
{
    use WithPagination;

    public function render()
    {
        $candidateJobs = CandidateJob::where("company_id", auth()->user()->getCompany()?->id)
                        ->latest()
                        ->paginate(20);

        return view('livewire.company.jobs.job-listing', compact('candidateJobs'));
    }
}
