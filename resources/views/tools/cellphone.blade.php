@extends('layouts.app')

@section('title', 'Gerador de Número de Celular')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center mb-6">
                <i class="fas fa-mobile-alt text-2xl text-blue-600 mr-3"></i>
                <h1 class="text-2xl font-bold text-gray-800">Gerador de Número de Celular</h1>
            </div>

            <div class="mb-6">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="ddd">
                        DDD (opcional)
                    </label>
                    <input type="text" id="ddd" maxlength="2" 
                        class="shadow appearance-none border rounded w-24 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-center"
                        placeholder="Ex: 11">
                </div>

                <div class="relative mb-4">
                    <input id="cellphoneOutput" type="text" readonly 
                        class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-lg font-mono text-center"
                        placeholder="Clique em Gerar">
                    <button onclick="copyCellphone()" type="button" 
                        class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                        <i class="far fa-copy"></i>
                    </button>
                </div>

                <button onclick="generateCellphone()" type="button" 
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                    Gerar Número
                </button>
            </div>

            <div class="mt-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-2">Dicas para Testes:</h2>
                <ul class="list-disc list-inside text-gray-600">
                    <li>Use DDDs válidos para sua região</li>
                    <li>Utilize números diferentes para cada teste</li>
                    <li>Evite usar números reais em produção</li>
                    <li>Copie facilmente o número gerado para seus formulários</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function generateCellphone() {
    const ddd = document.getElementById('ddd').value;
    const output = document.getElementById('cellphoneOutput');
    
    // Gera os 8 dígitos aleatórios
    let number = '';
    for (let i = 0; i < 8; i++) {
        number += Math.floor(Math.random() * 10);
    }
    
    // Adiciona o 9 no início (padrão de celular)
    number = '9' + number;
    
    // Adiciona o DDD se fornecido
    if (ddd) {
        number = ddd + number;
    }
    
    output.value = number;
}

function copyCellphone() {
    const input = document.getElementById('cellphoneOutput');
    input.select();
    document.execCommand('copy');
    
    // Feedback visual
    const originalValue = input.value;
    input.value = 'Copiado!';
    setTimeout(() => {
        input.value = originalValue;
    }, 1000);
}

// Gerar número inicial
document.addEventListener('DOMContentLoaded', generateCellphone);
</script>
@endpush
@endsection 