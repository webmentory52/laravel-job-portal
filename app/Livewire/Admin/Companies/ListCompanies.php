<?php

namespace App\Livewire\Admin\Companies;

use App\Mail\AdminCompanyMessageMail;
use App\Models\Company;
use Flux\Flux;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

#[Title('Companies | Admin')]
class ListCompanies extends Component
{
    use WithPagination;

    #[Url]
    public string $search = "";

    public $viewedCompany = null;

    public $sendToCompany = null;

    public string $message = "";

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function viewCompany(int $id)
    {
        $this->viewedCompany = Company::find($id);
    }

    public function openSendMail(int $id)
    {
        $this->sendToCompany = Company::find($id);
    }

    public function send()
    {
        if(!$this->sendToCompany) return;

        // validate
        $this->validate([
            'message' => 'required|string|min:10'
        ]);

        // send mail
        Mail::to($this->sendToCompany->email)
                ->send(new AdminCompanyMessageMail($this->sendToCompany, $this->message));

        Toaster::info('Email is being sent.');

        $this->reset(['sendToCompany', 'message']);

        Flux::modal('send-email')->close();
    }

    public function destroy(Company $company)
    {
        if($company->logo && Storage::disk('public')->exists($company->logo)) {
            Storage::disk('public')->delete($company->logo);
        }

        $company->delete();

        Toaster::success('Company deleted successfully.');
    }

    public function render()
    {
        $companies = Company::query();

        $companies->when($this->search, fn($q, $search) => $q->whereLike('company_name', '%'.$search.'%'));

        $companies = $companies->latest()
                            ->paginate(20);

        return view('livewire.admin.companies.list-companies', compact('companies'));
    }
}
