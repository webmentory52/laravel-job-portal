<?php

namespace App\Livewire\Site;

use App\Library\Enums\JobStatusEnum;
use App\Models\CandidateJob;
use Livewire\Component;

class Home extends Component
{
    public string $search = "";

    public function render()
    {
        $jobs = CandidateJob::approved()
                ->when($this->search, function ($query) {
                    $query->where("title", "LIKE", "%{$this->search}%");
                });

        $jobs->latest()
            ->limit(9);

        $jobs = $jobs->get();

        return view('livewire.site.home', compact('jobs'))
                    ->layout('layouts.site');
    }
}
