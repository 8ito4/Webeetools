@extends('layouts.app')

@section('content')
<style>
/* Estilo para a sintaxe do JSON */
.json-string { color: #ce9178; }
.json-number { color: #b5cea8; }
.json-boolean { color: #569cd6; }
.json-null { color: #569cd6; }
.json-key { color: #9cdcfe; }
.json-output {
    white-space: pre;
    font-family: monospace;
    font-size: 0.875rem;
    line-height: 1.25rem;
    tab-size: 4;
    padding: 0.5rem 0.75rem;
    padding-right: 3rem; /* Aumentado para dar mais espaço ao botão */
    background-color: #1e1e1e;
    color: #d4d4d4;
    border-radius: 0.375rem;
    border: 1px solid #374151;
    overflow: auto;
    height: calc(30 * 1.25rem + 1rem); /* 30 linhas + padding */
}

/* Estilo da barra de rolagem */
.json-output::-webkit-scrollbar {
    width: 14px;
    height: 14px;
}

.json-output::-webkit-scrollbar-track {
    background: #1e1e1e;
    border-left: 1px solid #2d2d2d;
}

.json-output::-webkit-scrollbar-thumb {
    background: #424242;
    border: 3px solid #1e1e1e;
    border-radius: 7px;
}

.json-output::-webkit-scrollbar-thumb:hover {
    background: #4f4f4f;
}

/* Canto onde as barras se encontram */
.json-output::-webkit-scrollbar-corner {
    background: #1e1e1e;
}

/* Posição do botão de copiar */
.copy-button {
    position: absolute;
    top: 0.5rem;
    right: 1.25rem; /* Ajustado para ficar mais à esquerda */
    z-index: 10;
    padding: 0.25rem;
    border-radius: 0.25rem;
    background-color: rgba(30, 30, 30, 0.8); /* Fundo semi-transparente */
}

.copy-button:hover {
    background-color: rgba(30, 30, 30, 0.9);
}
</style>

<div class="container-fluid px-4 py-4">
    <div class="max-w-full mx-4">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center mb-6">
                <i class="fas fa-code text-2xl text-blue-600 mr-3"></i>
                <h1 class="text-2xl font-bold text-gray-800">Conversor JSON</h1>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Input -->
                <div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="input">
                            JSON de Entrada
                        </label>
                        <div class="relative">
                            <textarea id="input" rows="30"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline font-mono text-sm"
                                placeholder='{"exemplo": "Cole seu JSON aqui"}'></textarea>
                            <button onclick="clearInput()" 
                                class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Output -->
                <div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="output">
                            JSON Formatado
                        </label>
                        <div class="relative">
                            <pre id="output" class="json-output"></pre>
                            <button onclick="copyOutput()" 
                                class="copy-button text-gray-300 hover:text-white">
                                <i class="far fa-copy"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ações -->
            <div class="flex flex-wrap gap-4 mt-4">
                <button onclick="formatJSON()" 
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    <i class="fas fa-indent mr-2"></i>
                    Formatar
                </button>
                <button onclick="minifyJSON()" 
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    <i class="fas fa-compress-alt mr-2"></i>
                    Minificar
                </button>
                <button onclick="validateJSON()" 
                    class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    <i class="fas fa-check mr-2"></i>
                    Validar
                </button>
            </div>

            <!-- Status -->
            <div id="status" class="mt-4 p-4 rounded-lg hidden">
            </div>

            <!-- Dicas -->
            <div class="mt-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-2">Dicas:</h2>
                <ul class="list-disc list-inside text-gray-600">
                    <li>Use "Formatar" para tornar o JSON mais legível com indentação adequada</li>
                    <li>Use "Minificar" para remover espaços em branco e reduzir o tamanho</li>
                    <li>Use "Validar" para verificar se o JSON está sintaticamente correto</li>
                    <li>Clique no ícone de cópia para copiar o resultado para a área de transferência</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function colorizeJSON(json) {
    // Primeiro escapa os caracteres HTML
    json = json.replace(/&/g, '&amp;')
               .replace(/</g, '&lt;')
               .replace(/>/g, '&gt;');
               
    // Depois aplica a colorização
    return json.replace(/"([^"]+)":/g, '<span class="json-key">"$1"</span>:')
               .replace(/"([^"]+)"(?!:)/g, '<span class="json-string">"$1"</span>')
               .replace(/\b(true|false)\b/g, '<span class="json-boolean">$1</span>')
               .replace(/\b(null)\b/g, '<span class="json-null">$1</span>')
               .replace(/\b(\d+\.?\d*)\b/g, '<span class="json-number">$1</span>');
}

function showStatus(message, type = 'success') {
    const status = document.getElementById('status');
    status.textContent = message;
    status.classList.remove('hidden', 'bg-green-100', 'text-green-700', 'bg-red-100', 'text-red-700', 'bg-yellow-100', 'text-yellow-700');
    
    switch(type) {
        case 'success':
            status.classList.add('bg-green-100', 'text-green-700');
            break;
        case 'error':
            status.classList.add('bg-red-100', 'text-red-700');
            break;
        case 'warning':
            status.classList.add('bg-yellow-100', 'text-yellow-700');
            break;
    }
    
    setTimeout(() => {
        status.classList.add('hidden');
    }, 3000);
}

function formatJSON() {
    try {
        const input = document.getElementById('input').value;
        if (!input.trim()) {
            showStatus('Por favor, insira um JSON para formatar', 'warning');
            return;
        }
        
        const parsed = JSON.parse(input);
        const formatted = JSON.stringify(parsed, null, 4);
        const output = document.getElementById('output');
        output.innerHTML = colorizeJSON(formatted);
        showStatus('JSON formatado com sucesso!');
    } catch (e) {
        document.getElementById('output').innerHTML = '';
        showStatus('JSON inválido: ' + e.message, 'error');
    }
}

function minifyJSON() {
    try {
        const input = document.getElementById('input').value;
        if (!input.trim()) {
            showStatus('Por favor, insira um JSON para minificar', 'warning');
            return;
        }
        
        const parsed = JSON.parse(input);
        const minified = JSON.stringify(parsed);
        const output = document.getElementById('output');
        output.innerHTML = colorizeJSON(minified);
        showStatus('JSON minificado com sucesso!');
    } catch (e) {
        document.getElementById('output').innerHTML = '';
        showStatus('JSON inválido: ' + e.message, 'error');
    }
}

function validateJSON() {
    try {
        const input = document.getElementById('input').value;
        if (!input.trim()) {
            showStatus('Por favor, insira um JSON para validar', 'warning');
            return;
        }
        
        JSON.parse(input);
        showStatus('JSON válido!');
    } catch (e) {
        showStatus('JSON inválido: ' + e.message, 'error');
    }
}

function copyOutput() {
    const output = document.getElementById('output');
    const textToCopy = output.textContent || output.innerText;
    navigator.clipboard.writeText(textToCopy).then(() => {
        showStatus('Copiado para a área de transferência!');
    });
}

function clearInput() {
    document.getElementById('input').value = '';
    document.getElementById('output').innerHTML = '';
    showStatus('Campos limpos!', 'warning');
}

// Adicionar evento de input para formatar automaticamente
document.getElementById('input').addEventListener('input', function() {
    try {
        if (this.value.trim()) {
            JSON.parse(this.value);
            document.getElementById('input').classList.remove('border-red-500');
        }
    } catch (e) {
        document.getElementById('input').classList.add('border-red-500');
    }
});
</script>
@endpush
@endsection 