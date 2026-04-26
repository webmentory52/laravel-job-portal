<?php

namespace App\Livewire\Site;

use App\Models\CandidateJob;
use App\Models\JobApplication;
use App\Notifications\NewJobApplicationNotification;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Masmerise\Toaster\Toaster;

class JobApplyForm extends Component
{
    use WithFileUploads;

    public CandidateJob $job;

    public $name = "";

    public $email = "";

    #[Validate('required|max:15')]
    public $phone = "";

    #[Validate('required|max:3000')]
    public $coverLetter = "";

    #[Validate('required|file|mimes:pdf,doc,docx|max:3048')]
    public $resume;

    public $isSubmitting = false;


    public function submit()
    {
        $this->validate();

        if($this->job->hasUserApplied(auth()->user()->id)) {
            Toaster::error("You have already applied for this job.");
            return;
        }

        // Save the application data
        $payload = [
            "job_id" => $this->job->id,
            "user_id" => auth()->user()->id,
            "phone" => $this->phone,
            "cover_letter" => $this->coverLetter,
            "resume" => ""
        ];

        $application = JobApplication::create($payload);

        // Upload resume
        $path = $this->resume->storeAs("resumes/{$application->id}", "resume." . $this->resume->getClientOriginalExtension());

        $application->update([
            "resume" => $path
        ]);

        // Send notification
        $this->job->company->users->each(fn($user) => $user->notify(new NewJobApplicationNotification($application)));

        // Reset fields
        $this->reset(["coverLetter", "resume", "phone"]);

        $this->isSubmitting = true;

        Toaster::success("Your application has been submitted successfully.");
    }

    public function mount()
    {
        $this->name = auth()->user()->name;

        $this->email = auth()->user()->email;
    }

    public function render()
    {
        return view('livewire.site.job-apply-form');
    }
}
