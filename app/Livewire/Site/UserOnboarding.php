<?php

namespace App\Livewire\Site;

use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class UserOnboarding extends Component
{
    public function becomeIndividual()
    {
        auth()->user()->update([
            'user_onboarding' => true
        ]);

        Toaster::success("You becomed individual!");

        return redirect('/');
    }

    #[On('company-created')]
    public function onCreateCompany()
    {
        Toaster::success("Company created successfully!");

        return redirect('/');
    }

    public function render()
    {
        return view('livewire.site.user-onboarding')
                ->layout('layouts.site')
                ->title('User Onboarding');
    }
}
