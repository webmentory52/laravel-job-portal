<?php

namespace App\Livewire\Admin\JobTypes;

use App\Models\JobType;
use Livewire\Attributes\Title;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Title('Job Types | Admin')]
class ListJobTypes extends Component
{
    public $jobTypeName = "";

    public $editJobType = null;


    public function save()
    {
        $this->validate([
            'jobTypeName' => 'required|unique:job_types,name' . ($this->editJobType ? ',' . $this->editJobType->id : ''),
        ]);

        JobType::updateOrCreate(
            ['id' => $this->editJobType?->id],
            ['name' => $this->jobTypeName]
        );

        $this->reset(['jobTypeName', 'editJobType']);

        if($this->editJobType) {
            Toaster::success("JobType updated successfully");
        } else {
            Toaster::success("JobType added successfully");
        }
    }

    public function edit(JobType $jobType)
    {
        $this->editJobType = $jobType;
        $this->jobTypeName = $jobType->name;
    }

    public function delete(JobType $jobType)
    {
        if($jobType->candidateJobs()->count() > 0) {
            Toaster::error("This item already attached to existing jobs!");
            return;
        }

        $jobType->delete();

        Toaster::success('JobType deleted successfully.');
    }

    public function render()
    {
        return view('livewire.admin.job-types.list-job-types', [
            'jobTypes' => JobType::all()
        ]);
    }
}
