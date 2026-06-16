<?php

namespace App\Notifications;

use App\Models\CandidateJob;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class JobStatusUpdated extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $title, string $body, ?string $clickUrl, public CandidateJob $candidateJob)
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
            ->subject('Job Status Updated')
            ->line("The job {$this->candidateJob->title} status has been updated to {$this->candidateJob->status} by site admin.")
            ->line("Job Title: {$this->candidateJob->title}")
            ->action('View Job', route('job-detail', $this->candidateJob->id))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'job_id' => $this->candidateJob->id,
            'title' => $this->candidateJob->title,
            'company' => $this->candidateJob->company->company_name,
            'created_at' => now()
        ];
    }
}
