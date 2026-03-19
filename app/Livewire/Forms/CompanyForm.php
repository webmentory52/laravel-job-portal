<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CompanyForm extends Form
{
    public $company_name = "";
    public $website = "";
    public $email = "";
    public $bio = "";
    public $logo = "";


    protected function rules()
    {
        return [
          "company_name" => "required|string|max:100",
          "website" => "required|url|string",
          "email" => "required|email|string",
          "bio" => "required|string|max:3000",
          "logo" => "nullable|image|max:3024|mimes:jpg,jpeg,png,webp",
        ];
    }

    public function save()
    {
        $this->validate();

        dd($this->all());
    }
}
