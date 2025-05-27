@extends('layouts.modern')

@section('title', 'Gerador de Senhas - Webeetools')

@section('styles')
.password-input {
    background: rgba(2, 6, 23, 0.8);
    border: 1px solid rgba(71, 85, 105, 0.5);
    border-radius: 0.5rem;
    padding: 1rem;
    color: #f1f5f9;
    font-family: 'JetBrains Mono', monospace;
    font-size: 1.125rem;
    width: 100%;
    position: relative;
    transition: all 0.3s ease;
}

.password-input:focus {
    outline: none;
    border-color: var(--accent-400);
    box-shadow: 0 0 0 3px rgba(234, 179, 8, 0.1);
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

.range-slider {
    -webkit-appearance: none;
    appearance: none;
    width: 100%;
    height: 8px;
    border-radius: 4px;
    background: rgba(71, 85, 105, 0.5);
    outline: none;
    cursor: pointer;
}

.range-slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: var(--accent-400);
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(234, 179, 8, 0.3);
}

.range-slider::-moz-range-thumb {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: var(--accent-400);
    cursor: pointer;
    border: none;
    box-shadow: 0 2px 8px rgba(234, 179, 8, 0.3);
}

.checkbox-group {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
    margin: 1.5rem 0;
}

.checkbox-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem;
    background: rgba(15, 23, 42, 0.4);
    border: 1px solid rgba(71, 85, 105, 0.3);
    border-radius: 0.5rem;
    transition: all 0.3s ease;
}

.checkbox-item:hover {
    border-color: rgba(234, 179, 8, 0.3);
    background: rgba(15, 23, 42, 0.6);
}

.checkbox-item input[type="checkbox"] {
    width: 1.25rem;
    height: 1.25rem;
    accent-color: var(--accent-400);
    cursor: pointer;
}

.checkbox-item label {
    color: #e2e8f0;
    font-weight: 500;
    cursor: pointer;
    flex: 1;
}

.range-container {
    position: relative;
    margin-bottom: 2rem;
}

.range-labels {
    display: flex;
    justify-content: space-between;
    margin-top: 0.5rem;
    font-size: 0.875rem;
    color: #9ca3af;
}

.length-display {
    background: rgba(234, 179, 8, 0.1);
    color: var(--accent-400);
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-weight: 600;
    border: 1px solid rgba(234, 179, 8, 0.3);
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
    content: '🔒';
    position: absolute;
    left: 0;
}
@endsection

@section('content')
<div class="tool-container">
    <div class="tool-header">
        <h1 class="tool-title">
            <i class="fas fa-key" style="color: var(--accent-400); margin-right: 0.5rem;"></i>
            Gerador de Senhas
        </h1>
        <p class="tool-description">
            Crie senhas seguras e personalizáveis para seus projetos
        </p>
    </div>

    <div class="tool-content">
        <div class="form-group">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <label class="form-label">
                    <i class="fas fa-ruler"></i> Comprimento da Senha
                </label>
                <span id="lengthValue" class="length-display">12 caracteres</span>
            </div>
            <div class="range-container">
                <input type="range" id="length" min="4" max="64" value="12" class="range-slider">
                <div class="range-labels">
                    <span>4</span>
                    <span>64</span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">
                <i class="fas fa-cogs"></i> Tipos de Caracteres
            </label>
            <div class="checkbox-group">
                <div class="checkbox-item">
                    <input type="checkbox" id="uppercase" checked>
                    <label for="uppercase">Letras Maiúsculas (A-Z)</label>
                </div>
                <div class="checkbox-item">
                    <input type="checkbox" id="lowercase" checked>
                    <label for="lowercase">Letras Minúsculas (a-z)</label>
                </div>
                <div class="checkbox-item">
                    <input type="checkbox" id="numbers" checked>
                    <label for="numbers">Números (0-9)</label>
                </div>
                <div class="checkbox-item">
                    <input type="checkbox" id="special" checked>
                    <label for="special">Caracteres Especiais (!@#$%^&*)</label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">
                <i class="fas fa-lock"></i> Senha Gerada
            </label>
            <div style="position: relative;">
                <input type="text" id="password" readonly class="password-input copy-target" value="Clique em Gerar">
                <button onclick="copyToClipboard(null, this)" class="copy-button">
                    <i class="far fa-copy"></i>
                </button>
            </div>
        </div>

        <button onclick="generatePassword()" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">
            <i class="fas fa-sync-alt"></i>
            Gerar Nova Senha
        </button>

        <div class="tips-section">
            <h2 class="tips-title">
                <i class="fas fa-shield-alt"></i>
                Dicas de Senha Forte
            </h2>
            <ul class="tips-list">
                <li>Use senhas com pelo menos 12 caracteres</li>
                <li>Combine letras maiúsculas e minúsculas</li>
                <li>Inclua números e caracteres especiais</li>
                <li>Evite informações pessoais óbvias</li>
                <li>Use senhas diferentes para cada serviço</li>
            </ul>
        </div>
    </div>
</div>
@endsection

@section('scripts')
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

document.addEventListener('DOMContentLoaded', generatePassword);
@endsection 