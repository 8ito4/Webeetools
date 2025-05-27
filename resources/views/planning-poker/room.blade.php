@extends('layouts.app')

@section('title', 'Sala Planning Poker')

@section('content')
<div class="flex flex-col lg:flex-row gap-8 max-w-6xl mx-auto mt-10">
    <div class="flex-1 flex flex-col items-center">
        <h2 class="text-gray-900 text-2xl font-bold mb-6 mt-2">{{ $room['current_task'] ?? 'Sem tarefa selecionada' }}</h2>
        @if($room['revealed'] ?? false)
            <div class="flex flex-col items-center justify-center mb-8">
                <span class="text-5xl font-bold text-indigo-700">{{ $average !== null ? $average : '—' }}</span>
                <span class="text-lg text-gray-600 mt-2">Média dos votos</span>
            </div>
        @else
            <form method="POST" action="{{ route('planning-poker.selectCard', $code) }}" id="cardForm">
                @csrf
                <div class="grid grid-cols-4 gap-6 mb-6">
                    @php $cards = ['0','½','1','2','3','5','8','13','20','40','100','?','☕'];
                    $selected = $room['participants'][$name]['pending_vote'] ?? null;
                    $voted = $room['participants'][$name]['vote'] ?? null;
                    $timerEnded = $timer && $timer['remaining'] === 0;
                    @endphp
                    @foreach($cards as $card)
                        <button type="submit" name="card" value="{{ $card }}" class="w-32 h-44 bg-white border {{ $selected == $card ? 'border-indigo-500 ring-2 ring-indigo-300' : 'border-gray-300' }} rounded-lg flex flex-col items-center justify-center text-4xl text-gray-900 font-mono shadow-lg hover:border-indigo-400 focus:border-indigo-500 transition mb-2 {{ $timerEnded ? 'opacity-50 pointer-events-none' : '' }}" {{ $timerEnded ? 'disabled' : '' }}>
                            <span>{{ $card }}</span>
                        </button>
                    @endforeach
                </div>
            </form>
            <form method="POST" action="{{ route('planning-poker.vote', $code) }}">
                @csrf
                <button type="submit" class="w-64 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded transition text-lg {{ $timerEnded ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}" {{ !$selected || $voted || $timerEnded ? 'disabled' : '' }}>Votar</button>
            </form>
        @endif
    </div>
    <div class="w-full lg:w-96 bg-white rounded-lg shadow-lg p-6 flex flex-col gap-6">
        <div class="flex items-center justify-between mb-4">
            <div class="text-lg text-gray-900 font-semibold">Código da sala:</div>
            <div class="flex items-center gap-2">
                <span id="roomCode" class="font-mono text-xl bg-gray-100 px-3 py-1 rounded text-gray-900">{{ $code }}</span>
                <button onclick="copyRoomCode()" class="p-1 rounded hover:bg-gray-200 transition" title="Copiar código da sala">
                    <i class="far fa-copy text-gray-700"></i>
                </button>
                <button onclick="shareRoomLink()" class="p-1 rounded hover:bg-gray-200 transition" title="Compartilhar link da sala">
                    <i class="fas fa-share-alt text-indigo-600"></i>
                </button>
            </div>
        </div>
        @if($isOwner)
        <form method="POST" action="{{ route('planning-poker.set-timer', $code) }}" class="flex gap-2 mb-2 items-center">
            @csrf
            <input type="number" name="minutes" min="1" max="60" required pattern="[0-9]*" inputmode="numeric" 
                class="w-48 rounded bg-gray-100 text-gray-900 border-gray-300 px-4 py-2 text-center text-lg" 
                placeholder="Digite o tempo">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-2 rounded transition text-lg" id="startBtn">Iniciar</button>
        </form>
        <div class="flex gap-2 mb-4">
            <form method="POST" action="{{ route('planning-poker.reset-timer', $code) }}">
                @csrf
                <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold px-4 py-2 rounded transition">Reiniciar</button>
            </form>
            <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold px-4 py-2 rounded transition" id="pauseBtn">Pausar</button>
        </div>
        @if($timer && $timer['remaining'] > 0)
        <div class="flex items-center gap-2 mb-4">
            <span class="text-gray-500">⏰</span>
            <span id="timerDisplay" class="font-mono text-2xl px-3 py-1 rounded bg-gray-100 text-gray-900">{{ $timer ? gmdate('i:s', $timer['remaining']) : '05:00' }}</span>
        </div>
        @endif
        <button type="button" onclick="openTaskModal()" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 rounded transition mb-4">Criar nova discussão</button>
        <div id="modal-task" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-8 shadow-lg w-80 flex flex-col gap-4">
                <h2 class="text-xl font-bold text-green-700 mb-2">Nova Discussão</h2>
                <form method="POST" action="{{ route('planning-poker.addTask', $code) }}" class="flex flex-col gap-4">
                    @csrf
                    <input type="text" name="task" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 px-3 py-2" placeholder="Nome da nova discussão">
                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 rounded transition">Criar</button>
                </form>
                <button type="button" onclick="closeTaskModal()" class="text-gray-500 hover:text-gray-700 mt-2">Cancelar</button>
            </div>
        </div>
        <div class="flex flex-col gap-2 mb-4">
            <form method="POST" action="{{ route('planning-poker.reset', $code) }}" class="inline">
                @csrf
                <button type="submit" class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 rounded transition mb-2">Reiniciar Votação</button>
            </form>
            <form method="POST" action="{{ route('planning-poker.endVoting', $code) }}" class="inline">
                @csrf
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 rounded transition">Encerrar Votação</button>
            </form>
        </div>
        @endif
        <div class="mt-4">
            <div class="text-gray-700 font-semibold mb-1">Participantes:</div>
            <ul class="space-y-2">
                @foreach($room['participants'] as $pName => $p)
                    <li class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full {{ $p['vote'] ? 'bg-green-400' : 'bg-gray-300' }} inline-block"></span>
                        <span class="text-gray-900 font-semibold {{ $p['vote'] ? 'underline text-green-700' : '' }}">{{ $pName }}</span>
                        @if($p['vote'])
                            <i class="fas fa-check text-green-600"></i>
                            @if($isOwner)
                                <span class="ml-1 font-mono text-indigo-700">{{ $p['vote'] }}</span>
                            @endif
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
        @if($isOwner && count($history))
        <div class="max-w-2xl mx-auto mt-12 bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Histórico de Tarefas</h3>
            <ul class="space-y-3">
                @foreach(array_reverse($history) as $h)
                    <li class="border-b pb-2">
                        <div class="font-semibold text-gray-700">{{ $h['task'] }}</div>
                        <div class="flex flex-wrap gap-2 mt-1">
                            @foreach($h['votes'] as $user => $vote)
                                <span class="px-2 py-1 rounded bg-gray-100 text-gray-800 text-sm">{{ $user }}: <span class="font-mono">{{ $vote }}</span></span>
                            @endforeach
                        </div>
                        <div class="text-xs text-gray-400 mt-1">{{ \Carbon\Carbon::parse($h['at'])->diffForHumans() }}</div>
                    </li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>

<div id="modal-name" class="{{ $showNameModal ? '' : 'hidden' }} fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-8 shadow-lg w-80 flex flex-col gap-4">
        <h2 class="text-xl font-bold text-indigo-700 mb-2">Bem-vindo à Sala!</h2>
        <form method="POST" action="{{ route('planning-poker.join') }}" class="flex flex-col gap-4">
            @csrf
            <input type="hidden" name="code" value="{{ $code }}">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Seu nome</label>
                <input type="text" name="name" id="name" required 
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 px-3 py-2"
                    placeholder="Digite seu nome">
            </div>
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 rounded transition">Entrar na Sala</button>
        </form>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="https://unpkg.com/ztext@latest/dist/ztext.min.js"></script>
<script>
const pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
    cluster: '{{ config('broadcasting.connections.pusher.options.cluster') }}'
});

const channel = pusher.subscribe('planning-poker.{{ $code }}');

let remaining = {{ $timer && $timer['remaining'] > 0 ? $timer['remaining'] : 0 }};
let paused = false;
let timerInterval = null;
const timerDisplay = document.getElementById('timerDisplay');
const pauseBtn = document.getElementById('pauseBtn');

function updateTimer() {
    if (!paused && remaining > 0) {
        let min = String(Math.floor(remaining / 60)).padStart(2, '0');
        let sec = String(remaining % 60).padStart(2, '0');
        timerDisplay.textContent = `${min}:${sec}`;
        if (remaining <= 10) {
            timerDisplay.classList.add('bg-red-100', 'text-red-700');
        } else {
            timerDisplay.classList.remove('bg-red-100', 'text-red-700');
        }
        if (remaining > 0) remaining--;
    }
}

function startTimer(duration) {
    if (timerInterval) clearInterval(timerInterval);
    remaining = duration;
    paused = false;
    updateTimer();
    timerInterval = setInterval(updateTimer, 1000);
}

if (remaining > 0) {
    startTimer(remaining);
}

pauseBtn && (pauseBtn.onclick = function() {
    paused = !paused;
    pauseBtn.textContent = paused ? 'Continuar' : 'Pausar';
});

channel.bind('timer-started', function(data) {
    startTimer(data.duration);
});

channel.bind('timer-paused', function(data) {
    paused = data.paused;
    pauseBtn.textContent = paused ? 'Continuar' : 'Pausar';
});

channel.bind('timer-reset', function(data) {
    startTimer(data.duration);
});

channel.bind('vote-received', function(data) {
    location.reload();
});

channel.bind('votes-revealed', function(data) {
    location.reload();
});

channel.bind('votes-reset', function(data) {
    location.reload();
});

channel.bind('new-task', function(data) {
    location.reload();
});

function copyRoomCode() {
    const code = document.getElementById('roomCode');
    navigator.clipboard.writeText(code.textContent);
    
    const button = code.nextElementSibling;
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-check text-green-600"></i>';
    setTimeout(() => {
        button.innerHTML = originalText;
    }, 2000);
}

function shareRoomLink() {
    const url = window.location.href;
    navigator.clipboard.writeText(url);
    
    const button = document.querySelector('[title="Compartilhar link da sala"]');
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-check text-green-600"></i>';
    setTimeout(() => {
        button.innerHTML = originalText;
    }, 2000);
}

function openTaskModal() {
    document.getElementById('modal-task').classList.remove('hidden');
}

function closeTaskModal() {
    document.getElementById('modal-task').classList.add('hidden');
}

function openChangeNameModal() {
    document.getElementById('modal-change-name').classList.remove('hidden');
}

function closeChangeNameModal() {
    document.getElementById('modal-change-name').classList.add('hidden');
}
</script>
@endpush
@endsection 