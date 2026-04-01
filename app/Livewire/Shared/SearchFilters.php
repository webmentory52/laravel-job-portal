<?php

namespace App\Livewire\Shared;

use App\Models\Category;
use App\Models\JobType;
use App\Models\WorkPlace;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SearchFilters extends Component
{
    public bool $displayAllCategories = false;

    public function toggleAllCategories()
    {
        $this->displayAllCategories = !$this->displayAllCategories;
    }

    public function getCategories()
    {
        $query = Category::withCount(['candidateJobs' => function($query) {
            return $query->approved();
        }])
            ->having('candidate_jobs_count', '>', 0)
            ->orderByDesc('candidate_jobs_count');

        if($this->displayAllCategories) {
            return $query->get();
        } else {
            return $query->take(4)->get();
        }
    }

    #[Computed]
    public function jobTypes()
    {
        return JobType::withCount(['candidateJobs' => function($query) {
            return $query->approved();
        }])
            ->having('candidate_jobs_count', '>', 0)
            ->orderByDesc('candidate_jobs_count')
            ->get();
    }

    #[Computed]
    public function workPlaces()
    {
        return WorkPlace::withCount(['candidateJobs' => function($query) {
            return $query->approved();
        }])
            ->having('candidate_jobs_count', '>', 0)
            ->orderByDesc('candidate_jobs_count')
            ->get();
    }

    public function render()
    {
        return view('livewire.shared.search-filters');
    }
}
