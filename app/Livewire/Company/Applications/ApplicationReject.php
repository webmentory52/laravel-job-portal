<?php

namespace App\Livewire\Company\Applications;

use App\Library\Enums\JobApplicationStatusEnum;
use App\Models\JobApplication;
use App\Notifications\ApplicationRejectedNotification;
use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class ApplicationReject extends Component
{
    #[Validate('required|min:10|max:500')]
    public $rejection_reason = "";

    public ?JobApplication $application;

    #[On('rejected-id-set')]
    public function setRejectedApplication($id)
    {
        $this->application = JobApplication::find($id);
    }

    public function reject()
    {
        $this->validate();

        if(!$this->application) {
            return;
        }

        $this->application->update([
            'status' => JobApplicationStatusEnum::Rejected->value,
            'rejection_reason' => $this->rejection_reason
        ]);

        // send notification
        $this->application->user->notify(new ApplicationRejectedNotification($this->application));

        // close modal
        Flux::modal('reject-application')->close();

        $this->reset(['application', 'rejection_reason']);

        // show success
        Toaster::success("Application rejected! A rejection notification has been sent to the applicant");

        $this->dispatch("reject-success");
    }

    public function render()
    {
        return view('livewire.company.applications.application-reject');
    }
}
