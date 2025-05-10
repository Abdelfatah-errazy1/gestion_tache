<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskStatusChangedNotification extends Notification
{
    use Queueable;

    protected $task;
    protected $newStatus;

    public function __construct($task, $newStatus)
    {
        $this->task = $task;
        $this->newStatus = $newStatus;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Task Status Updated')
            ->line('The task "' . $this->task->titre . '" status changed to: ' . $this->newStatus)
            ->action('View Task', url('/tasks/' . $this->task->id));
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Task Status Updated',
            'message' => 'Task "' . $this->task->titre . '" status changed to: ' . $this->newStatus,
            'task_id' => $this->task->id,
            'url' => url('/tasks/' . $this->task->id),
        ];
    }
}
