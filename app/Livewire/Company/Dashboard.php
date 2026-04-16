<?php

namespace App\Livewire\Company;

use App\Models\CandidateJob;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.site')]
#[Title('Company Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        $companyId = auth()->user()->getCompany()?->id;

        $data = [
          'totalJobs' => CandidateJob::where('company_id', $companyId)->count(),
          'pendingJobs' => CandidateJob::where('company_id', $companyId)->pending()->count(),
          'approvedJobs' => CandidateJob::where('company_id', $companyId)->approved()->count(),
           'rejectedJobs' => CandidateJob::where('company_id', $companyId)->rejected()->count(),
            'recentJobs' => CandidateJob::where('company_id', $companyId)->latest()->take(5)->get(),
        ];

        return view('livewire.company.dashboard', $data);
    }
}
