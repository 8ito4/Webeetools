<?php

namespace App\Http\Controllers\PlanningPoker;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanningPoker\CreateRoomRequest;
use App\Http\Requests\PlanningPoker\JoinRoomRequest;
use App\Http\Requests\PlanningPoker\AddTaskRequest;
use App\Http\Requests\PlanningPoker\SelectCardRequest;
use App\Http\Requests\PlanningPoker\SetTimerRequest;
use App\Services\PlanningPoker\PlanningPokerService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class PlanningPokerController extends Controller
{
    public function __construct(
        private PlanningPokerService $planningPokerService
    ) {}

    public function index(): View
    {
        return view('planning-poker.index');
    }

    public function createRoom(CreateRoomRequest $request): RedirectResponse
    {
        try {
            $validatedData = $request->validated();
            $roomCode = $this->planningPokerService->createRoom($validatedData['name']);
            
            $this->planningPokerService->addTask($roomCode, $validatedData['task']);
            
            session([
                'planning_poker_name' => $validatedData['name'],
                'planning_poker_code' => $roomCode
            ]);

            return redirect()->route('planning-poker.room', $roomCode);

        } catch (\Throwable $e) {
            Log::error('Erro ao criar sala do Planning Poker', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->validated()
            ]);

            return redirect()->route('planning-poker.index')
                ->withErrors(['error' => 'Erro ao criar sala. Tente novamente.']);
        }
    }

    public function joinRoom(Request $request): RedirectResponse|View
    {
        try {
            if ($request->isMethod('get')) {
                return $this->handleJoinRoomGet($request);
            }

            return $this->handleJoinRoomPost($request);

        } catch (\Throwable $e) {
            Log::error('Erro ao entrar na sala do Planning Poker', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('planning-poker.index')
                ->withErrors(['error' => 'Erro ao entrar na sala. Tente novamente.']);
        }
    }

    public function room(string $roomCode, Request $request): View|RedirectResponse
    {
        try {
            $room = $this->planningPokerService->getRoom($roomCode);
            $userName = session('planning_poker_name');
            $showNameModal = $request->query('show_name_modal', false);

            if (!$userName && !$showNameModal) {
                return redirect()->route('planning-poker.room', [
                    'code' => $roomCode,
                    'show_name_modal' => true
                ]);
            }

            if (!$room) {
                return redirect()->route('planning-poker.index')
                    ->withErrors(['code' => 'Acesso negado à sala.']);
            }

            $roomData = $this->buildRoomViewData($roomCode, $room, $userName, $showNameModal);

            return view('planning-poker.room', $roomData);

        } catch (\Throwable $e) {
            Log::error('Erro ao acessar sala do Planning Poker', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'room_code' => $roomCode
            ]);

            return redirect()->route('planning-poker.index')
                ->withErrors(['error' => 'Erro ao acessar sala.']);
        }
    }

    public function selectCard(string $roomCode, SelectCardRequest $request): RedirectResponse
    {
        try {
            $validatedData = $request->validated();
            $userName = session('planning_poker_name');
            
            $this->planningPokerService->setVotePending($roomCode, $userName, $validatedData['card']);

            return redirect()->route('planning-poker.room', $roomCode);

        } catch (\Throwable $e) {
            Log::error('Erro ao selecionar carta no Planning Poker', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'room_code' => $roomCode,
                'user' => session('planning_poker_name')
            ]);

            return redirect()->route('planning-poker.room', $roomCode)
                ->withErrors(['error' => 'Erro ao selecionar carta.']);
        }
    }

    public function vote(string $roomCode): RedirectResponse
    {
        try {
            $userName = session('planning_poker_name');
            $this->planningPokerService->confirmVote($roomCode, $userName);

            return redirect()->route('planning-poker.room', $roomCode);

        } catch (\Throwable $e) {
            Log::error('Erro ao confirmar voto no Planning Poker', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'room_code' => $roomCode,
                'user' => session('planning_poker_name')
            ]);

            return redirect()->route('planning-poker.room', $roomCode)
                ->withErrors(['error' => 'Erro ao confirmar voto.']);
        }
    }

    public function endVoting(string $roomCode): RedirectResponse
    {
        try {
            $this->planningPokerService->revealVotesAndAverage($roomCode);

            return redirect()->route('planning-poker.room', $roomCode);

        } catch (\Throwable $e) {
            Log::error('Erro ao finalizar votação no Planning Poker', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'room_code' => $roomCode
            ]);

            return redirect()->route('planning-poker.room', $roomCode)
                ->withErrors(['error' => 'Erro ao finalizar votação.']);
        }
    }

    public function addTask(string $roomCode, AddTaskRequest $request): RedirectResponse
    {
        try {
            $validatedData = $request->validated();
            
            $this->planningPokerService->addTask($roomCode, $validatedData['task']);
            $this->planningPokerService->resetVotes($roomCode);

            return redirect()->route('planning-poker.room', $roomCode);

        } catch (\Throwable $e) {
            Log::error('Erro ao adicionar tarefa no Planning Poker', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'room_code' => $roomCode,
                'input' => $request->validated()
            ]);

            return redirect()->route('planning-poker.room', $roomCode)
                ->withErrors(['error' => 'Erro ao adicionar tarefa.']);
        }
    }

    private function handleJoinRoomGet(Request $request): RedirectResponse
    {
        $roomCode = $request->query('code');
        
        if (!$roomCode) {
            return redirect()->route('planning-poker.index');
        }

        $room = $this->planningPokerService->getRoom($roomCode);
        
        if (!$room) {
            return redirect()->route('planning-poker.index')
                ->withErrors(['code' => 'Código de sala inválido.']);
        }

        return redirect()->route('planning-poker.room', [
            'code' => $roomCode,
            'show_name_modal' => true
        ]);
    }

    private function handleJoinRoomPost(Request $request): RedirectResponse
    {
        $joinRequest = app(JoinRoomRequest::class);
        $validatedData = $joinRequest->validated();
        
        $success = $this->planningPokerService->joinRoom(
            $validatedData['code'],
            $validatedData['name']
        );

        if (!$success) {
            return redirect()->route('planning-poker.index')
                ->withErrors(['code' => 'Código de sala inválido.']);
        }

        session([
            'planning_poker_name' => $validatedData['name'],
            'planning_poker_code' => $validatedData['code']
        ]);

        return redirect()->route('planning-poker.room', $validatedData['code']);
    }

    private function buildRoomViewData(string $roomCode, array $room, ?string $userName, bool $showNameModal): array
    {
        $timer = $this->planningPokerService->getTimer($roomCode);
        $history = $this->planningPokerService->getHistory($roomCode);
        $average = $this->planningPokerService->getAverage($roomCode);

        return [
            'room' => $room,
            'code' => $roomCode,
            'name' => $userName,
            'isOwner' => $room['owner'] === $userName,
            'timer' => $timer,
            'history' => $history,
            'average' => $average,
            'showNameModal' => $showNameModal
        ];
    }
} 