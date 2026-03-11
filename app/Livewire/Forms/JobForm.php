<?php

namespace App\Livewire\Forms;

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

    public $salary = "";

    #[Validate('required')]
    public $job_type_id = "";

    #[Validate('required')]
    public $work_place_id = "";

    public $expires_at = "";

    #[Validate('required')]
    public $description = "";

    public function save()
    {
        $this->validate();
    }
}
