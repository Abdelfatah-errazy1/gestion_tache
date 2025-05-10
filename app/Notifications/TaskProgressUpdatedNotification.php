<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskProgressUpdatedNotification extends Notification
{
    use Queueable;

    protected $task;
    protected $progress;

    public function __construct($task, $progress)
    {
        $this->task = $task;
        $this->progress = $progress;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Task Progress Updated')
            ->line('The progress of task "' . $this->task->titre . '" has been updated to ' . $this->progress . '%.')
            ->action('View Task', url('/tasks/' . $this->task->id));
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Task Progress Updated',
            'message' => 'The progress of task "' . $this->task->titre . '" has been updated to ' . $this->progress . '%.',
            'task_id' => $this->task->id,
            'url' => url('/tasks/' . $this->task->id),
        ];
    }
}
