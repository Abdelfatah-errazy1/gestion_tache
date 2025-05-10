<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskFeedbackGivenNotification extends Notification
{
    use Queueable;
    protected $task;
    protected $feedback;

    public function __construct($task, $feedback)
    {
        $this->task = $task;
        $this->feedback = $feedback;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Feedback Received on Task')
            ->line('You have received feedback on the task "' . $this->task->title . '".')
            ->line('Feedback: ' . $this->feedback)
            ->action('View Task', url('/tasks/' . $this->task->id));
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Feedback Received',
            'message' => 'You have received feedback on the task "' . $this->task->title . '".',
            'task_id' => $this->task->id,
            'url' => url('/tasks/' . $this->task->id),
        ];
    }
}
