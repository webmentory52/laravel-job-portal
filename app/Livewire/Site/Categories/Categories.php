<?php

namespace App\Livewire\Site\Categories;

use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Categories')]
#[Layout('layouts.site')]
class Categories extends Component
{
    public function render()
    {
        $categories = Category::withCount(['candidateJobs' => function($query) {
            $query->approved();
        }])
        ->having('candidate_jobs_count', '>', 0)
        ->orderByDesc('candidate_jobs_count')
        ->get();

        return view('livewire.site.categories.categories', compact('categories'));
    }
}
