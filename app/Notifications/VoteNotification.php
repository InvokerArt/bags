<?php

namespace App\Notifications;

use Auth;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VoteNotification extends Notification
{
    protected $topic;

    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($topic)
    {
        //
        $this->topic = $topic;
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
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'id' => $this->topic->id,
            'title' => '互动消息',
            'message' => '有人赞了您的帖子，去查看。',
            'type' => 'App\Models\Topics\Vote',
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'user_id' => Auth::id()
        ];
    }
}
