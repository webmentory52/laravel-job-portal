<?php

namespace App\Livewire\Site;

use Livewire\Component;

class UserOnboarding extends Component
{
    public function render()
    {
        return view('livewire.site.user-onboarding')
                ->layout('layouts.site')
                ->title('User Onboarding');
    }
}
