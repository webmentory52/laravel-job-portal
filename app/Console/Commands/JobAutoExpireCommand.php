<?php

namespace App\Console\Commands;

use App\Library\Enums\JobStatusEnum;
use App\Models\CandidateJob;
use App\Notifications\JobAutoExpiredNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class JobAutoExpireCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:job-auto-expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto expire job in specific period';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Starting Job auto expire command executed");

        $candidateJobs = CandidateJob::where('status', JobStatusEnum::Approved->value)
                        ->whereNotNull('expires_at')
                        ->whereDate('expires_at', '<=', Carbon::now()->format('Y-m-d'))
                        ->get();

        if(count($candidateJobs) == 0) {
            $this->warn("No job to expire");
            return;
        }

        foreach ($candidateJobs as $job) {
            $job->update(['status' => JobStatusEnum::Expired->value]);

            $this->line("Job {$job->title} has been expired");

            // Send notification
            $companyUser = $job->company->users()->wherePivot('role', 'admin')->first();

            if($companyUser) {
                $companyUser->notify(new JobAutoExpiredNotification($job));
            }

            $job->update('expires_at', null);
        }

        $this->info("Job auto expire command executed successfully");
    }
}
