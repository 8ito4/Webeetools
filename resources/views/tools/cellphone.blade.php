@extends('layouts.modern')

@section('title', 'Gerador de Celular - Webeetools')

@section('styles')
.cellphone-input {
    background: rgba(15, 23, 42, 0.8);
    border: 1px solid rgba(71, 85, 105, 0.5);
    border-radius: 0.5rem;
    padding: 1rem;
    color: #f1f5f9;
    font-family: 'JetBrains Mono', monospace;
    font-size: 1.125rem;
    text-align: center;
    transition: all 0.3s ease;
}

.cellphone-input:focus {
    outline: none;
    border-color: var(--accent-400);
    box-shadow: 0 0 0 3px rgba(234, 179, 8, 0.1);
}

.cellphone-output {
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

.ddd-input {
    width: 120px;
    text-align: center;
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
    content: '📱';
    position: absolute;
    left: 0;
}

.generator-section {
    background: rgba(15, 23, 42, 0.4);
    border: 1px solid rgba(71, 85, 105, 0.3);
    border-radius: 0.75rem;
    padding: 2rem;
    text-align: center;
}

.ddd-section {
    margin-bottom: 2rem;
}

.output-section {
    margin: 2rem 0;
}
@endsection

@section('content')
<div class="tool-container">
    <div class="tool-header">
        <h1 class="tool-title">
            <i class="fas fa-mobile-alt" style="color: var(--accent-400); margin-right: 0.5rem;"></i>
            Gerador de número de telefone
        </h1>
        <p class="tool-description">
            Gere números de celular válidos para testes e desenvolvimento
        </p>
    </div>

    <div class="tool-content">
        <div class="generator-section">
            <div class="ddd-section">
                <label class="form-label" style="margin-bottom: 1rem; display: block;">
                    <i class="fas fa-map-marker-alt"></i>
                    DDD (opcional)
                </label>
                <input type="text" id="ddd" maxlength="2" class="cellphone-input ddd-input" placeholder="Ex: 11">
                <p style="color: #9ca3af; font-size: 0.875rem; margin-top: 0.5rem;">
                    Deixe vazio para gerar apenas o número
                </p>
            </div>

            <div class="output-section">
                <label class="form-label" style="margin-bottom: 1rem; display: block;">
                    <i class="fas fa-phone"></i>
                    Número Gerado
                </label>
                <div style="position: relative;">
                    <input id="cellphoneOutput" type="text" readonly class="cellphone-output copy-target" placeholder="Clique em Gerar">
                    <button onclick="copyToClipboard(null, this)" class="copy-button" title="Copiar número">
                        <i class="far fa-copy"></i>
                    </button>
                </div>
            </div>

            <button onclick="generateCellphone()" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">
                <i class="fas fa-sync-alt"></i>
                Gerar Novo Número
            </button>
        </div>

        <div class="tips-section">
            <h2 class="tips-title">
                <i class="fas fa-lightbulb"></i>
                Dicas para Testes
            </h2>
            <ul class="tips-list">
                <li>Use DDDs válidos para sua região (11, 21, 31, etc.)</li>
                <li>Utilize números diferentes para cada teste</li>
                <li>Evite usar números reais em produção</li>
                <li>Copie facilmente o número gerado para seus formulários</li>
                <li>Números gerados seguem o padrão brasileiro (9 + 8 dígitos)</li>
            </ul>
        </div>
    </div>
</div>
@endsection

@section('scripts')
function generateCellphone() {
    const ddd = document.getElementById('ddd').value;
    const output = document.getElementById('cellphoneOutput');
    
    // Gerar 8 dígitos aleatórios
    let number = '';
    for (let i = 0; i < 8; i++) {
        number += Math.floor(Math.random() * 10);
    }
    
    // Adicionar o 9 no início (padrão brasileiro)
    number = '9' + number;
    
    // Adicionar DDD se fornecido
    if (ddd && ddd.length === 2) {
        number = `(${ddd}) ${number.substring(0, 5)}-${number.substring(5)}`;
    } else {
        number = `${number.substring(0, 5)}-${number.substring(5)}`;
    }
    
    output.value = number;
}

// Gerar número automaticamente ao carregar a página
document.addEventListener('DOMContentLoaded', generateCellphone);

// Permitir apenas números no campo DDD
document.getElementById('ddd').addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '');
});
@endsection 