@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center mb-6">
                <i class="fas fa-id-card text-2xl text-blue-600 mr-3"></i>
                <h1 class="text-2xl font-bold text-gray-800">Gerador de CPF/CNPJ</h1>
            </div>

            <div class="mb-6">
                <div class="flex flex-wrap gap-4 mb-4">
                    <div class="flex-1">
                        <div class="flex items-center mb-4">
                            <input type="radio" id="cpf" name="document_type" value="cpf" checked 
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                            <label class="ml-2 text-sm font-medium text-gray-900" for="cpf">
                                CPF
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input type="radio" id="cnpj" name="document_type" value="cnpj" 
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                            <label class="ml-2 text-sm font-medium text-gray-900" for="cnpj">
                                CNPJ
                            </label>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <input type="text" id="document" readonly
                        class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-lg font-mono"
                        value="Clique em Gerar">
                    <button onclick="copyToClipboard()" 
                        class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                        <i class="far fa-copy"></i>
                    </button>
                </div>

                <div class="mt-4">
                    <button onclick="generateDocument()" 
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                        Gerar Documento
                    </button>
                </div>

                <div class="flex items-center mt-4">
                    <input type="checkbox" id="punctuation" checked 
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                    <label class="ml-2 text-sm font-medium text-gray-900" for="punctuation">
                        Incluir pontuação
                    </label>
                </div>
            </div>

            <div class="mt-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-2">Informações:</h2>
                <ul class="list-disc list-inside text-gray-600">
                    <li>CPF: Cadastro de Pessoas Físicas</li>
                    <li>CNPJ: Cadastro Nacional da Pessoa Jurídica</li>
                    <li>Os números gerados são matematicamente válidos</li>
                    <li>Não use estes números para fins ilegais</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Função para gerar números aleatórios
function generateRandomNumber(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

// Função para gerar CPF
function generateCPF(punctuation) {
    let numbers = [];
    
    // Gera os 9 primeiros dígitos
    for(let i = 0; i < 9; i++) {
        numbers.push(generateRandomNumber(0, 9));
    }

    // Primeiro dígito verificador
    let sum = 0;
    for(let i = 0; i < 9; i++) {
        sum += numbers[i] * (10 - i);
    }
    let remainder = sum % 11;
    numbers.push(remainder < 2 ? 0 : 11 - remainder);

    // Segundo dígito verificador
    sum = 0;
    for(let i = 0; i < 10; i++) {
        sum += numbers[i] * (11 - i);
    }
    remainder = sum % 11;
    numbers.push(remainder < 2 ? 0 : 11 - remainder);

    // Formata o resultado
    let result = numbers.join('');
    return punctuation ? result.replace(/^(\d{3})(\d{3})(\d{3})(\d{2})$/, '$1.$2.$3-$4') : result;
}

// Função para gerar CNPJ
function generateCNPJ(punctuation) {
    let numbers = [];
    
    // Gera os 12 primeiros dígitos
    for(let i = 0; i < 12; i++) {
        numbers.push(generateRandomNumber(0, 9));
    }

    // Primeiro dígito verificador
    let sum = 0;
    let weight = 5;
    for(let i = 0; i < 12; i++) {
        sum += numbers[i] * weight;
        weight = weight === 2 ? 9 : weight - 1;
    }
    let remainder = sum % 11;
    numbers.push(remainder < 2 ? 0 : 11 - remainder);

    // Segundo dígito verificador
    sum = 0;
    weight = 6;
    for(let i = 0; i < 13; i++) {
        sum += numbers[i] * weight;
        weight = weight === 2 ? 9 : weight - 1;
    }
    remainder = sum % 11;
    numbers.push(remainder < 2 ? 0 : 11 - remainder);

    // Formata o resultado
    let result = numbers.join('');
    return punctuation ? result.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/, '$1.$2.$3/$4-$5') : result;
}

// Função principal para gerar documento
function generateDocument() {
    const documentField = document.getElementById('document');
    const type = document.querySelector('input[name="document_type"]:checked').value;
    const punctuation = document.getElementById('punctuation').checked;
    
    try {
        const result = type === 'cpf' ? generateCPF(punctuation) : generateCNPJ(punctuation);
        documentField.value = result;
    } catch (error) {
        console.error('Erro ao gerar documento:', error);
        documentField.value = 'Erro ao gerar documento';
    }
}

// Função para copiar para a área de transferência
function copyToClipboard() {
    const documentField = document.getElementById('document');
    
    try {
        documentField.select();
        document.execCommand('copy');
        
        const originalValue = documentField.value;
        documentField.value = 'Copiado!';
        setTimeout(() => {
            documentField.value = originalValue;
        }, 1000);
    } catch (error) {
        console.error('Erro ao copiar:', error);
        documentField.value = 'Erro ao copiar';
    }
}

// Inicialização
document.addEventListener('DOMContentLoaded', function() {
    // Gerar documento inicial
    generateDocument();
    
    // Adicionar listeners para atualização automática
    document.querySelectorAll('input[name="document_type"]').forEach(radio => {
        radio.addEventListener('change', generateDocument);
    });
    
    document.getElementById('punctuation').addEventListener('change', generateDocument);
});
</script>
@endpush
@endsection 