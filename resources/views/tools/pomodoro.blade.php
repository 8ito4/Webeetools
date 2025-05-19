@extends('layouts.app')

@section('title', 'Pomodoro')

@section('content')
<div class="max-w-full mx-auto mt-12 bg-white p-8 rounded-lg shadow-lg flex flex-col items-center">
    <h1 class="text-3xl font-bold text-indigo-700 mb-2 flex items-center gap-2">
        <i class="fas fa-clock"></i> Pomodoro
    </h1>
    <p class="mb-6 text-gray-600 text-center">Defina o tempo desejado em minutos e aumente sua produtividade com o método Pomodoro!</p>
    <div id="pomodoro-app" class="w-full flex flex-col items-center">
        <div class="mb-6 flex flex-col items-center gap-2">
            <label for="minutesInput" class="text-gray-700 font-medium">Tempo (minutos):</label>
            <input id="minutesInput" type="number" min="1" max="180" value="25" class="rounded border-indigo-500 focus:border-indigo-700 focus:ring focus:ring-indigo-300 focus:ring-opacity-50 px-4 py-3 w-40 text-center text-xl font-mono shadow-md">
        </div>
        <div class="text-9xl font-mono text-indigo-700 mb-6 w-full text-center" id="timerDisplay">25:00</div>
        <div class="flex gap-4 mb-4">
            <button id="startBtn" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition">Iniciar</button>
            <button id="pauseBtn" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition">Pausar</button>
            <button id="resetBtn" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition">Reiniciar</button>
        </div>
    </div>
</div>
<audio id="beepSound">
    <source src="/audio/beep.mp3" type="audio/mpeg">
</audio>
<script>
    let timer;
    let running = false;
    let remaining = 25 * 60;

    const timerDisplay = document.getElementById('timerDisplay');
    const startBtn = document.getElementById('startBtn');
    const pauseBtn = document.getElementById('pauseBtn');
    const resetBtn = document.getElementById('resetBtn');
    const minutesInput = document.getElementById('minutesInput');

    function updateDisplay() {
        const min = String(Math.floor(remaining / 60)).padStart(2, '0');
        const sec = String(remaining % 60).padStart(2, '0');
        timerDisplay.textContent = `${min}:${sec}`;
    }

    function startTimer() {
        if (running) return;
        running = true;
        timer = setInterval(() => {
            if (remaining > 0) {
                remaining--;
                updateDisplay();
            } else {
                clearInterval(timer);
                running = false;
                timerDisplay.textContent = 'Fim!';
                const beep = document.getElementById('beepSound');
                beep.currentTime = 0;
                beep.volume = 1;
                beep.play().catch(e => {
                    alert('Não foi possível tocar o som. Veja o console para detalhes.');
                    console.log('Erro ao tocar o áudio:', e);
                });
            }
        }, 1000);
    }

    function pauseTimer() {
        running = false;
        clearInterval(timer);1
    }

    function resetTimer() {
        running = false;
        clearInterval(timer);
        let minutes = parseInt(minutesInput.value) || 1;
        if (minutes < 1) minutes = 1;
        if (minutes > 180) minutes = 180;
        remaining = minutes * 60;
        updateDisplay();
    }

    minutesInput.onchange = resetTimer;
    startBtn.onclick = startTimer;
    pauseBtn.onclick = pauseTimer;
    resetBtn.onclick = resetTimer;
    resetTimer();
</script>
@endsection 