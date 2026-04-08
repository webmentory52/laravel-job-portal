<?php

namespace App\Livewire\Site\Companies;

use App\Models\CandidateJob;
use App\Models\Company;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.site')]
class CompanyDetail extends Component
{
    public Company $company;

    public function mount($id, ?string $slug = null)
    {
        $this->company = Company::findOrFail($id);
    }

    public function render()
    {
        $jobs = CandidateJob::approved()
                    ->where('company_id', $this->company->id)
                    ->latest()
                    ->take(5)
                   ->get();

        return view('livewire.site.companies.company-detail', compact('jobs'))
                    ->title($this->company->company_name);
    }
}
