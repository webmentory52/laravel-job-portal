<?php

namespace App\Livewire\User;

use App\Library\Enums\JobApplicationStatusEnum;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.site')]
#[Title('My Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        $user = auth()->user();

        return view('livewire.user.dashboard', [
            'totalApplications' => $user->jobApplications()->count(),
            'acceptedApplications' => $user->jobApplications()->where('status', JobApplicationStatusEnum::Accepted->value)->count(),
            'rejectedApplications' => $user->jobApplications()->where('status', JobApplicationStatusEnum::Rejected->value)->count(),
            'pendingApplications' => $user->jobApplications()->where('status', JobApplicationStatusEnum::Pending->value)->count(),
            'recentApplications' => $user->jobApplications()->with('candidateJob')->latest()->take(5)->get()
        ]);
    }
}
