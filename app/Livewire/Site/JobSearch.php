<?php

namespace App\Livewire\Site;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Job Search')]
#[Layout('layouts.site')]
class JobSearch extends Component
{
    public function render()
    {
        return view('livewire.site.job-search');
    }
}
