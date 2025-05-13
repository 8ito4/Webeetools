@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center mb-6">
                <i class="fas fa-key text-2xl text-blue-600 mr-3"></i>
                <h1 class="text-2xl font-bold text-gray-800">Gerador de Senha</h1>
            </div>

            <div class="mb-6">
                <div class="flex flex-wrap gap-4 mb-4">
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-2">
                            <label class="block text-gray-700 text-sm font-bold" for="length">
                                Comprimento da Senha
                            </label>
                            <span id="lengthValue" class="text-sm font-medium text-gray-600">12 caracteres</span>
                        </div>
                        <div class="relative">
                            <input type="range" id="length" min="4" max="64" value="12" 
                                class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-blue-600">
                            <div class="absolute -bottom-6 left-0 w-full flex justify-between text-xs text-gray-500">
                                <span>4</span>
                                <span>64</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap gap-4 mb-4 mt-8">
                    <div class="flex items-center">
                        <input type="checkbox" id="uppercase" checked 
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        <label class="ml-2 text-sm font-medium text-gray-900" for="uppercase">
                            Letras Maiúsculas (A-Z)
                        </label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="lowercase" checked 
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        <label class="ml-2 text-sm font-medium text-gray-900" for="lowercase">
                            Letras Minúsculas (a-z)
                        </label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="numbers" checked 
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        <label class="ml-2 text-sm font-medium text-gray-900" for="numbers">
                            Números (0-9)
                        </label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="special" checked 
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        <label class="ml-2 text-sm font-medium text-gray-900" for="special">
                            Caracteres Especiais (!@#$%^&*)
                        </label>
                    </div>
                </div>

                <div class="relative">
                    <input type="text" id="password" readonly
                        class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-lg font-mono"
                        value="Clique em Gerar">
                    <button onclick="copyToClipboard()" 
                        class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                        <i class="far fa-copy"></i>
                    </button>
                </div>

                <div class="mt-4">
                    <button onclick="generatePassword()" 
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                        Gerar Senha
                    </button>
                </div>
            </div>

            <div class="mt-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-2">Dicas de Senha Forte:</h2>
                <ul class="list-disc list-inside text-gray-600">
                    <li>Use senhas com pelo menos 12 caracteres</li>
                    <li>Combine letras maiúsculas e minúsculas</li>
                    <li>Inclua números e caracteres especiais</li>
                    <li>Evite informações pessoais óbvias</li>
                    <li>Use senhas diferentes para cada serviço</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Atualizar o valor do comprimento quando o slider é movido
document.getElementById('length').addEventListener('input', function() {
    document.getElementById('lengthValue').textContent = this.value + ' caracteres';
});

function generatePassword() {
    const length = document.getElementById('length').value;
    const uppercase = document.getElementById('uppercase').checked;
    const lowercase = document.getElementById('lowercase').checked;
    const numbers = document.getElementById('numbers').checked;
    const special = document.getElementById('special').checked;

    let charset = '';
    if (uppercase) charset += 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    if (lowercase) charset += 'abcdefghijklmnopqrstuvwxyz';
    if (numbers) charset += '0123456789';
    if (special) charset += '!@#$%^&*';

    if (charset === '') {
        alert('Selecione pelo menos um tipo de caractere!');
        return;
    }

    let password = '';
    for (let i = 0; i < length; i++) {
        const randomIndex = Math.floor(Math.random() * charset.length);
        password += charset[randomIndex];
    }

    document.getElementById('password').value = password;
}

function copyToClipboard() {
    const passwordField = document.getElementById('password');
    passwordField.select();
    document.execCommand('copy');
    
    // Feedback visual
    const originalValue = passwordField.value;
    passwordField.value = 'Copiado!';
    setTimeout(() => {
        passwordField.value = originalValue;
    }, 1000);
}

// Gerar senha inicial
document.addEventListener('DOMContentLoaded', generatePassword);
</script>
@endpush
@endsection 