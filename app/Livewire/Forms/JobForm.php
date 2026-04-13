<?php

namespace App\Livewire\Forms;

use App\Library\Enums\JobStatusEnum;
use App\Models\CandidateJob;
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

    #[Validate('required|accepted')]
    public $agreement_accepted = 0;

    public ?CandidateJob $job = null;


    public function setJob(CandidateJob $job)
    {
        $this->job = $job;
        $this->fill($job->only(['title', 'category_id', 'location', 'salary', 'job_type_id', 'work_place_id', 'expires_at', 'description', 'agreement_accepted']));
    }

    public function save()
    {
        $validated = $this->validate();

        if(!$this->hasAtLeastOneDescriptionItem()) {
            $this->addError('description', 'You must add at least one description section.');
            return;
        }

        $validated = [...$validated,
            'user_id' => auth()->user()->id,
            'company_id' => auth()->user()->getCompany()?->id,
//             'status' => JobStatusEnum::Pending->value,
            'status' => JobStatusEnum::Approved->value
        ];

        $validated['description'] = array_filter($validated['description'], fn($item) => isset($item['title']) && isset($item['content']));

        $job = CandidateJob::create($validated);

        $this->reset();

        return $job;
    }

    public function update()
    {
        $validated = $this->validate();

        if(!$this->hasAtLeastOneDescriptionItem()) {
            $this->addError('description', 'You must add at least one description section.');
            return;
        }

        $validated = [...$validated,
            'status' => JobStatusEnum::Approved->value
        ];

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
