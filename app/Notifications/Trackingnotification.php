<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class Trackingnotification extends Notification
{
    use Queueable;

    protected $id;
    protected $subject;
    protected $from_user;
    protected $user_image;
    /**
     * Create a new notification instance.
     */
    public function __construct($Tracking_id,$Tracking_subject,$from_user,$user_image)
    {
        $this->id=$Tracking_id;
        $this->subject=$Tracking_subject;
        $this->from_user=$from_user;
        $this->user_image=$user_image;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    public function toDatabase(object $notifiable): array
    {
        return  [
            'id'=>$this->id,
            'subject'=>$this->subject,
            'from_user'=>$this->from_user,
            'user_image'=>$this->user_image,
            'date'=>now(),
        ];
    }

    public function toBroadcast(object $notifiable)
    {
        return new BroadcastMessage([
            'id'=>$this->id,
            'subject'=>$this->subject,
            'from_user'=>$this->from_user,
            'user_image'=>$this->$user_image,
        ]);
    }

}
