        <h1 class="text-2xl font-bold mb-4 text-blue-800" id="room-code-display">Sala: <span id="room-code">{{ $roomCode }}</span></h1>
                            <button id="create-discussion-btn" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mx-2" @click="showTaskModal = true">Criar Nova Discussão</button>
                <button id="end-voting-btn" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mx-2">Encerrar Votação</button>
    <div id="timer" class="text-blue-800 text-4xl font-bold text-center mb-4"></div>
        <a href="#" id="share-link-btn" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mx-2">Compartilhar Link</a> 