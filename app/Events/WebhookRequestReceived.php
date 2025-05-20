<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WebhookRequestReceived implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $request;
    public $webhookToken;

    public function __construct(array $request, string $webhookToken)
    {
        $this->request = $request;
        $this->webhookToken = $webhookToken;
    }

    public function broadcastOn()
    {
        return new Channel('webhook.' . $this->webhookToken);
    }

    public function broadcastAs()
    {
        return 'new-request';
    }
} 