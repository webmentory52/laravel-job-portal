<?php

namespace App\Livewire\Site;

use App\Library\Enums\JobStatusEnum;
use App\Models\CandidateJob;
use Livewire\Component;

class JobDetail extends Component
{
    public CandidateJob $job;

    public function mount($id, $slug = null)
    {
        $this->job = CandidateJob::find($id);

        if(in_array($this->job->status, [
            JobStatusEnum::Pending->value,
            JobStatusEnum::Rejected->value
        ])) {
            abort(404);
        }
    }

    public function render()
    {
        return view('livewire.site.job-detail')
            ->layout('layouts.site')
            ->title($this->job->title);
    }
}
