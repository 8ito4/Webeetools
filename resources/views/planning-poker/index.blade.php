@extends('layouts.app')

@section('title', 'Planning Poker')

@section('content')
<div class="max-w-md mx-auto mt-24 bg-white p-8 rounded-lg shadow-lg flex flex-col items-center">
    <h1 class="text-3xl font-bold text-indigo-700 mb-8 flex items-center gap-2">
        <i class="fas fa-layer-group"></i> Planning Poker
    </h1>
    <div class="flex gap-6 w-full justify-center">
        <button onclick="openModal('create')" class="w-40 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded transition text-lg">Criar Sala</button>
        <button onclick="openModal('join')" class="w-40 bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded transition text-lg">Entrar em Sala</button>
    </div>
    <div id="modal-create" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-8 shadow-lg w-80 flex flex-col gap-4">
            <h2 class="text-xl font-bold text-indigo-700 mb-2">Criar Sala</h2>
            <form method="POST" action="{{ route('planning-poker.create') }}" class="flex flex-col gap-4">
                @csrf
                <input type="text" name="name" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 px-3 py-2" placeholder="Digite seu nome">
                <input type="text" name="task" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 px-3 py-2" placeholder="Nome da primeira discussão">
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 px-4 rounded transition text-lg">Entrar</button>
            </form>
            <button onclick="closeModal('create')" class="text-gray-500 hover:text-gray-700 mt-2">Cancelar</button>
        </div>
    </div>
    <div id="modal-join" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-8 shadow-lg w-80 flex flex-col gap-4">
            <h2 class="text-xl font-bold text-green-700 mb-2">Entrar em Sala</h2>
            <form method="POST" action="{{ route('planning-poker.join') }}" class="flex flex-col gap-4">
                @csrf
                <input type="text" name="name" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 px-3 py-2" placeholder="Digite seu nome">
                <input type="text" name="code" id="joinCodeInput" required maxlength="6" class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 px-3 py-2" placeholder="Código da sala">
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2.5 px-4 rounded transition text-lg">Entrar</button>
            </form>
            <button onclick="closeModal('join')" class="text-gray-500 hover:text-gray-700 mt-2">Cancelar</button>
        </div>
    </div>
</div>
<script>
function openModal(type) {
    document.getElementById('modal-' + type).classList.remove('hidden');
    if(type === 'join') {
        const urlParams = new URLSearchParams(window.location.search);
        const code = urlParams.get('code');
        if(code) {
            const codeInput = document.getElementById('joinCodeInput');
            codeInput.value = code;
            codeInput.readOnly = true;
            codeInput.classList.add('bg-gray-100');
        }
    }
}
function closeModal(type) {
    document.getElementById('modal-' + type).classList.add('hidden');
}
</script>
@endsection 