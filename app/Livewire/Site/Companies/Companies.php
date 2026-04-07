<?php

namespace App\Livewire\Site\Companies;

use App\Models\Company;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.site')]
#[Title('Companies')]
class Companies extends Component
{
    public function render()
    {
        $companies = Company::query()
                        ->whereHas('candidateJobs', fn($query) => $query->approved())
                        ->withCount(['candidateJobs as jobs_count' => fn($query) => $query->approved()])
                        ->orderByDesc('jobs_count')
                        ->paginate(12);

        return view('livewire.site.companies.companies', compact('companies'));
    }
}
