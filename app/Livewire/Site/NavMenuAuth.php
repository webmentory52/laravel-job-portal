<?php

namespace App\Livewire\Site;

use App\Library\Enums\JoinRequestStatusEnum;
use App\Models\JoinRequest;
use Livewire\Component;

class NavMenuAuth extends Component
{
    public function render()
    {
        $pendingJoinRequestsCount = 0;

        if(auth()->user()->currentUserBelongsToCompany()
            && auth()->user()->isCurrentUserCompanyAdmin()) {

            $pendingJoinRequestsCount = JoinRequest::where('status', JoinRequestStatusEnum::Pending->value)
                ->where('company_id', auth()->user()->getCompany()?->id)
                ->count();
        }

        return view('livewire.site.nav-menu-auth', compact('pendingJoinRequestsCount'));
    }
}
