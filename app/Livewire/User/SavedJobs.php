<?php

namespace App\Livewire\User;

use App\Models\CandidateJob;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.site')]
#[Title('My Favorite Jobs')]
class SavedJobs extends Component
{
    public $jobs = [];

    function loadJobs($jobIds)
    {
        if($jobIds) {
            $this->jobs = CandidateJob::whereIn('id', $jobIds)->get();
        }
    }

    public function render()
    {
        return view('livewire.user.saved-jobs');
    }
}
