<?php

namespace App\Livewire\Company\Jobs;

use App\Library\Traits\JobFormHelpersTrait;
use App\Livewire\Forms\JobForm;
use App\Models\CandidateJob;
use Livewire\Attributes\Title;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Title('Post New Job')]
class JobCreate extends Component
{
    use JobFormHelpersTrait;

    public JobForm $form;

    public function mount(?int $id = null)
    {
        if($id) {
            $this->form->setJob(CandidateJob::find($id));
        }
    }

    public function submit()
    {
        if(!$this->form->job) {
            $this->form->save();

            Toaster::success("New job has been created.");
        } else {
            $this->form->update();
            Toaster::success("Job updated successfully.");
        }

        return redirect()->route('company.jobs.index');
    }

    public function render()
    {
        return view('livewire.company.jobs.job-create')
            ->layout('layouts.site');
    }
}
