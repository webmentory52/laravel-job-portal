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

    public $existing_logo = null;

    public $isEdit = false;

    protected function rules()
    {
        return [
          "company_name" => "required|string|max:100",
          "website" => "required|url|string",
          "email" => "required|email|string".($this->isEdit && $this->company ? "|unique:companies,email,{$this->company->id}" : ""),
          "bio" => "required|string|max:" . $this->bioMaxLength,
          "logo" => "nullable|image|max:3024|mimes:jpg,jpeg,png,webp",
        ];
    }

    public function load($user)
    {
        $this->isEdit = true;

        $this->company = $user?->getCompany();
        $this->company_name = $this->company?->company_name;
        $this->website = $this->company?->website;
        $this->email = $this->company?->email;
        $this->bio = $this->company?->bio;
        $this->existing_logo = $this->company?->logo;
    }

    public function create($user)
    {
        $this->isEdit = false;

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

    public function update()
    {
        $validated = $this->validate();

        $this->company->update([
            'company_name' => $validated['company_name'],
            'website' => $validated['website'],
            'email' => $validated['email'],
            'bio' => $validated['bio']
        ]);

        // Upload logo
        $this->uploadLogo();

        return true;
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
