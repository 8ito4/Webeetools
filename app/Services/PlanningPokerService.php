<?php

namespace App\Services;

use App\Repositories\PlanningPokerRepository;

class PlanningPokerService
{
    protected $repository;

    public function __construct(PlanningPokerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createRoom($ownerName)
    {
        return $this->repository->createRoom($ownerName);
    }

    public function joinRoom($code, $name)
    {
        return $this->repository->joinRoom($code, $name);
    }

    public function getRoom($code)
    {
        return $this->repository->getRoom($code);
    }

    public function addTask($code, $task)
    {
        return $this->repository->addTask($code, $task);
    }

    public function vote($code, $name, $vote)
    {
        return $this->repository->vote($code, $name, $vote);
    }

    public function revealVotes($code)
    {
        return $this->repository->revealVotes($code);
    }

    public function resetVotes($code)
    {
        return $this->repository->resetVotes($code);
    }

    public function setTimer($code, $seconds)
    {
        return $this->repository->setTimer($code, $seconds);
    }

    public function getTimer($code)
    {
        return $this->repository->getTimer($code);
    }

    public function nextTask($code)
    {
        return $this->repository->nextTask($code);
    }

    public function addToHistory($code, $task, $votes)
    {
        return $this->repository->addToHistory($code, $task, $votes);
    }

    public function getHistory($code)
    {
        return $this->repository->getHistory($code);
    }

    public function setVotePending($code, $name, $card)
    {
        return $this->repository->setVotePending($code, $name, $card);
    }

    public function confirmVote($code, $name)
    {
        return $this->repository->confirmVote($code, $name);
    }

    public function revealVotesAndAverage($code)
    {
        return $this->repository->revealVotesAndAverage($code);
    }

    public function getAverage($code)
    {
        return $this->repository->getAverage($code);
    }

} 