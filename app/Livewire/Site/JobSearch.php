<?php

namespace App\Livewire\Site;

use App\Models\CandidateJob;
use App\Models\Category;
use App\Models\JobType;
use App\Models\WorkPlace;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Job Search')]
#[Layout('layouts.site')]
class JobSearch extends Component
{
    use WithPagination;

    #[Url]
    public string $keyword = "";

    #[Url]
    public $categoryId = "";

    #[Url]
    public $jobTypeId = "";

    #[Url]
    public $workPlaceId = "";

    #[Url]
    public $viewMode = "grid";

    public function handleFilter($event)
    {
        [$property, $value] = $event;

        if(property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    #[Computed]
    public function selectedFilters()
    {
        $filters = [];

        if($this->categoryId) {
            $filters['categoryId'] = ['name' => Category::find($this->categoryId)->name];
        }

        if($this->jobTypeId) {
            $filters['jobTypeId'] = ['name' => JobType::find($this->jobTypeId)->name];
        }

        if($this->workPlaceId) {
            $filters['workPlaceId'] = ['name' => WorkPlace::find($this->workPlaceId)->name];
        }

        return $filters;
    }

    public function clearFilter($type)
    {
        if(property_exists($this, $type)) {
            $this->$type = "";

            $this->dispatch("clear-filter", $type);
        }
    }

    public function render()
    {
        $query = CandidateJob::with(['company'])
                    ->approved();

        // Filters
        $query->when($this->keyword, fn($query) => $query->where('title', 'LIKE', "%{$this->keyword}%"));
        $query->when($this->categoryId, fn($query) => $query->where('category_id', $this->categoryId));
        $query->when($this->jobTypeId, fn($query) => $query->where('job_type_id', $this->jobTypeId));
        $query->when($this->workPlaceId, fn($query) => $query->where('work_place_id', $this->workPlaceId));

        $candidateJobs = $query->latest()
                    ->paginate(20);

        return view('livewire.site.job-search', compact('candidateJobs'));
    }
}
