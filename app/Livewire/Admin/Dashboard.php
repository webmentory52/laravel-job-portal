<?php

namespace App\Livewire\Admin;

use App\Models\CandidateJob;
use App\Models\Company;
use App\Models\JobApplication;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard', [
            'totalJobs' => CandidateJob::count(),
            'totalUsers' => User::where('role', 'user')->count(),
            'totalCompany' => Company::count(),
            'totalJobApplications' => JobApplication::count(),
            'recentJobs' => CandidateJob::latest()->take(5)->get(),
        ]);
    }
}
