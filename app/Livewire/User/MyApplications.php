<?php

namespace App\Livewire\User;

use App\Models\JobApplication;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.site')]
#[Title('My Applications')]
class MyApplications extends Component
{
    use WithPagination;

    public $filter = "";

    public function setFilter($status)
    {
        $this->filter = $status;
    }

    public function render()
    {
        $applications = JobApplication::with(['candidateJob'])
                        ->where('user_id', auth()->user()->id)
                        ->when($this->filter, function ($q, $filter) {
                            $q->where("status", $filter);
                        })
                        ->latest()
                        ->paginate(10);

        return view('livewire.user.my-applications', compact('applications'));
    }
}
