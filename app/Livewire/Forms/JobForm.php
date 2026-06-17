<?php

namespace App\Livewire\Forms;

use App\Library\Enums\JobStatusEnum;
use App\Models\CandidateJob;
use App\Models\Company;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class JobForm extends Form
{
    #[Validate('required')]
    public $title = "";

    #[Validate('required')]
    public $category_id = "";

    #[Validate('required')]
    public $location = "";

    #[Validate('nullable')]
    public $salary = "";

    #[Validate('required')]
    public $job_type_id = "";

    #[Validate('required')]
    public $work_place_id = "";

    #[Validate('nullable|date|after:today')]
    public ?string $expires_at = null;

    #[Validate('required|array')]
    #[Validate(['description.*.title' => 'nullable|string'])]
    #[Validate(['description.*.content' => 'nullable|string'])]
    #[Validate(['description.*.title_editable' => 'nullable|boolean'])]
    public $description = [
        [
            "title" => "Job Description",
            "content" => "",
            "title_editable" => false
        ],
        [
            "title" => "Requirements",
            "content" => "",
            "title_editable" => false
        ],
        [
            "title" => "Benefits",
            "content" => "",
            "title_editable" => false
        ]
    ];

    public $agreement_accepted = 0;

    public ?CandidateJob $job = null;

    public $company_id = null;


    protected function rules()
    {
        return [
          'agreement_accepted' => [
              Rule::requiredIf(! auth()->user()->isAdmin())
          ]
        ];
    }

    public function setJob(CandidateJob $job)
    {
        $this->job = $job;
        $this->fill($job->only(['title', 'category_id', 'location', 'salary', 'job_type_id', 'work_place_id', 'expires_at', 'description', 'agreement_accepted', 'company_id']));
    }

    public function save()
    {
        $validated = $this->validate();

        if(!$this->hasAtLeastOneDescriptionItem()) {
            $this->addError('description', 'You must add at least one description section.');
            return;
        }

        if(!auth()->user()->isAdmin()) {
            $validated['company_id'] = auth()->user()->getCompany()?->id;
            $validated['user_id'] = auth()->user()->id;
            $validated['status'] = JobStatusEnum::Pending->value;
        } else {
            $validated['company_id'] = $this->company_id;
            $company = Company::with('users')->find($this->company_id);
            $validated['user_id'] = $company->users()?->first()?->id;
            $validated['status'] = JobStatusEnum::Approved->value;
            $validated['agreement_accepted'] = 1;
        }

        $validated['description'] = array_filter($validated['description'], fn($item) => isset($item['title']) && isset($item['content']));

        $this->job = CandidateJob::create($validated);

//        $this->reset();

        return $this->job;
    }

    public function update()
    {
        $validated = $this->validate();

        if(!$this->hasAtLeastOneDescriptionItem()) {
            $this->addError('description', 'You must add at least one description section.');
            return;
        }

        if(auth()->user()->isAdmin()) {
            $validated['company_id'] = $this->company_id;
        } else {
            if(in_array($this->job->status, [JobStatusEnum::Approved->value, JobStatusEnum::Rejected->value])) {
                $validated['status'] = JobStatusEnum::Pending->value;
            }
        }

        $validated['description'] = array_filter($validated['description'], fn($item) => isset($item['title']) && isset($item['content']));

        $this->job->update($validated);
    }

    protected function hasAtLeastOneDescriptionItem()
    {
        return collect($this->description)->contains(function ($item) {
            return filled($item['title'] ?? null) && filled($item['content'] ?? null);
        });
    }

}
