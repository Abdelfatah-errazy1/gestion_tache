<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskOverdueNotification extends Notification
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
            ->subject('Task Overdue')
            ->line('The task "' . $this->task->title . '" is overdue.')
            ->action('View Task', url('/tasks/' . $this->task->id));
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Task Overdue',
            'message' => 'The task "' . $this->task->title . '" is overdue.',
            'task_id' => $this->task->id,
            'url' => url('/tasks/' . $this->task->id),
        ];
    }
}
