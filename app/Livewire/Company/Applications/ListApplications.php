<?php

namespace App\Livewire\Company\Applications;

use App\Library\Enums\JobApplicationStatusEnum;
use App\Models\JobApplication;
use App\Notifications\ApplicationApprovedNotification;
use App\Notifications\ApplicationRejectedNotification;
use Flux\Flux;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Title('Job Applications')]
#[Layout('layouts.site')]
class ListApplications extends Component
{
    public $rejectedId;

    #[Validate('required|min:10|max:500')]
    public $rejection_reason = "";

    public function approve(int $id)
    {
        $application = JobApplication::findOrFail($id);

        $application->update([
            'status' => JobApplicationStatusEnum::Accepted->value
        ]);

        // send notification
        $application->user->notify(new ApplicationApprovedNotification($application));

        Toaster::success("Application approved! An approval notification has been sent to the applicant");
    }

    public function setRejectedId(int $id)
    {
        $this->rejectedId = $id;
    }

    public function reject()
    {
        $this->validate();

        if(!$this->rejectedId) {
            return;
        }

        $application = JobApplication::findOrFail($this->rejectedId);

        $application->update([
            'status' => JobApplicationStatusEnum::Rejected->value,
            'rejection_reason' => $this->rejection_reason
        ]);

        // send notification
        $application->user->notify(new ApplicationRejectedNotification($application));

        // close modal
        Flux::modal('reject-application')->close();
        $this->rejectedId = null;

        // show success
        Toaster::success("Application rejected! A rejection notification has been sent to the applicant");
    }

    public function render()
    {
        $applications = auth()->user()->getCompany()
                        ->applications()
                        ->latest()
                        ->paginate(10);

        return view('livewire.company.applications.list-applications', compact('applications'));
    }
}
