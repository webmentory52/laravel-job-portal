<?php

namespace App\Notifications;

use App\Models\CandidateJob;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class JobUpdatedApproval extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $title, string $message, ?string $clickUrl, public CandidateJob $job)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("Job Updated")
            ->line("The job submitted by {$this->job->company->company_name} was updated.")
            ->line("Job Title: {$this->job->title}")
            ->action('View Job', route('admin.jobs.form', $this->job->id))
            ->line('Please review it.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'job_id' => $this->job->id,
            'title' => $this->job->title,
            'company' => $this->job->company->company_name,
            'created_at' => now()
        ];
    }
}
