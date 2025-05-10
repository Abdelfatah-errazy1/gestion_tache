<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskCompletedNotification extends Notification
{
    use Queueable;

    protected $task;

    public function __construct($task)
    {
        $this->task = $task;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Task Completed')
            ->line('The task "' . $this->task->titre . '" has been marked as completed.')
            ->action('View Task', url('/taches/' . $this->task->id));
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Task Completed',
            'message' => 'The task "' . $this->task->titre . '" has been completed.',
            'task_id' => $this->task->id,
            'url' => url('/taches/' . $this->task->id),
        ];
    }
}
