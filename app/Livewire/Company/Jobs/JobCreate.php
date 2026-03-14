<?php

namespace App\Livewire\Company\Jobs;

use App\Library\Traits\JobFormHelpersTrait;
use App\Livewire\Forms\JobForm;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Post New Job')]
class JobCreate extends Component
{
    use JobFormHelpersTrait;

    public JobForm $form;

    public function submit()
    {
        $this->form->save();

        session()->flash("success", "<strong>Success!</strong> New job has been created.");
    }

    public function render()
    {
        return view('livewire.company.jobs.job-create')
            ->layout('layouts.site');
    }
}
