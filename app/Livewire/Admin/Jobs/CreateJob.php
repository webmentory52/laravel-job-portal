<?php

namespace App\Livewire\Admin\Jobs;

use App\Livewire\Forms\JobForm;
use App\Models\CandidateJob;
use App\Models\Company;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Title('Create Job | Admin')]
class CreateJob extends Component
{
    public JobForm $form;

    public $companies = [];


    public function mount(?int $id = null)
    {
        if($id) {
            $this->form->setJob(CandidateJob::find($id));
        }
    }

    #[On('search')]
    public function onFilterCompanies($query)
    {
        $this->companies = Company::query()
            ->select("id", "company_name")
            ->whereLike("company_name", '%' . $query . '%')
            ->limit(5)
            ->get()->map(fn($item) => ['id' => $item->id, 'name' => $item->company_name])->toArray();
    }

    #[On('clear-selection')]
    public function onClearCompanies()
    {
        $this->companies = [];

        $this->form->company_id = null;
    }

    #[On('select-item')]
    public function onSelectCompany($data)
    {
        if($data) {
            $this->form->company_id = $data["id"];
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

        return redirect()->route('admin.jobs.index');
    }

    public function render()
    {
        return view('livewire.admin.jobs.create-job');
    }
}
