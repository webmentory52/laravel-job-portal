<?php

namespace App\Livewire\Company\Jobs;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Post New Job')]
class JobCreate extends Component
{
    public function render()
    {
        return view('livewire.company.jobs.job-create')
            ->layout('layouts.site');
    }
}
