<?php

namespace App\Livewire\Company;

use App\Library\Enums\JoinRequestStatusEnum;
use App\Models\JoinRequest;
use Livewire\Attributes\Title;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Title('Join Requests')]
class JoinRequests extends Component
{

    public function approve(int $id)
    {
        $rejoinRequest = JoinRequest::findOrFail($id);

        // Update status
        $rejoinRequest->update([
            'status' => JoinRequestStatusEnum::Accepted->value,
            'approved_at' => now()
        ]);

        // Update user onboarding status
        $rejoinRequest->user->update([
            'user_onboarding' => true,
            'role' => 'user'
        ]);

        // Attach user to company
        $rejoinRequest->user->companies()->attach($rejoinRequest->company_id, ['role' => 'member']);


        // Send notification to user


        // Show success
        Toaster::success("Request approved successfully!");

        return redirect()->route('company.join-requests');
    }

    public function reject(int $id)
    {
        $rejoinRequest = JoinRequest::findOrFail($id);

        // Update status
        $rejoinRequest->update([
            'status' => JoinRequestStatusEnum::Rejected->value,
            'approved_at' => now()
        ]);

        // Update user onboarding status
        $rejoinRequest->user->update([
            'user_onboarding' => true,
            'role' => 'user'
        ]);

        // Send notification to user

        // Show success
        Toaster::success("Request rejected!");

        return redirect()->route('company.join-requests');
    }

    public function render()
    {
        $joinRequests = JoinRequest::with('user')->where('company_id', auth()->user()?->getCompany()->id)
                        ->latest()
                        ->paginate(10);

        return view('livewire.company.join-requests', compact('joinRequests'))
                ->layout('layouts.site');
    }
}
