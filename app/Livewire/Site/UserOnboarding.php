<?php

namespace App\Livewire\Site;

use Livewire\Component;

class UserOnboarding extends Component
{
    public function becomeIndividual()
    {
        auth()->user()->update([
            'user_onboarding' => true
        ]);

        return redirect('/');
    }

    public function render()
    {
        return view('livewire.site.user-onboarding')
                ->layout('layouts.site')
                ->title('User Onboarding');
    }
}
