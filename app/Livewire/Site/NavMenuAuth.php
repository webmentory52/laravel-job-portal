<?php

namespace App\Livewire\Site;

use App\Library\Enums\JobApplicationStatusEnum;
use App\Library\Enums\JoinRequestStatusEnum;
use App\Models\JoinRequest;
use Livewire\Component;

class NavMenuAuth extends Component
{
    public $navItems = [];

    public $pendingJoinRequestsCount = 0;

    public $pendingApplicationsCount = 0;


    public function mount()
    {
        $this->setCounters();

        $this->setNavItems();
    }

    private function setCounters()
    {
        if(auth()->user()->currentUserBelongsToCompany()
            && auth()->user()->isCurrentUserCompanyAdmin()) {

            $company = auth()->user()->getCompany();

            $this->pendingJoinRequestsCount = JoinRequest::where('status', JoinRequestStatusEnum::Pending->value)
                ->where('company_id', $company?->id)
                ->count();

            $this->pendingApplicationsCount = $company->applications()->where('job_applications.status', JobApplicationStatusEnum::Pending->value)
                ->count();
        }
    }

    private function setNavItems()
    {
        $this->navItems = [
            [
                'name' => 'My Applications',
                'icon' => 'document-text',
                'url' => route('applications.my'),
                'is_active' => request()->routeIs('applications.my'),
            ],
            [
                'name' => 'Company Jobs',
                'icon' => 'megaphone',
                'url' => route('company.jobs.index'),
                'is_active' => request()->routeIs('company.jobs.index'),
                'show_only' => auth()->user()->currentUserBelongsToCompany()
            ],
            [
                'name' => 'Account',
                'icon' => 'globe-americas',
                'url' => '#',
                'badge' => $this->pendingJoinRequestsCount + $this->pendingApplicationsCount,
                'children' => [
                    [
                        'name' => 'My Dashboard',
                        'icon' => 'globe-americas',
                        'url' => route('dashboard'),
                        'is_active' => request()->routeIs('dashboard')
                    ],
                    [
                        'name' => 'Edit Profile',
                        'icon' => 'user-circle',
                        'url' => route('profile.edit'),
                        'is_active' => request()->routeIs('profile.edit')
                    ],
                    [
                        'name' => 'Favorite Jobs',
                        'icon' => 'bookmark',
                        'url' => route('favorites.my'),
                        'is_active' => request()->routeIs('favorites.my')
                    ],
                    [
                        'name' => 'Company',
                        'url' => '#',
                        'show_only' => auth()->user()->currentUserBelongsToCompany(),
                        'badge' => $this->pendingJoinRequestsCount + $this->pendingApplicationsCount,
                        'children' => [
                            [
                                'name' => 'Company Dashboard',
                                'icon' => 'building-office',
                                'url' =>  route('company.dashboard'),
                                'is_active' => request()->routeIs('company.dashboard')
                            ],
                            [
                                'name' => 'Edit Company Profile',
                                'icon' => 'pencil',
                                'url' =>  route('company.profile.edit'),
                                'is_active' => request()->routeIs('company.profile.edit'),
                                'show_only' => auth()->user()->isCurrentUserCompanyAdmin()
                            ],
                            [
                                'name' => 'Job Applications',
                                'icon' => 'newspaper',
                                'url' =>  route('company.applications'),
                                'is_active' => request()->routeIs('company.applications'),
                                'badge' => $this->pendingApplicationsCount
                            ],
                            [
                                'name' => 'Join Requests',
                                'url' =>  route('company.join-requests'),
                                'is_active' => request()->routeIs('company.join-requests'),
                                'badge' => $this->pendingJoinRequestsCount
                            ]
                        ]
                    ]
                ]
            ],

        ];
    }

    public function render()
    {
        return view('livewire.site.nav-menu-auth');
    }
}
