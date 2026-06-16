<?php

namespace App\Livewire\Company\Jobs;

use App\Library\Traits\JobFormHelpersTrait;
use App\Livewire\Forms\JobForm;
use App\Models\CandidateJob;
use App\Models\User;
use App\Notifications\JobPendingApproval;
use App\Notifications\JobUpdatedApproval;
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

            // Send notification
            User::admin()->get()
                ->each(fn($admin) => $admin->notify(new JobPendingApproval(
                    job: $this->form->job,
                    title: 'New Job Submitted',
                    message: "Job '{$this->form->job->title}' is waiting for approval.",
                    clickUrl: route('admin.jobs.create', $this->form->job->id)
                )));

            Toaster::success("New job has been created.");
        } else {
            $this->form->update();

            // Send notification
            User::admin()->get()
                ->each(fn($admin) => $admin->notify(new JobUpdatedApproval(
                    job: $this->form->job,
                    title: 'Job Updated',
                    message: "Job '{$this->form->job->title}' is updated and waiting for approval.",
                    clickUrl: route('admin.jobs.create', $this->form->job->id)
                )));

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
