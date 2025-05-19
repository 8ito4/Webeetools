                        <input type="number" id="minutes" name="minutes" placeholder="Tempo em minutos" class="text-xl border-none focus:ring-transparent text-center text-blue-700 placeholder-blue-700 font-bold bg-transparent" value="{{ session('pomodoro.minutes', 25) }}">
    <div id="timer-display" class="text-blue-800 text-6xl font-bold text-center mb-4"></div>
    <button id="start-timer" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mx-2">Iniciar</button>
    <button id="stop-timer" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded mx-2" style="display: none;">Parar</button>
    <button id="reset-timer" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded mx-2" style="display: none;">Resetar</button> 