<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PrivateTest implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    // public $user;
    public $id;
    public $subject;
    public $from_user;
    public $to_user_id;
    /**
     * Create a new event instance.
     */
    public function __construct($Tracking_id,$Tracking_subject,$to_user_id,$from_user)
    {
        $this->id=$Tracking_id;
        $this->subject=$Tracking_subject;
        $this->from_user=$from_user;
        $this->to_user_id=$to_user_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('privat-test-'.$this->to_user_id),
        ];
    }
    public function broadcastWith()
    {
        return [
            'id'=>$this->id,
            'subject'=>$this->subject,
            'user'=>$this->from_user,
            'date'=>now(),
        ];
    }
}
