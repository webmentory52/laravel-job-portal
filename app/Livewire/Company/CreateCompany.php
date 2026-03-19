<?php

namespace App\Livewire\Company;

use App\Livewire\Forms\CompanyForm;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateCompany extends Component
{
    use WithFileUploads;

    public CompanyForm $form;

    public function submit()
    {
        $this->form->create(auth()->user());

        $this->dispatch("company-created", ["id" => $this->form->company->id]);
    }

    public function render()
    {
        return view('livewire.company.create-company')
                ->layout('layouts.site');
    }
}
