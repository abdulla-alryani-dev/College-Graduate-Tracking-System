<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewEmployerRegistration extends Notification
{
    use Queueable;

    protected $employer;

    public function __construct($employer)
    {
        $this->employer = $employer;
    }

    public function via($notifiable)
    {
        return ['database']; // Store notification in the database
    }

    public function toDatabase($notifiable)
    {
        return [
            'employer_id' => $this->employer->id,
            'employer_name' => $this->employer->name,
            'employer_email' => $this->employer->email,
            'message' => 'A new employer has registered and is awaiting approval.',
            'title' => 'New employer'
        ];
    }
}
