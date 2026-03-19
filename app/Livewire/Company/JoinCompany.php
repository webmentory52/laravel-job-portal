<?php

namespace App\Livewire\Company;

use App\Library\Enums\JoinRequestStatusEnum;
use App\Models\Company;
use App\Models\JoinRequest;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class JoinCompany extends Component
{
    public $companies = [];

    public $companyId = "";

    public function mount()
    {
        $this->companies = Company::all()
            ->map(fn($item) => ['id' => $item->id, 'name' => $item->company_name])
            ->toArray();
    }

    public function join()
    {
        if(!$this->companyId) {
            Toaster::error("Please select company!");
            return;
        }

        // Check if there any join requests
        if(JoinRequest::where('user_id', auth()->id)
            ->where('company_id', $this->company_id)
            ->where('status', JoinRequestStatusEnum::Pending->value)->exists()) {

            Toaster::error("You already sent a request before!");
            return;
        }

        // Create the request
        JoinRequest::create([
            'company_id' => $this->companyId,
            'user_id' => auth()->id(),
            'status' => JoinRequestStatusEnum::Pending->value
        ]);

        // Notify company admins

        // dispatch event
        $this->dispatch("join-request-sent", $this->companyId);
    }

    public function render()
    {
        return view('livewire.company.join-company');
    }
}
