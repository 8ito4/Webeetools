@extends('layouts.modern')

@section('title', 'Formatador JSON - Webeetools')

@section('styles')
/* JSON Syntax Highlighting */
.json-string { color: #ce9178; }
.json-number { color: #b5cea8; }
.json-boolean { color: #569cd6; }
.json-null { color: #569cd6; }
.json-key { color: #9cdcfe; }

.json-output {
    white-space: pre;
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.875rem;
    line-height: 1.25rem;
    tab-size: 4;
    padding: 1rem;
    background: rgba(2, 6, 23, 0.8);
    color: #d4d4d4;
    border-radius: 0.5rem;
    border: 1px solid rgba(71, 85, 105, 0.5);
    overflow: auto;
    min-height: 400px;
    position: relative;
}

.json-output::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

.json-output::-webkit-scrollbar-track {
    background: rgba(2, 6, 23, 0.8);
}

.json-output::-webkit-scrollbar-thumb {
    background: var(--accent-600);
    border-radius: 4px;
}

.json-output::-webkit-scrollbar-thumb:hover {
    background: var(--accent-500);
}

.copy-button {
    position: absolute;
    top: 0.75rem;
    right: 0.75rem;
    z-index: 10;
    padding: 0.5rem;
    border-radius: 0.25rem;
    background: rgba(15, 23, 42, 0.8);
    color: #9ca3af;
    border: 1px solid rgba(71, 85, 105, 0.3);
    cursor: pointer;
    transition: all 0.3s ease;
}

.copy-button:hover {
    background: rgba(30, 41, 59, 0.8);
    color: var(--accent-400);
    border-color: var(--accent-400);
}

.status-message {
    padding: 1rem;
    border-radius: 0.5rem;
    margin-top: 1rem;
    font-weight: 500;
}

.status-success {
    background: rgba(16, 185, 129, 0.1);
    border: 1px solid rgba(16, 185, 129, 0.3);
    color: #10b981;
}

.status-error {
    background: rgba(239, 68, 68, 0.1);
    border: 1px solid rgba(239, 68, 68, 0.3);
    color: #ef4444;
}

.status-warning {
    background: rgba(245, 158, 11, 0.1);
    border: 1px solid rgba(245, 158, 11, 0.3);
    color: #f59e0b;
}

.clear-button {
    position: absolute;
    top: 0.75rem;
    right: 0.75rem;
    color: #9ca3af;
    cursor: pointer;
    transition: all 0.3s ease;
    padding: 0.25rem;
    border-radius: 0.25rem;
}

.clear-button:hover {
    color: #ef4444;
    background: rgba(239, 68, 68, 0.1);
}

.tips-section {
    background: rgba(15, 23, 42, 0.4);
    border: 1px solid rgba(71, 85, 105, 0.3);
    border-radius: 0.75rem;
    padding: 1.5rem;
    margin-top: 2rem;
}

.tips-title {
    color: #e2e8f0;
    font-size: 1.125rem;
    font-weight: 600;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.tips-list {
    list-style: none;
    padding: 0;
}

.tips-list li {
    color: #9ca3af;
    margin-bottom: 0.5rem;
    padding-left: 1.5rem;
    position: relative;
}

.tips-list li::before {
    content: '→';
    position: absolute;
    left: 0;
    color: var(--accent-400);
    font-weight: bold;
}
@endsection

@section('content')
<div class="tool-container">
    <div class="tool-header">
        <h1 class="tool-title">
            <i class="fas fa-code" style="color: var(--accent-400); margin-right: 0.5rem;"></i>
            Formatador JSON
        </h1>
        <p class="tool-description">
            Formate, valide e minifique seus dados JSON com facilidade e precisão
        </p>
    </div>

    <div class="tool-content">
        <div class="grid grid-cols-2">
            <div class="form-group">
                <label class="form-label" for="input">
                    <i class="fas fa-edit"></i> JSON de Entrada
                </label>
                <div style="position: relative;">
                    <textarea id="input" 
                        class="form-textarea" 
                        style="min-height: 400px; font-family: 'JetBrains Mono', monospace;"
                        placeholder='{"exemplo": "Cole seu JSON aqui"}'></textarea>
                    <button onclick="clearInput()" class="clear-button">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="output">
                    <i class="fas fa-code"></i> JSON Formatado
                </label>
                <div style="position: relative;">
                    <pre id="output" class="json-output"></pre>
                    <button onclick="copyOutput()" class="copy-button">
                        <i class="far fa-copy"></i>
                    </button>
                </div>
            </div>
        </div>

        <div style="display: flex; flex-wrap: wrap; gap: 1rem; margin-top: 1.5rem;">
            <button onclick="formatJSON()" class="btn btn-primary">
                <i class="fas fa-indent"></i>
                Formatar
            </button>
            <button onclick="minifyJSON()" class="btn btn-secondary">
                <i class="fas fa-compress-alt"></i>
                Minificar
            </button>
            <button onclick="validateJSON()" class="btn btn-secondary">
                <i class="fas fa-check"></i>
                Validar
            </button>
        </div>

        <div id="status" class="hidden"></div>

        <div class="tips-section">
            <h2 class="tips-title">
                <i class="fas fa-lightbulb"></i>
                Dicas de Uso
            </h2>
            <ul class="tips-list">
                <li>Use "Formatar" para tornar o JSON mais legível com indentação adequada</li>
                <li>Use "Minificar" para remover espaços em branco e reduzir o tamanho</li>
                <li>Use "Validar" para verificar se o JSON está sintaticamente correto</li>
                <li>Clique no ícone de cópia para copiar o resultado para a área de transferência</li>
            </ul>
        </div>
    </div>
</div>
@endsection

@section('scripts')
function colorizeJSON(json) {
    json = json.replace(/&/g, '&amp;')
               .replace(/</g, '&lt;')
               .replace(/>/g, '&gt;');
               
    return json.replace(/"([^"]+)":/g, '<span class="json-key">"$1"</span>:')
               .replace(/"([^"]+)"(?!:)/g, '<span class="json-string">"$1"</span>')
               .replace(/\b(true|false)\b/g, '<span class="json-boolean">$1</span>')
               .replace(/\b(null)\b/g, '<span class="json-null">$1</span>')
               .replace(/\b(\d+\.?\d*)\b/g, '<span class="json-number">$1</span>');
}

function showStatus(message, type = 'success') {
    const status = document.getElementById('status');
    status.textContent = message;
    status.classList.remove('hidden', 'status-success', 'status-error', 'status-warning');
    status.classList.add('status-message', 'status-' + type);
    
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
        showStatus('JSON válido!', 'success');
    } catch (e) {
        showStatus('JSON inválido: ' + e.message, 'error');
    }
}

function copyOutput() {
    const output = document.getElementById('output');
    const text = output.textContent;
    
    if (!text.trim()) {
        showStatus('Nenhum conteúdo para copiar', 'warning');
        return;
    }
    
    navigator.clipboard.writeText(text).then(() => {
        showStatus('Copiado para a área de transferência!');
    }).catch(() => {
        showStatus('Erro ao copiar', 'error');
    });
}

function clearInput() {
    document.getElementById('input').value = '';
    document.getElementById('output').innerHTML = '';
}
@endsection 