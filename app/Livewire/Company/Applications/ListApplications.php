<?php

namespace App\Livewire\Company\Applications;

use App\Library\Enums\JobApplicationStatusEnum;
use App\Models\JobApplication;
use App\Notifications\ApplicationApprovedNotification;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Title('Job Applications')]
#[Layout('layouts.site')]
class ListApplications extends Component
{
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
        $this->dispatch('rejected-id-set', id: $id);
    }

    #[On('reject-success')]
    public function onReject()
    {
        $this->dispatch("refresh");
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
