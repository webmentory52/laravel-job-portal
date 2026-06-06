<?php

namespace App\Library\Traits;

use App\Library\Enums\JobStatusEnum;
use App\Models\CandidateJob;
use App\Models\User;
use App\Notifications\JobExpiredNotification;
use Flux\Flux;
use Livewire\Attributes\On;
use Masmerise\Toaster\Toaster;

trait JobActionsTrait
{
    public $removeJobId;

    public $expiredJob;

    public $bulkAction = "";

    public $bulkActionIds = [];

    public $redirectTo = "";

    public function showRemoveModal($id)
    {
        $this->removeJobId = $id;

        Flux::modal('remove-job-modal')->show();
    }

    public function removeJob()
    {
        if(!$this->removeJobId) {
            return;
        }

        $job = CandidateJob::find($this->removeJobId);

        // Delete
        $job->delete();

        Toaster::success("Job removed successfully.");

        $this->removeJobId = null;

        Flux::modal('remove-job-modal')->close();

        //$this->redirectRoute($this->redirectTo, navigate: true);
    }

    public function openExpireModal($jobId)
    {
        $this->expiredJob = CandidateJob::find($jobId);

        Flux::modal('expire-job-modal')->show();
    }

    public function expireJob()
    {
        if(!$this->expiredJob) {
            return;
        }

        // Update status
        $this->expiredJob->status = JobStatusEnum::Expired->value;
        $this->expiredJob->save();

        // Notify admins
        User::admin()->get()
            ->each(fn($admin) => $admin->notify(new JobExpiredNotification(
                candidateJob: $this->expiredJob,
                title: 'Job Expired by Company',
                body: "Job '{$this->expiredJob->title}' expired by {$this->expiredJob->company->company_name}.",
                clickUrl: route('admin.jobs.index')
            )));

        Toaster::success("Job status marked expired.");

        Flux::modal('expire-job-modal')->close();

        $this->expiredJob = null;

        //$this->redirectRoute($this->redirectTo, navigate: true);
    }

    private function closeBulkModal()
    {
        Flux::modal('bulk-action-modal')->close();
    }

    #[On('bulk-action')]
    public function onBulkAction($action, $ids)
    {
        $this->bulkAction = $action;
        $this->bulkActionIds = $ids;

        Flux::modal('bulk-action-modal')->show();
    }

    public function processBulkAction()
    {
        if(!$this->bulkAction || !$this->bulkActionIds) {
            return;
        }

        switch ($this->bulkAction) {
            case 'delete_all':
                $this->deleteAll();
                break;

            case 'expire_all':
                $this->expireAll();
                break;
        }
    }

    public function deleteAll()
    {
        CandidateJob::whereIn('id', $this->bulkActionIds)->delete();

        Toaster::success("Jobs deleted successfully.");

        $this->closeBulkModal();

        $this->reset(["bulkAction", "bulkActionIds"]);

        //$this->redirectRoute($this->redirectTo, navigate: true);
    }

    public function expireAll()
    {
        CandidateJob::whereIn('id', $this->bulkActionIds)->update([
            'status' => JobStatusEnum::Expired->value
        ]);

        Toaster::success("Jobs marked as expired.");

        $this->closeBulkModal();
        $this->reset(["bulkAction", "bulkActionIds"]);

        //$this->redirectRoute($this->redirectTo, navigate: true);
    }
}
