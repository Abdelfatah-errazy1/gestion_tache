<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskCommentAddedNotification extends Notification
{
    use Queueable;

    protected $task;
    protected $comment;

    public function __construct($task, $comment)
    {
        $this->task = $task;
        $this->comment = $comment;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Comment on Task')
            ->line('A new comment has been added to the task "' . $this->task->title . '".')
            ->line('Comment: ' . $this->comment)
            ->action('View Task', url('/tasks/' . $this->task->id));
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'New Comment Added',
            'message' => 'A new comment has been added to the task "' . $this->task->title . '".',
            'task_id' => $this->task->id,
            'url' => url('/tasks/' . $this->task->id),
        ];
    }
}
