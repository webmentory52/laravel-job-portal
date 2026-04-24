<?php

namespace App\Notifications;

use App\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;

class NewJobApplicationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public JobApplication $jobApplication)
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
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $mail = (new MailMessage)
            ->subject('New Job Application')
            ->greeting('Hello Job Owner,')
            ->line("A new application has been submitted for the job: {$this->jobApplication->candidateJob->title}")
            ->line(new HtmlString("<strong>Applicant:</strong> {$this->jobApplication->user->name} ({$this->jobApplication->user->email})"))
            ->line(new HtmlString("<strong>Phone:</strong> " . $this->jobApplication->phone))
            ->action('View All Applications', route('company.applications'));

        if($this->jobApplication->resume && Storage::exists($this->jobApplication->resume)) {
            $mail->attach(
                Storage::path($this->jobApplication->resume),
                [
                    'as' => 'Resume.' . pathinfo($this->jobApplication->resume, PATHINFO_EXTENSION),
                    'mime' => Storage::mimeType($this->jobApplication->resume),
                ]
            );
        }

        return $mail;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
