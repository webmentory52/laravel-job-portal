<?php

namespace App\Livewire\Company;

use App\Library\Enums\JoinRequestStatusEnum;
use App\Models\JoinRequest;
use App\Notifications\JoinRequestApproved;
use App\Notifications\JoinRequestRejected;
use Livewire\Attributes\Title;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Title('Join Requests')]
class JoinRequests extends Component
{

    public function approve(int $id)
    {
        $joinRequest = JoinRequest::findOrFail($id);

        // Update status
        $joinRequest->update([
            'status' => JoinRequestStatusEnum::Accepted->value,
            'approved_at' => now()
        ]);

        // Update user onboarding status
        $joinRequest->user->update([
            'user_onboarding' => true,
            'role' => 'user'
        ]);

        // Attach user to company
        $joinRequest->user->companies()->attach($joinRequest->company_id, ['role' => 'member']);


        // Send notification to user
        $joinRequest->user->notify(new JoinRequestApproved($joinRequest->company));

        // Show success
        Toaster::success("Request approved successfully!");

        return redirect()->route('company.join-requests');
    }

    public function reject(int $id)
    {
        $joinRequest = JoinRequest::findOrFail($id);

        // Update status
        $joinRequest->update([
            'status' => JoinRequestStatusEnum::Rejected->value,
            'rejected_at' => now()
        ]);

        // Update user onboarding status
        $joinRequest->user->update([
            'user_onboarding' => true,
            'role' => 'user'
        ]);

        // Send notification to user
        $joinRequest->user->notify(new JoinRequestRejected($joinRequest->company));

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
