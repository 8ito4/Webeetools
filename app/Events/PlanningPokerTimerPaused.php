<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PlanningPokerTimerPaused implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $roomCode;
    public $paused;

    public function __construct(string $roomCode, bool $paused)
    {
        $this->roomCode = $roomCode;
        $this->paused = $paused;
    }

    public function broadcastOn()
    {
        return new Channel('planning-poker.' . $this->roomCode);
    }

    public function broadcastAs()
    {
        return 'timer-paused';
    }
} 