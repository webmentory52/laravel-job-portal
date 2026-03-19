<?php

namespace App\Livewire\Forms;

use App\Models\Company;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CompanyForm extends Form
{
    public $company_name = "";
    public $website = "";
    public $email = "";
    public $bio = "";
    public $logo = null;

    public $bioMaxLength = 3000;


    public $company;

    protected function rules()
    {
        return [
          "company_name" => "required|string|max:100",
          "website" => "required|url|string",
          "email" => "required|email|string",
          "bio" => "required|string|max:" . $this->bioMaxLength,
          "logo" => "nullable|image|max:3024|mimes:jpg,jpeg,png,webp",
        ];
    }

    public function create($user)
    {
        $validated = $this->validate();

        $this->company = Company::create($validated);

        $user->update([
           'role' => 'user',
           'user_onboarding' => true
        ]);

        // Upload logo
        $this->uploadLogo();

        // Attach user to company
        $user->companies()->attach($this->company->id, ['role' => 'admin']);

        $this->resetExcept(['company', 'bioMaxLength']);
    }

    private function uploadLogo()
    {
        if($this->logo) {
            $path = $this->logo->storeAs(
              'company/logos/' . $this->company->id,
               'logo.' . $this->logo->getClientOriginalExtension(),
               'public'
            );

            $this->company->update([
               'logo' => $path
            ]);
        }
    }
}
