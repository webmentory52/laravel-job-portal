<?php

namespace App\Livewire\Company\Profile;

use App\Livewire\Forms\CompanyForm;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Masmerise\Toaster\Toaster;

#[Layout('layouts.site')]
#[Title('Edit Company Profile')]
class Edit extends Component
{
    use WithFileUploads;

    public CompanyForm $form;

    public function mount()
    {
        $this->form->load(auth()->user());
    }

    public function save()
    {
        $this->form->update();

        Toaster::success("Company profile updated successfully!");
    }

    public function render()
    {
        return view('livewire.company.profile.edit');
    }
}
