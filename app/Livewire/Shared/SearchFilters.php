<?php

namespace App\Livewire\Shared;

use App\Models\Category;
use App\Models\JobType;
use App\Models\WorkPlace;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class SearchFilters extends Component
{
    public bool $displayAllCategories = false;

    public string $keyword = "";

    public $categoryId = "";

    public $jobTypeId = "";

    public $workPlaceId = "";

    public function updated($property)
    {
        if(in_array($property, ['keyword', 'categoryId', 'jobTypeId', 'workPlaceId'])) {
            $this->dispatch("filter", $property, $this->$property);
        }
    }

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

    #[On('clear-filter')]
    public function onClearFilter($type)
    {
        if(property_exists($this, $type)) {
            $this->$type = "";
        }
    }

    public function render()
    {
        return view('livewire.shared.search-filters');
    }
}
