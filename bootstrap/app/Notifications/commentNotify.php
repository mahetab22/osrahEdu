<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Comment;

class commentNotify extends Notification
{
    use Queueable;
    private $comment;
    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public function __construct(comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        return[
            'id'=>  $this->comment->id,
            'title'=> $this->comment->title,
            'course_id'=> $this->comment->course_id,
            'user_id'=> $this->comment->user_id,
            'received_id'=> $this->comment->received_id,
            'conversation_id'=> $this->comment->conversation_id,
            'commentORmassage'=> $this->comment->commentORmassage,
           /* 'url'=>$this->url*/
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
