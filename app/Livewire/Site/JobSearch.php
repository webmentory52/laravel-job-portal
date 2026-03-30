<?php

namespace App\Livewire\Site;

use App\Models\CandidateJob;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Job Search')]
#[Layout('layouts.site')]
class JobSearch extends Component
{
    use WithPagination;

    public function render()
    {
        $candidateJobs = CandidateJob::with(['company'])
                    ->approved()
                    ->latest()
                    ->paginate(20);

        return view('livewire.site.job-search', compact('candidateJobs'));
    }
}
