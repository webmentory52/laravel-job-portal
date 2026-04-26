<?php

namespace App\Livewire\Company\Applications;

use App\Library\Enums\JobApplicationStatusEnum;
use App\Models\JobApplication;
use App\Notifications\ApplicationApprovedNotification;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Layout('layouts.site')]
class ApplicationShow extends Component
{
    public JobApplication $application;

    public function mount($id)
    {
        $this->application = JobApplication::with(['user', 'candidateJob'])
                        ->findOrFail($id);

        abort_if($this->application->candidateJob->company_id !== auth()->user()->getCompany()->id, 403);
    }

    public function approve()
    {
        $this->application->update(['status' => JobApplicationStatusEnum::Accepted->value]);

        $this->application->user->notify(new ApplicationApprovedNotification($this->application));

        Toaster::success("Application approved! An approval notification has been sent to the applicant");
    }

    #[On('reject-success')]
    public function onReject()
    {
        $this->dispatch("refresh");
    }

    public function render()
    {
        return view('livewire.company.applications.application-show')
                    ->title('Application #' . $this->application->id . ' Details');
    }
}
