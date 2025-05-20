<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PlanningPokerTimerReset implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $roomCode;
    public $duration;

    public function __construct(string $roomCode, int $duration)
    {
        $this->roomCode = $roomCode;
        $this->duration = $duration;
    }

    public function broadcastOn()
    {
        return new Channel('planning-poker.' . $this->roomCode);
    }

    public function broadcastAs()
    {
        return 'timer-reset';
    }
} 