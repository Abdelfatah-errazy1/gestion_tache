<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskAssignedNotification extends Notification
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
            ->subject('New Task Assigned')
            ->line('You have been assigned a new task: ' . $this->task->titre)
            ->action('View Task', url('/tasks/' . $this->task->id))
            ->line('Please review the task details.');
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Task Assigned',
            'message' => 'You have been assigned a new task: ' . $this->task->titre,
            'task_id' => $this->task->id,
            'url' => url('/tasks/' . $this->task->id),
        ];
    }
}
