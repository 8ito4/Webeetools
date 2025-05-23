<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PlanningPokerService;

class PlanningPokerController extends Controller
{
    protected $service;

    public function __construct(PlanningPokerService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return view('planning-poker.index');
    }

    public function createRoom(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'task' => 'required|string|max:255',
        ]);
        $name = $request->input('name');
        $task = $request->input('task');
        $code = $this->service->createRoom($name);
        $this->service->addTask($code, $task);
        session(['planning_poker_name' => $name, 'planning_poker_code' => $code]);
        return redirect()->route('planning-poker.room', $code);
    }

    public function joinRoom(Request $request)
    {
        if ($request->isMethod('get')) {
            $code = $request->query('code');
            if (!$code) {
                return redirect()->route('planning-poker.index');
            }

            // Verifica se a sala existe
            $room = $this->service->getRoom($code);
            if (!$room) {
                return redirect()->route('planning-poker.index')->withErrors(['code' => 'Código de sala inválido.']);
            }

            // Redireciona para a sala com o modal de nome
            return redirect()->route('planning-poker.room', ['code' => $code, 'show_name_modal' => true]);
        }

        $request->validate([
            'name' => 'required|string|max:50',
            'code' => 'required|string|size:6',
        ]);
        $name = $request->input('name');
        $code = $request->input('code');
        if (!$this->service->joinRoom($code, $name)) {
            return redirect()->route('planning-poker.index')->withErrors(['code' => 'Código de sala inválido.']);
        }
        session(['planning_poker_name' => $name, 'planning_poker_code' => $code]);
        return redirect()->route('planning-poker.room', $code);
    }

    public function room($code, Request $request)
    {
        $room = $this->service->getRoom($code);
        $name = session('planning_poker_name');
        $showNameModal = $request->query('show_name_modal', false);

        // Se não tem nome na sessão e não está mostrando o modal, redireciona para mostrar o modal
        if (!$name && !$showNameModal) {
            return redirect()->route('planning-poker.room', ['code' => $code, 'show_name_modal' => true]);
        }

        if (!$room) {
            return redirect()->route('planning-poker.index')->withErrors(['code' => 'Acesso negado à sala.']);
        }

        $timer = $this->service->getTimer($code);
        $history = $this->service->getHistory($code);
        $average = $this->service->getAverage($code);
        return view('planning-poker.room', [
            'room' => $room,
            'code' => $code,
            'name' => $name,
            'isOwner' => $room['owner'] === $name,
            'timer' => $timer,
            'history' => $history,
            'average' => $average,
            'showNameModal' => $showNameModal
        ]);
    }

    public function selectCard($code, Request $request)
    {
        $request->validate(['card' => 'required']);
        $name = session('planning_poker_name');
        $this->service->setVotePending($code, $name, $request->input('card'));
        return redirect()->route('planning-poker.room', $code);
    }

    public function vote($code, Request $request)
    {
        $name = session('planning_poker_name');
        $this->service->confirmVote($code, $name);
        return redirect()->route('planning-poker.room', $code);
    }

    public function endVoting($code, Request $request)
    {
        $this->service->revealVotesAndAverage($code);
        return redirect()->route('planning-poker.room', $code);
    }

    public function addTask($code, Request $request)
    {
        $request->validate(['task' => 'required|string|max:255']);
        $this->service->addTask($code, $request->input('task'));
        $this->service->resetVotes($code);
        return redirect()->route('planning-poker.room', $code);
    }

    public function reset($code, Request $request)
    {
        $this->service->resetVotes($code);
        return redirect()->route('planning-poker.room', $code);
    }

    public function resetTimer($code, Request $request)
    {
        $this->service->setTimer($code, 300); // 5 minutos
        return redirect()->route('planning-poker.room', $code);
    }

    public function setTimer(Request $request, $code)
    {
        $minutes = $request->input('minutes');
        $seconds = $minutes * 60;
        
        $this->service->setTimer($code, $seconds);
        
        event(new \App\Events\PlanningPokerTimerStarted($code, $seconds));
        
        return redirect()->back();
    }

    public function reveal($code, Request $request)
    {
        $room = $this->service->getRoom($code);
        if ($room && $room['current_task']) {
            $votes = collect($room['participants'])->mapWithKeys(fn($p) => [$p['name'] => $p['vote']])->toArray();
            $this->service->addToHistory($code, $room['current_task'], $votes);
            $this->service->revealVotes($code);
        }
        return redirect()->route('planning-poker.room', $code);
    }

    public function nextTask($code, Request $request)
    {
        $this->service->nextTask($code);
        return redirect()->route('planning-poker.room', $code);
    }

    public function pauseTimer($code)
    {
        $timer = $this->service->getTimer($code);
        if ($timer) {
            event(new \App\Events\PlanningPokerTimerPaused($code, true));
        }
        
        return redirect()->back();
    }
} 