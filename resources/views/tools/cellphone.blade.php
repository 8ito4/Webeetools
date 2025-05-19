@extends('layouts.app')

@section('title', 'Gerador de Número de Celular')

@section('content')
<div class="max-w-xl mx-auto mt-12 bg-white p-8 rounded-lg shadow-lg">
    <h1 class="text-3xl font-bold text-indigo-700 mb-4 flex items-center gap-2">
        <i class="fas fa-mobile-alt"></i> Gerador de Número de Celular
    </h1>
    <form method="POST" action="{{ route('tools.cellphone') }}" class="flex flex-col gap-4">
        @csrf
        <label class="block font-semibold text-gray-700">DDD (opcional)</label>
        <input type="text" name="ddd" maxlength="2" class="block w-24 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 px-3 py-2 text-center" placeholder="Ex: 11">
        <div class="relative w-full">
            <input id="cellphoneOutput" type="text" readonly value="{{ session('cellphone') ?? '' }}" class="w-full text-center font-mono text-xl bg-gray-50 border border-gray-300 rounded px-4 py-3 focus:outline-none cursor-default select-all shadow-sm pr-12">
            <button onclick="copyCellphone()" type="button" class="absolute right-2 top-1/2 -translate-y-1/2 p-1 bg-transparent hover:bg-gray-200 rounded transition" title="Copiar">
                <i class="far fa-copy text-gray-500 hover:text-gray-700"></i>
            </button>
        </div>
        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 px-4 rounded transition text-lg mt-2">Gerar Número</button>
    </form>
    <script>
        function copyCellphone() {
            const input = document.getElementById('cellphoneOutput');
            input.select();
            document.execCommand('copy');
            const btn = event.currentTarget;
            const original = btn.innerHTML;
            btn.innerHTML = '<i class=\'fas fa-check text-green-600 text-lg\'></i>';
            setTimeout(() => { btn.innerHTML = original; }, 1200);
        }
    </script>
    <div class="mt-8">
        <h2 class="font-bold text-lg mb-2 text-gray-800">Dicas para Testes:</h2>
        <ul class="list-disc pl-5 text-gray-600 space-y-1">
            <li>Use DDDs válidos para sua região</li>
            <li>Utilize números diferentes para cada teste</li>
            <li>Evite usar números reais em produção</li>
            <li>Copie facilmente o número gerado para seus formulários</li>
        </ul>
    </div>
</div>
@endsection 