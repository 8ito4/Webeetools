<?php

namespace App\Repositories;

class PlanningPokerRepository
{
    private function getAllRooms()
    {
        return session('planning_poker_rooms', []);
    }

    private function saveAllRooms($rooms)
    {
        session(['planning_poker_rooms' => $rooms]);
    }

    public function createRoom($ownerName)
    {
        $rooms = $this->getAllRooms();
        do {
            $code = strtoupper(substr(bin2hex(random_bytes(4)), 0, 6));
        } while (isset($rooms[$code]));
        $rooms[$code] = [
            'owner' => $ownerName,
            'participants' => [
                $ownerName => ['name' => $ownerName, 'vote' => null]
            ],
            'tasks' => [],
            'current_task' => null,
            'votes' => [],
            'revealed' => false
        ];
        $this->saveAllRooms($rooms);
        return $code;
    }

    public function joinRoom($code, $name)
    {
        $rooms = $this->getAllRooms();
        if (!isset($rooms[$code])) return false;
        $rooms[$code]['participants'][$name] = ['name' => $name, 'vote' => null];
        $this->saveAllRooms($rooms);
        return true;
    }

    public function getRoom($code)
    {
        $rooms = $this->getAllRooms();
        return $rooms[$code] ?? null;
    }

    public function addTask($code, $task)
    {
        $rooms = $this->getAllRooms();
        if (!isset($rooms[$code])) return false;
        $rooms[$code]['tasks'][] = $task;
        $rooms[$code]['current_task'] = $task;
        $rooms[$code]['votes'] = [];
        $rooms[$code]['revealed'] = false;
        foreach ($rooms[$code]['participants'] as &$p) {
            $p['vote'] = null;
        }
        $this->saveAllRooms($rooms);
        return true;
    }

    public function vote($code, $name, $vote)
    {
        $rooms = $this->getAllRooms();
        if (!isset($rooms[$code])) return false;
        $rooms[$code]['participants'][$name]['vote'] = $vote;
        $this->saveAllRooms($rooms);
        return true;
    }

    public function revealVotes($code)
    {
        $rooms = $this->getAllRooms();
        if (!isset($rooms[$code])) return false;
        $rooms[$code]['revealed'] = true;
        $this->saveAllRooms($rooms);
        return true;
    }

    public function resetVotes($code)
    {
        $rooms = $this->getAllRooms();
        if (!isset($rooms[$code])) return false;
        foreach ($rooms[$code]['participants'] as &$p) {
            $p['vote'] = null;
            unset($p['pending_vote']);
        }
        $rooms[$code]['revealed'] = false;
        $this->saveAllRooms($rooms);
        return true;
    }

    public function setTimer($code, $seconds)
    {
        $rooms = $this->getAllRooms();
        if (!isset($rooms[$code])) return false;
        $rooms[$code]['timer'] = [
            'start' => time(),
            'duration' => $seconds
        ];
        $this->saveAllRooms($rooms);
        return true;
    }

    public function getTimer($code)
    {
        $rooms = $this->getAllRooms();
        if (!isset($rooms[$code]) || !isset($rooms[$code]['timer'])) return null;
        $timer = $rooms[$code]['timer'];
        $elapsed = time() - $timer['start'];
        $remaining = max(0, $timer['duration'] - $elapsed);
        return [
            'remaining' => $remaining,
            'duration' => $timer['duration'],
            'start' => $timer['start']
        ];
    }

    public function nextTask($code)
    {
        $rooms = $this->getAllRooms();
        if (!isset($rooms[$code])) return false;
        $current = $rooms[$code]['current_task'];
        $tasks = $rooms[$code]['tasks'];
        $idx = array_search($current, $tasks);
        if ($idx !== false && isset($tasks[$idx+1])) {
            $rooms[$code]['current_task'] = $tasks[$idx+1];
            $rooms[$code]['revealed'] = false;
            foreach ($rooms[$code]['participants'] as &$p) {
                $p['vote'] = null;
            }
            $this->saveAllRooms($rooms);
            return true;
        }
        return false;
    }

    public function addToHistory($code, $task, $votes)
    {
        $rooms = $this->getAllRooms();
        if (!isset($rooms[$code])) return false;
        $rooms[$code]['history'][] = [
            'task' => $task,
            'votes' => $votes,
            'at' => now()->toDateTimeString()
        ];
        $this->saveAllRooms($rooms);
        return true;
    }

    public function getHistory($code)
    {
        $rooms = $this->getAllRooms();
        return $rooms[$code]['history'] ?? [];
    }

    public function setVotePending($code, $name, $card) {
        $rooms = $this->getAllRooms();
        if (!isset($rooms[$code])) return false;
        $rooms[$code]['participants'][$name]['pending_vote'] = $card;
        $this->saveAllRooms($rooms);
        return true;
    }

    public function confirmVote($code, $name) {
        $rooms = $this->getAllRooms();
        if (!isset($rooms[$code])) return false;
        $card = $rooms[$code]['participants'][$name]['pending_vote'] ?? null;
        $rooms[$code]['participants'][$name]['vote'] = $card;
        unset($rooms[$code]['participants'][$name]['pending_vote']);
        $this->saveAllRooms($rooms);
        return true;
    }

    public function revealVotesAndAverage($code) {
        $rooms = $this->getAllRooms();
        if (!isset($rooms[$code])) return null;
        $rooms[$code]['revealed'] = true;
        // Calcular média
        $votes = array_map(fn($p) => $p['vote'], $rooms[$code]['participants']);
        $nums = array_filter($votes, fn($v) => is_numeric($v));
        $avg = null;
        if (count($nums)) {
            $media = array_sum($nums) / count($nums);
            $avg = ($media - floor($media) >= 0.5) ? round($media) : round($media * 2) / 2;
        }
        $rooms[$code]['average'] = $avg;
        $this->saveAllRooms($rooms);
        return $avg;
    }

    public function getAverage($code) {
        $rooms = $this->getAllRooms();
        return $rooms[$code]['average'] ?? null;
    }
} 