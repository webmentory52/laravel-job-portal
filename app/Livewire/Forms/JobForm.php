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

    #[Validate('required')]
    public $description = "";

    #[Validate('required|accepted')]
    public $agreement_accepted = 0;

    public function save()
    {
        $validated = $this->validate();

        $validated = [...$validated,
             'user_id' => auth()->user()->id,
             'company_id' => auth()->user()->getCompany()?->id,
//             'status' => JobStatusEnum::Pending->value,
              'status' => JobStatusEnum::Approved->value
        ];

        $validated['description'] = [
            [
                "title" => "Job Description",
                "content" => $this->description,
                "title_editable" => false
            ]
        ];

        $job = CandidateJob::create($validated);

        $this->reset();

        return $job;
    }
}
