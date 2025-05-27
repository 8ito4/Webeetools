@extends('layouts.modern')

@section('title', 'Gerador de CPF/CNPJ - Webeetools')

@section('styles')
.document-input {
    background: rgba(2, 6, 23, 0.8);
    border: 1px solid rgba(71, 85, 105, 0.5);
    border-radius: 0.5rem;
    padding: 1.5rem;
    color: var(--accent-400);
    font-family: 'JetBrains Mono', monospace;
    font-size: 1.5rem;
    text-align: center;
    width: 100%;
    position: relative;
    transition: all 0.3s ease;
    letter-spacing: 0.1em;
}

.document-input:focus {
    outline: none;
    border-color: var(--accent-400);
    box-shadow: 0 0 0 3px rgba(234, 179, 8, 0.1);
}

.radio-group {
    display: flex;
    gap: 2rem;
    justify-content: center;
    margin: 2rem 0;
}

.radio-option {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
    padding: 1rem 1.5rem;
    border-radius: 0.5rem;
    border: 1px solid rgba(71, 85, 105, 0.3);
    background: rgba(15, 23, 42, 0.4);
    transition: all 0.3s ease;
}

.radio-option:hover {
    border-color: rgba(234, 179, 8, 0.3);
    background: rgba(234, 179, 8, 0.1);
}

.radio-option.active {
    border-color: var(--accent-400);
    background: rgba(234, 179, 8, 0.1);
}

.radio-option input[type="radio"] {
    appearance: none;
    width: 1.25rem;
    height: 1.25rem;
    border: 2px solid rgba(71, 85, 105, 0.5);
    border-radius: 50%;
    position: relative;
    transition: all 0.3s ease;
}

.radio-option input[type="radio"]:checked {
    border-color: var(--accent-400);
}

.radio-option input[type="radio"]:checked::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 0.5rem;
    height: 0.5rem;
    background: var(--accent-400);
    border-radius: 50%;
}

.radio-label {
    color: #e2e8f0;
    font-weight: 600;
    font-size: 1rem;
}

.checkbox-option {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    justify-content: center;
    margin: 1.5rem 0;
    padding: 1rem;
    border-radius: 0.5rem;
    background: rgba(15, 23, 42, 0.4);
    border: 1px solid rgba(71, 85, 105, 0.3);
    cursor: pointer;
    transition: all 0.3s ease;
}

.checkbox-option:hover {
    border-color: rgba(234, 179, 8, 0.3);
    background: rgba(234, 179, 8, 0.1);
}

.checkbox-option input[type="checkbox"] {
    appearance: none;
    width: 1.25rem;
    height: 1.25rem;
    border: 2px solid rgba(71, 85, 105, 0.5);
    border-radius: 0.25rem;
    position: relative;
    transition: all 0.3s ease;
}

.checkbox-option input[type="checkbox"]:checked {
    border-color: var(--accent-400);
    background: var(--accent-400);
}

.checkbox-option input[type="checkbox"]:checked::after {
    content: '✓';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: #0f172a;
    font-weight: bold;
    font-size: 0.875rem;
}

.copy-button {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #9ca3af;
    cursor: pointer;
    transition: all 0.3s ease;
    padding: 0.5rem;
    border-radius: 0.25rem;
}

.copy-button:hover {
    color: var(--accent-400);
    background: rgba(234, 179, 8, 0.1);
}

.generator-section {
    background: rgba(15, 23, 42, 0.4);
    border: 1px solid rgba(71, 85, 105, 0.3);
    border-radius: 0.75rem;
    padding: 2rem;
    text-align: center;
}

.output-section {
    margin: 2rem 0;
}

.info-section {
    background: rgba(15, 23, 42, 0.4);
    border: 1px solid rgba(71, 85, 105, 0.3);
    border-radius: 0.75rem;
    padding: 1.5rem;
    margin-top: 2rem;
}

.info-title {
    color: #e2e8f0;
    font-size: 1.125rem;
    font-weight: 600;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.info-list {
    list-style: none;
    padding: 0;
}

.info-list li {
    color: #9ca3af;
    margin-bottom: 0.5rem;
    padding-left: 1.5rem;
    position: relative;
}

.info-list li::before {
    content: '📄';
    position: absolute;
    left: 0;
}

.document-type-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-size: 0.875rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.cpf-badge {
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
    border: 1px solid rgba(16, 185, 129, 0.3);
}

.cnpj-badge {
    background: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
    border: 1px solid rgba(59, 130, 246, 0.3);
}
@endsection

@section('content')
<div class="tool-container">
    <div class="tool-header">
        <h1 class="tool-title">
            <i class="fas fa-id-card" style="color: var(--accent-400); margin-right: 0.5rem;"></i>
            Gerador de CPF/CNPJ
        </h1>
        <p class="tool-description">
            Gere CPF e CNPJ válidos para testes e desenvolvimento
        </p>
    </div>

    <div class="tool-content">
        <div class="generator-section">
            <div class="radio-group">
                <label class="radio-option" id="cpf-option">
                    <input type="radio" id="cpf" name="document_type" value="cpf" checked>
                    <span class="radio-label">
                        <i class="fas fa-user"></i>
                        CPF
                    </span>
                </label>
                <label class="radio-option" id="cnpj-option">
                    <input type="radio" id="cnpj" name="document_type" value="cnpj">
                    <span class="radio-label">
                        <i class="fas fa-building"></i>
                        CNPJ
                    </span>
                </label>
            </div>

            <div class="output-section">
                <div id="document-type-indicator" class="document-type-badge cpf-badge">
                    <i class="fas fa-user"></i>
                    Cadastro de Pessoa Física
                </div>
                
                <div style="position: relative;">
                    <input type="text" id="document" readonly class="document-input copy-target" value="Clique em Gerar">
                    <button onclick="copyToClipboard(null, this)" class="copy-button" title="Copiar documento">
                        <i class="far fa-copy"></i>
                    </button>
                </div>
            </div>

            <label class="checkbox-option">
                <input type="checkbox" id="punctuation" checked>
                <span class="radio-label">
                    <i class="fas fa-dot-circle"></i>
                    Incluir pontuação
                </span>
            </label>

            <button onclick="generateDocument()" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">
                <i class="fas fa-sync-alt"></i>
                Gerar Novo Documento
            </button>
        </div>

        <div class="info-section">
            <h2 class="info-title">
                <i class="fas fa-info-circle"></i>
                Informações Importantes
            </h2>
            <ul class="info-list">
                <li><strong>CPF:</strong> Cadastro de Pessoas Físicas (11 dígitos)</li>
                <li><strong>CNPJ:</strong> Cadastro Nacional da Pessoa Jurídica (14 dígitos)</li>
                <li>Os números gerados são matematicamente válidos</li>
                <li>Use apenas para testes e desenvolvimento</li>
                <li>Não use estes números para fins ilegais ou fraudulentos</li>
            </ul>
        </div>
    </div>
</div>
@endsection

@section('scripts')
function generateRandomNumber(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function generateCPF(punctuation) {
    let numbers = [];
    
    for(let i = 0; i < 9; i++) {
        numbers.push(generateRandomNumber(0, 9));
    }

    let sum = 0;
    for(let i = 0; i < 9; i++) {
        sum += numbers[i] * (10 - i);
    }
    let remainder = sum % 11;
    numbers.push(remainder < 2 ? 0 : 11 - remainder);

    sum = 0;
    for(let i = 0; i < 10; i++) {
        sum += numbers[i] * (11 - i);
    }
    remainder = sum % 11;
    numbers.push(remainder < 2 ? 0 : 11 - remainder);

    let result = numbers.join('');
    return punctuation ? result.replace(/^(\d{3})(\d{3})(\d{3})(\d{2})$/, '$1.$2.$3-$4') : result;
}

function generateCNPJ(punctuation) {
    let numbers = [];
    
    for(let i = 0; i < 12; i++) {
        numbers.push(generateRandomNumber(0, 9));
    }

    let sum = 0;
    let weight = 5;
    for(let i = 0; i < 12; i++) {
        sum += numbers[i] * weight;
        weight = weight === 2 ? 9 : weight - 1;
    }
    let remainder = sum % 11;
    numbers.push(remainder < 2 ? 0 : 11 - remainder);

    sum = 0;
    weight = 6;
    for(let i = 0; i < 13; i++) {
        sum += numbers[i] * weight;
        weight = weight === 2 ? 9 : weight - 1;
    }
    remainder = sum % 11;
    numbers.push(remainder < 2 ? 0 : 11 - remainder);

    let result = numbers.join('');
    return punctuation ? result.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/, '$1.$2.$3/$4-$5') : result;
}

function updateDocumentTypeIndicator() {
    const type = document.querySelector('input[name="document_type"]:checked').value;
    const indicator = document.getElementById('document-type-indicator');
    
    if (type === 'cpf') {
        indicator.className = 'document-type-badge cpf-badge';
        indicator.innerHTML = '<i class="fas fa-user"></i> Cadastro de Pessoa Física';
    } else {
        indicator.className = 'document-type-badge cnpj-badge';
        indicator.innerHTML = '<i class="fas fa-building"></i> Cadastro Nacional da Pessoa Jurídica';
    }
}

function updateRadioStyles() {
    const cpfOption = document.getElementById('cpf-option');
    const cnpjOption = document.getElementById('cnpj-option');
    const cpfRadio = document.getElementById('cpf');
    
    if (cpfRadio.checked) {
        cpfOption.classList.add('active');
        cnpjOption.classList.remove('active');
    } else {
        cnpjOption.classList.add('active');
        cpfOption.classList.remove('active');
    }
}

function generateDocument() {
    const documentField = document.getElementById('document');
    const type = document.querySelector('input[name="document_type"]:checked').value;
    const punctuation = document.getElementById('punctuation').checked;
    
    try {
        const result = type === 'cpf' ? generateCPF(punctuation) : generateCNPJ(punctuation);
        documentField.value = result;
        updateDocumentTypeIndicator();
    } catch (error) {
        console.error('Erro ao gerar documento:', error);
        documentField.value = 'Erro ao gerar documento';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    generateDocument();
    updateRadioStyles();
    
    document.querySelectorAll('input[name="document_type"]').forEach(radio => {
        radio.addEventListener('change', function() {
            generateDocument();
            updateRadioStyles();
        });
    });
    
    document.getElementById('punctuation').addEventListener('change', generateDocument);
});
@endsection 