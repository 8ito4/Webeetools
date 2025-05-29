@extends('layouts.modern')

@section('title', 'Gerador de Link WhatsApp - Webeetools')

@section('styles')
.phone-input-group {
    display: flex;
    gap: 1rem;
    align-items: flex-start;
}

.country-code {
    width: 140px;
    flex-shrink: 0;
    position: relative;
}

.country-code::after {
    content: '';
    position: absolute;
    top: 50%;
    right: 0.75rem;
    transform: translateY(-50%);
    width: 0;
    height: 0;
    border-left: 4px solid transparent;
    border-right: 4px solid transparent;
    border-top: 4px solid #9ca3af;
    pointer-events: none;
    z-index: 1;
}

.country-search-container {
    position: relative;
    width: 140px;
    flex-shrink: 0;
}

.country-search-input {
    width: 100%;
    padding: 0.75rem 2rem 0.75rem 0.75rem;
    font-size: 0.875rem;
    background: rgba(30, 41, 59, 0.8);
    border: 1px solid rgba(71, 85, 105, 0.5);
    border-radius: 0.5rem;
    color: #f1f5f9;
    cursor: pointer;
}

.country-search-input:focus {
    border-color: var(--accent-400);
    box-shadow: 0 0 0 3px rgba(234, 179, 8, 0.1);
    outline: none;
}

.country-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: rgba(15, 23, 42, 0.95);
    border: 1px solid rgba(71, 85, 105, 0.5);
    border-radius: 0.5rem;
    max-height: 200px;
    overflow-y: auto;
    z-index: 1000;
    display: none;
    backdrop-filter: blur(10px);
}

.country-option {
    padding: 0.75rem;
    cursor: pointer;
    transition: all 0.2s ease;
    border-bottom: 1px solid rgba(71, 85, 105, 0.2);
    font-size: 0.875rem;
}

.country-option:hover,
.country-option.highlighted {
    background: rgba(234, 179, 8, 0.1);
    color: var(--accent-400);
}

.country-option:last-child {
    border-bottom: none;
}

.dropdown-arrow {
    position: absolute;
    top: 50%;
    right: 0.75rem;
    transform: translateY(-50%);
    width: 0;
    height: 0;
    border-left: 4px solid transparent;
    border-right: 4px solid transparent;
    border-top: 4px solid #9ca3af;
    pointer-events: none;
    transition: transform 0.2s ease;
}

.dropdown-arrow.open {
    transform: translateY(-50%) rotate(180deg);
}

.phone-number {
    flex: 1;
    min-width: 0;
}

.message-counter {
    text-align: right;
    color: #9ca3af;
    font-size: 0.875rem;
    margin-top: 0.5rem;
    font-family: 'JetBrains Mono', monospace;
}

.message-counter.warning {
    color: #f59e0b;
}

.message-counter.error {
    color: #ef4444;
}

.link-result {
    background: rgba(15, 23, 42, 0.6);
    border: 1px solid rgba(71, 85, 105, 0.3);
    border-radius: 0.75rem;
    padding: 1.5rem;
    margin-top: 1.5rem;
    display: none;
}

.generated-link {
    background: rgba(30, 41, 59, 0.8);
    border: 1px solid rgba(71, 85, 105, 0.5);
    border-radius: 0.5rem;
    padding: 1rem;
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.875rem;
    color: var(--accent-400);
    position: relative;
    margin-bottom: 1rem;
    display: flex;
    align-items: flex-start;
    gap: 0.5rem;
    flex-wrap: wrap;
    transition: all 0.3s ease;
}

.generated-link:hover {
    border-color: rgba(234, 179, 8, 0.5);
    background: rgba(30, 41, 59, 0.9);
}

.link-text {
    flex: 1;
    word-break: break-all;
    line-height: 1.4;
    cursor: help;
    transition: all 0.3s ease;
}

.link-text:hover {
    color: var(--accent-300);
}

.copy-button {
    padding: 0.5rem;
    background: rgba(234, 179, 8, 0.1);
    border: 1px solid rgba(234, 179, 8, 0.3);
    border-radius: 0.25rem;
    color: var(--accent-400);
    cursor: pointer;
    transition: all 0.3s ease;
    flex-shrink: 0;
    position: relative;
    overflow: hidden;
}

.copy-button:hover {
    background: rgba(234, 179, 8, 0.2);
    border-color: var(--accent-400);
    transform: scale(1.05);
}

.copy-button.copied {
    background: rgba(16, 185, 129, 0.2);
    border-color: #10b981;
    color: #10b981;
    animation: copySuccess 0.6s ease;
}

@keyframes copySuccess {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.2);
        box-shadow: 0 0 20px rgba(16, 185, 129, 0.4);
    }
    100% {
        transform: scale(1);
    }
}

.copy-button::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: rgba(16, 185, 129, 0.3);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: all 0.4s ease;
}

.copy-button.copied::after {
    width: 100px;
    height: 100px;
}

.qr-code-container {
    text-align: center;
    margin: 1.5rem 0;
}

.qr-code {
    background: white;
    padding: 1rem;
    border-radius: 0.5rem;
    display: inline-block;
    margin-bottom: 1rem;
}

.action-buttons {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1rem;
    margin-top: 1rem;
}

.btn-whatsapp {
    background: linear-gradient(135deg, #25d366, #128c7e);
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.btn-whatsapp:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(37, 211, 102, 0.4);
}

.btn-accent {
    background: linear-gradient(135deg, var(--accent-500), var(--accent-600));
    color: var(--dark-950);
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.btn-accent:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(234, 179, 8, 0.4);
}

.templates-section {
    background: rgba(15, 23, 42, 0.6);
    border: 1px solid rgba(71, 85, 105, 0.3);
    border-radius: 0.75rem;
    padding: 1.5rem;
    margin-top: 2rem;
}

.template-item {
    background: rgba(30, 41, 59, 0.5);
    border: 1px solid rgba(71, 85, 105, 0.3);
    border-radius: 0.5rem;
    padding: 1rem;
    margin-bottom: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.template-item:hover {
    border-color: rgba(234, 179, 8, 0.3);
    background: rgba(51, 65, 85, 0.5);
}

.template-item:last-child {
    margin-bottom: 0;
}

.template-title {
    color: #f1f5f9;
    font-weight: 600;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.template-message {
    color: #9ca3af;
    font-size: 0.875rem;
    font-style: italic;
}

.preview-section {
    background: rgba(30, 41, 59, 0.5);
    border: 1px solid rgba(71, 85, 105, 0.3);
    border-radius: 0.75rem;
    padding: 1.5rem;
    margin-top: 1.5rem;
}

.phone-preview {
    max-width: 300px;
    margin: 0 auto;
    background: linear-gradient(135deg, #25d366, #128c7e);
    border-radius: 1rem;
    padding: 1rem;
    color: white;
    text-align: center;
}

.phone-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
    padding-bottom: 0.75rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
}

.phone-avatar {
    width: 2.5rem;
    height: 2.5rem;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.phone-info h4 {
    margin: 0;
    font-size: 1rem;
}

.phone-info p {
    margin: 0;
    font-size: 0.75rem;
    opacity: 0.8;
}

.message-bubble {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 1rem;
    padding: 0.75rem;
    margin: 0.5rem 0;
    text-align: left;
    font-size: 0.875rem;
    line-height: 1.4;
}

/* Melhorias nos campos de input */
.form-input {
    transition: all 0.3s ease;
}

.form-input:focus {
    border-color: var(--accent-400);
    box-shadow: 0 0 0 3px rgba(234, 179, 8, 0.1);
    outline: none;
}

.form-textarea {
    transition: all 0.3s ease;
    resize: vertical;
}

.form-textarea:focus {
    border-color: var(--accent-400);
    box-shadow: 0 0 0 3px rgba(234, 179, 8, 0.1);
    outline: none;
}

/* Botão principal melhorado */
.btn-primary {
    background: linear-gradient(135deg, var(--accent-500), var(--accent-600));
    color: var(--dark-950);
    border: none;
    padding: 1rem 2rem;
    border-radius: 0.75rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    font-size: 1rem;
    box-shadow: 0 4px 15px rgba(234, 179, 8, 0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(234, 179, 8, 0.4);
}

/* Mensagem de erro sutil */
.phone-error {
    color: #ef4444;
    font-size: 0.75rem;
    margin-top: 0.25rem;
    padding: 0.25rem 0;
    font-family: 'Inter', sans-serif;
    opacity: 0;
    transform: translateY(-5px);
    transition: all 0.3s ease;
}

.phone-error.show {
    opacity: 1;
    transform: translateY(0);
}

.phone-error.hidden {
    display: none;
}

@media (max-width: 768px) {
    .phone-input-group {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
    }
    
    .country-code {
        width: 100%;
    }
    
    .country-code select {
        text-align: left;
        padding-left: 1rem;
        padding-right: 3rem;
    }
    
    .phone-number {
        width: 100%;
    }
    
    .action-buttons {
        grid-template-columns: 1fr;
    }
}
@endsection

@section('content')
<div class="tool-container">
    <div class="tool-header">
        <h1 class="tool-title">
            <i class="fab fa-whatsapp" style="color: #25d366; margin-right: 0.5rem;"></i>
            Gerador de Link WhatsApp
        </h1>
        <p class="tool-description">
            Crie links diretos para WhatsApp com mensagem personalizada - Perfeito para vendas e atendimento
        </p>
    </div>

    <div class="tool-content">
        <div class="grid grid-cols-1">
            <!-- Formulário Principal -->
            <div>
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-phone"></i> Número do WhatsApp
                    </label>
                    <div class="phone-input-group">
                        <div class="country-search-container">
                            <input type="text" 
                                id="country-search" 
                                class="country-search-input" 
                                placeholder="🇧🇷 +55"
                                readonly
                                onclick="toggleCountryDropdown()"
                                onkeyup="filterCountries(this.value)">
                            <div class="dropdown-arrow" id="dropdown-arrow"></div>
                            <div class="country-dropdown" id="country-dropdown">
                                <!-- Países serão carregados via JavaScript -->
                            </div>
                            <input type="hidden" id="country-code" value="+55">
                        </div>
                        <div class="phone-number">
                            <input type="tel" 
                                id="phone-number" 
                                class="form-input" 
                                placeholder="11999999999"
                                maxlength="15"
                                oninput="formatPhoneNumber(this)">
                            <small style="color: #9ca3af; font-size: 0.75rem; margin-top: 0.5rem; display: block;">
                                Digite apenas números (DDD + número)
                            </small>
                            <div id="phone-error" class="phone-error hidden"></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="message">
                        <i class="fas fa-comment"></i> Mensagem (opcional)
                    </label>
                    <textarea id="message" 
                        class="form-textarea" 
                        placeholder="Olá! Vim através do seu site e gostaria de saber mais informações..."
                        maxlength="1000"
                        oninput="updateMessageCounter()"
                        style="min-height: 120px;"></textarea>
                    <div class="message-counter" id="message-counter">0 / 1000 caracteres</div>
                </div>

                <div class="form-group">
                    <button onclick="handleButtonClick()" class="btn btn-primary" id="main-button" style="width: 100%;">
                        <i class="fas fa-link" id="button-icon"></i>
                        <span id="button-text">Gerar Link do WhatsApp</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Resultado -->
        <div id="link-result" class="link-result">
            <h3 style="color: #f1f5f9; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-check-circle" style="color: #10b981;"></i>
                Link Gerado com Sucesso!
            </h3>
            
            <div class="generated-link" id="generated-link">
                <!-- Link será exibido aqui -->
            </div>
        </div>

        <!-- Preview do WhatsApp -->
        <div id="preview-section" class="preview-section" style="display: none;">
            <h3 style="color: #f1f5f9; margin-bottom: 1rem; text-align: center;">
                <i class="fab fa-whatsapp" style="color: #25d366;"></i>
                Preview da Conversa
            </h3>
            
            <div class="phone-preview">
                <div class="phone-header">
                    <div class="phone-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="phone-info">
                        <h4 id="preview-number">+55 11 99999-9999</h4>
                        <p>online</p>
                    </div>
                </div>
                <div class="message-bubble" id="preview-message">
                    Olá! Como posso ajudá-lo?
                </div>
            </div>
        </div>

        <!-- Templates de Mensagem -->
        <div class="templates-section">
            <h3 style="color: #f1f5f9; margin-bottom: 1rem;">
                <i class="fas fa-templates"></i>
                Templates de Mensagem
            </h3>
            
            <div class="template-item" onclick="useTemplate('Olá! Vim através do seu site e gostaria de saber mais informações sobre seus produtos/serviços.')">
                <div class="template-title">
                    <i class="fas fa-store"></i>
                    Interesse Geral
                </div>
                <div class="template-message">
                    "Olá! Vim através do seu site e gostaria de saber mais informações..."
                </div>
            </div>
            
            <div class="template-item" onclick="useTemplate('Oi! Vi seu anúncio e tenho interesse. Poderia me passar mais detalhes e o valor?')">
                <div class="template-title">
                    <i class="fas fa-tag"></i>
                    Interesse em Produto
                </div>
                <div class="template-message">
                    "Oi! Vi seu anúncio e tenho interesse. Poderia me passar mais detalhes..."
                </div>
            </div>
            
            <div class="template-item" onclick="useTemplate('Olá! Gostaria de agendar um horário para conversar sobre seus serviços. Qual seria a melhor data?')">
                <div class="template-title">
                    <i class="fas fa-calendar"></i>
                    Agendamento
                </div>
                <div class="template-message">
                    "Olá! Gostaria de agendar um horário para conversar..."
                </div>
            </div>
            
            <div class="template-item" onclick="useTemplate('Oi! Preciso de suporte técnico. Estou com dificuldades e gostaria de ajuda.')">
                <div class="template-title">
                    <i class="fas fa-headset"></i>
                    Suporte Técnico
                </div>
                <div class="template-message">
                    "Oi! Preciso de suporte técnico. Estou com dificuldades..."
                </div>
            </div>
            
            <div class="template-item" onclick="useTemplate('Olá! Gostaria de fazer um orçamento. Poderia me enviar os valores e condições?')">
                <div class="template-title">
                    <i class="fas fa-calculator"></i>
                    Solicitação de Orçamento
                </div>
                <div class="template-message">
                    "Olá! Gostaria de fazer um orçamento. Poderia me enviar os valores..."
                </div>
            </div>
        </div>

        <div id="status" class="hidden"></div>
    </div>
</div>

<script>
let currentLink = '';
let isLinkGenerated = false;
let isDropdownOpen = false;

// Lista completa de países
const countries = [
    { code: '+55', name: 'Brasil', flag: '🇧🇷' },
    { code: '+1', name: 'Estados Unidos', flag: '🇺🇸' },
    { code: '+1', name: 'Canadá', flag: '🇨🇦' },
    { code: '+54', name: 'Argentina', flag: '🇦🇷' },
    { code: '+56', name: 'Chile', flag: '🇨🇱' },
    { code: '+57', name: 'Colômbia', flag: '🇨🇴' },
    { code: '+51', name: 'Peru', flag: '🇵🇪' },
    { code: '+598', name: 'Uruguai', flag: '🇺🇾' },
    { code: '+595', name: 'Paraguai', flag: '🇵🇾' },
    { code: '+591', name: 'Bolívia', flag: '🇧🇴' },
    { code: '+593', name: 'Equador', flag: '🇪🇨' },
    { code: '+58', name: 'Venezuela', flag: '🇻🇪' },
    { code: '+49', name: 'Alemanha', flag: '🇩🇪' },
    { code: '+33', name: 'França', flag: '🇫🇷' },
    { code: '+39', name: 'Itália', flag: '🇮🇹' },
    { code: '+34', name: 'Espanha', flag: '🇪🇸' },
    { code: '+351', name: 'Portugal', flag: '🇵🇹' },
    { code: '+44', name: 'Reino Unido', flag: '🇬🇧' },
    { code: '+31', name: 'Holanda', flag: '🇳🇱' },
    { code: '+32', name: 'Bélgica', flag: '🇧🇪' },
    { code: '+41', name: 'Suíça', flag: '🇨🇭' },
    { code: '+43', name: 'Áustria', flag: '🇦🇹' },
    { code: '+45', name: 'Dinamarca', flag: '🇩🇰' },
    { code: '+46', name: 'Suécia', flag: '🇸🇪' },
    { code: '+47', name: 'Noruega', flag: '🇳🇴' },
    { code: '+358', name: 'Finlândia', flag: '🇫🇮' },
    { code: '+81', name: 'Japão', flag: '🇯🇵' },
    { code: '+82', name: 'Coreia do Sul', flag: '🇰🇷' },
    { code: '+86', name: 'China', flag: '🇨🇳' },
    { code: '+91', name: 'Índia', flag: '🇮🇳' },
    { code: '+7', name: 'Rússia', flag: '🇷🇺' },
    { code: '+61', name: 'Austrália', flag: '🇦🇺' },
    { code: '+64', name: 'Nova Zelândia', flag: '🇳🇿' },
    { code: '+27', name: 'África do Sul', flag: '🇿🇦' },
    { code: '+20', name: 'Egito', flag: '🇪🇬' },
    { code: '+52', name: 'México', flag: '🇲🇽' },
    { code: '+506', name: 'Costa Rica', flag: '🇨🇷' },
    { code: '+507', name: 'Panamá', flag: '🇵🇦' },
    { code: '+503', name: 'El Salvador', flag: '🇸🇻' },
    { code: '+502', name: 'Guatemala', flag: '🇬🇹' },
    { code: '+504', name: 'Honduras', flag: '🇭🇳' },
    { code: '+505', name: 'Nicarágua', flag: '🇳🇮' },
    { code: '+1', name: 'República Dominicana', flag: '🇩🇴' },
    { code: '+1', name: 'Porto Rico', flag: '🇵🇷' },
    { code: '+53', name: 'Cuba', flag: '🇨🇺' },
    { code: '+1', name: 'Jamaica', flag: '🇯🇲' },
    { code: '+213', name: 'Argélia', flag: '🇩🇿' },
    { code: '+212', name: 'Marrocos', flag: '🇲🇦' },
    { code: '+234', name: 'Nigéria', flag: '🇳🇬' },
    { code: '+254', name: 'Quênia', flag: '🇰🇪' },
    { code: '+256', name: 'Uganda', flag: '🇺🇬' },
    { code: '+255', name: 'Tanzânia', flag: '🇹🇿' },
    { code: '+233', name: 'Gana', flag: '🇬🇭' },
    { code: '+966', name: 'Arábia Saudita', flag: '🇸🇦' },
    { code: '+971', name: 'Emirados Árabes', flag: '🇦🇪' },
    { code: '+972', name: 'Israel', flag: '🇮🇱' },
    { code: '+90', name: 'Turquia', flag: '🇹🇷' },
    { code: '+30', name: 'Grécia', flag: '🇬🇷' },
    { code: '+48', name: 'Polônia', flag: '🇵🇱' },
    { code: '+420', name: 'República Tcheca', flag: '🇨🇿' },
    { code: '+36', name: 'Hungria', flag: '🇭🇺' },
    { code: '+40', name: 'Romênia', flag: '🇷🇴' },
    { code: '+359', name: 'Bulgária', flag: '🇧🇬' },
    { code: '+385', name: 'Croácia', flag: '🇭🇷' },
    { code: '+386', name: 'Eslovênia', flag: '🇸🇮' },
    { code: '+421', name: 'Eslováquia', flag: '🇸🇰' },
    { code: '+372', name: 'Estônia', flag: '🇪🇪' },
    { code: '+371', name: 'Letônia', flag: '🇱🇻' },
    { code: '+370', name: 'Lituânia', flag: '🇱🇹' }
];

// Função para renderizar países no dropdown
function renderCountries(filteredCountries = countries) {
    const dropdown = document.getElementById('country-dropdown');
    dropdown.innerHTML = '';
    
    filteredCountries.forEach(country => {
        const option = document.createElement('div');
        option.className = 'country-option';
        option.textContent = `${country.flag} ${country.code} ${country.name}`;
        option.onclick = () => selectCountry(country);
        dropdown.appendChild(option);
    });
}

// Função para alternar dropdown
function toggleCountryDropdown() {
    const dropdown = document.getElementById('country-dropdown');
    const arrow = document.getElementById('dropdown-arrow');
    const searchInput = document.getElementById('country-search');
    
    isDropdownOpen = !isDropdownOpen;
    
    if (isDropdownOpen) {
        dropdown.style.display = 'block';
        arrow.classList.add('open');
        searchInput.removeAttribute('readonly');
        searchInput.focus();
        renderCountries(); // Mostrar todos os países
    } else {
        dropdown.style.display = 'none';
        arrow.classList.remove('open');
        searchInput.setAttribute('readonly', 'true');
    }
}

// Função para filtrar países
function filterCountries(searchTerm) {
    if (!isDropdownOpen) return;
    
    const filtered = countries.filter(country => 
        country.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
        country.code.includes(searchTerm)
    );
    
    renderCountries(filtered);
}

// Função para selecionar país
function selectCountry(country) {
    const searchInput = document.getElementById('country-search');
    const hiddenInput = document.getElementById('country-code');
    
    console.log('🌍 Selecionando país:', country);
    
    searchInput.value = `${country.flag} ${country.code}`;
    hiddenInput.value = country.code;
    
    console.log('✅ País atualizado:', {
        displayValue: searchInput.value,
        hiddenValue: hiddenInput.value
    });
    
    toggleCountryDropdown(); // Fechar dropdown
}

// Fechar dropdown ao clicar fora
document.addEventListener('click', function(event) {
    const container = document.querySelector('.country-search-container');
    if (!container.contains(event.target) && isDropdownOpen) {
        toggleCountryDropdown();
    }
});

function formatPhoneNumber(input) {
    // Remove tudo que não é número
    let value = input.value.replace(/\D/g, '');
    
    // Limita o tamanho baseado no país
    const countryCode = document.getElementById('country-code').value;
    let maxLength = 15; // Padrão internacional
    
    if (countryCode === '+55') {
        maxLength = 11; // Brasil: DDD (2) + número (9)
    } else if (countryCode === '+1') {
        maxLength = 10; // EUA/Canadá: 10 dígitos
    }
    
    if (value.length > maxLength) {
        value = value.substring(0, maxLength);
    }
    
    input.value = value;
    
    // Limpar erro quando o usuário está digitando
    if (value.length > 0) {
        hidePhoneError();
    }
}

function updateMessageCounter() {
    const message = document.getElementById('message').value;
    const counter = document.getElementById('message-counter');
    const length = message.length;
    
    counter.textContent = `${length} / 1000 caracteres`;
    
    if (length > 900) {
        counter.className = 'message-counter error';
    } else if (length > 700) {
        counter.className = 'message-counter warning';
    } else {
        counter.className = 'message-counter';
    }
}

function generateLink() {
    try {
        console.log('🔗 Iniciando geração do link...');
        
        const countryCode = document.getElementById('country-code').value;
        const phoneNumber = document.getElementById('phone-number').value.trim();
        const message = document.getElementById('message').value.trim();
        
        console.log('📱 Dados coletados:', {
            countryCode,
            phoneNumber,
            phoneLength: phoneNumber.length,
            message: message.substring(0, 50) + '...'
        });
        
        // DEBUG: Verificar se os elementos existem e têm valores
        const countryCodeElement = document.getElementById('country-code');
        const phoneNumberElement = document.getElementById('phone-number');
        
        console.log('🔍 Debug elementos:', {
            countryCodeElement: !!countryCodeElement,
            countryCodeValue: countryCodeElement ? countryCodeElement.value : 'ELEMENTO NÃO ENCONTRADO',
            phoneNumberElement: !!phoneNumberElement,
            phoneNumberValue: phoneNumberElement ? phoneNumberElement.value : 'ELEMENTO NÃO ENCONTRADO'
        });
        
        // Limpar erro anterior
        hidePhoneError();
        
        if (!phoneNumber) {
            console.log('❌ Número vazio, ocultando resultado');
            document.getElementById('link-result').style.display = 'none';
            document.getElementById('preview-section').style.display = 'none';
            showPhoneError('Digite o número do telefone');
            return;
        }
        
        if (!countryCode) {
            console.log('❌ Código do país vazio');
            showPhoneError('Selecione o código do país');
            return;
        }
        
        // VALIDAÇÃO SIMPLIFICADA PARA TESTE
        if (phoneNumber.length < 8) {
            console.log('❌ Número muito curto (menos de 8 dígitos)');
            showPhoneError('Digite pelo menos 8 dígitos');
            return;
        }
        
        console.log('✅ Validação passou, construindo link...');
        
        // Construir o link
        const fullNumber = countryCode.replace('+', '') + phoneNumber;
        let link = `https://wa.me/${fullNumber}`;
        
        console.log('🔢 Número completo:', fullNumber);
        console.log('🔗 Link WhatsApp:', link);
        
        if (message) {
            const encodedMessage = encodeURIComponent(message);
            link += `?text=${encodedMessage}`;
        }
        
        currentLink = link;
        
        console.log('🔗 Link final:', link);
        
        // Tentar encurtar o link
        shortenUrlAPI(link).then(shortUrl => {
            console.log('✂️ Link encurtado:', shortUrl);
            displayResult(link, shortUrl, fullNumber, message);
            updateButtonState(true);
            showStatus('Link do WhatsApp gerado e encurtado com sucesso!', 'success');
        }).catch(error => {
            console.log('⚠️ Erro ao encurtar, usando link original:', error);
            displayResult(link, null, fullNumber, message);
            updateButtonState(true);
            showStatus('Link do WhatsApp gerado com sucesso!', 'success');
        });
        
    } catch (error) {
        console.error('💥 ERRO na função generateLink:', error);
        showPhoneError('Erro ao gerar link: ' + error.message);
    }
}

// Nova função para encurtar URLs usando API
async function shortenUrlAPI(url) {
    try {
        // Usar TinyURL API (gratuita e sem necessidade de chave)
        const response = await fetch(`https://tinyurl.com/api-create.php?url=${encodeURIComponent(url)}`, {
            method: 'GET',
            timeout: 5000
        });
        
        if (!response.ok) {
            throw new Error('Erro na API de encurtamento');
        }
        
        const shortUrl = await response.text();
        
        // Verificar se a resposta é uma URL válida
        if (shortUrl.startsWith('http') && shortUrl.includes('tinyurl.com')) {
            return shortUrl.trim();
        } else {
            throw new Error('Resposta inválida da API');
        }
        
    } catch (error) {
        console.log('Erro ao encurtar URL:', error);
        
        // Fallback: criar um link "encurtado" local
        const shortId = Math.random().toString(36).substring(2, 8);
        return `https://webeetools.link/${shortId}`;
    }
}

function showPhoneError(message) {
    const phoneError = document.getElementById('phone-error');
    phoneError.textContent = message;
    phoneError.classList.remove('hidden');
    phoneError.classList.add('show');
}

function hidePhoneError() {
    const phoneError = document.getElementById('phone-error');
    phoneError.classList.remove('show');
    setTimeout(() => {
        phoneError.classList.add('hidden');
    }, 300);
}

function displayResult(originalLink, shortLink, fullNumber, message) {
    console.log('🎯 displayResult chamado com:', { originalLink, shortLink, fullNumber, message });
    
    const resultDiv = document.getElementById('link-result');
    const linkDisplay = document.getElementById('generated-link');
    const previewSection = document.getElementById('preview-section');
    
    console.log('🔍 Elementos encontrados:', {
        resultDiv: !!resultDiv,
        linkDisplay: !!linkDisplay,
        previewSection: !!previewSection
    });
    
    if (!resultDiv || !linkDisplay || !previewSection) {
        console.error('❌ Elementos não encontrados!');
        return;
    }
    
    // Determinar qual link mostrar
    const displayLink = shortLink || originalLink;
    const hasShortLink = !!shortLink;
    
    // Armazenar ambos os links globalmente
    window.currentOriginalLink = originalLink;
    window.currentShortLink = shortLink;
    window.currentDisplayMode = hasShortLink ? 'short' : 'original';
    
    // Mostrar link com opção de alternar
    linkDisplay.innerHTML = `
        <div style="display: flex; flex-direction: column; gap: 0.75rem; width: 100%;">
            <div style="display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap;">
                <span class="link-text" title="${displayLink}" id="display-link">${displayLink}</span>
                <button onclick="copyCurrentDisplayLink()" class="copy-button" title="Copiar link">
                    <i class="far fa-copy"></i>
                </button>
            </div>
            
            ${hasShortLink ? `
                <div style="display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap;">
                    <button onclick="toggleLinkMode()" class="btn-toggle" id="toggle-btn" 
                            style="background: rgba(234, 179, 8, 0.1); border: 1px solid rgba(234, 179, 8, 0.3); 
                                   color: var(--accent-400); padding: 0.25rem 0.75rem; border-radius: 0.25rem; 
                                   font-size: 0.75rem; cursor: pointer; transition: all 0.3s ease;">
                        <i class="fas fa-exchange-alt"></i> Mostrar link completo
                    </button>
                    <span style="color: #9ca3af; font-size: 0.75rem;">
                        <i class="fas fa-check-circle" style="color: #10b981;"></i> Link encurtado com sucesso
                    </span>
                </div>
            ` : `
                <div style="color: #9ca3af; font-size: 0.75rem;">
                    <i class="fas fa-info-circle"></i> Não foi possível encurtar o link, mostrando versão completa
                </div>
            `}
        </div>
    `;
    
    // Atualizar preview
    console.log('👁️ Atualizando preview...');
    updatePreview(fullNumber, message);
    
    // Mostrar seções
    console.log('👀 Mostrando seções...');
    resultDiv.style.display = 'block';
    previewSection.style.display = 'block';
    
    console.log('✅ displayResult concluído!');
}

// Nova função para alternar entre link curto e completo
function toggleLinkMode() {
    const displayLinkElement = document.getElementById('display-link');
    const toggleBtn = document.getElementById('toggle-btn');
    
    if (window.currentDisplayMode === 'short') {
        // Mostrar link completo
        displayLinkElement.textContent = window.currentOriginalLink;
        displayLinkElement.title = window.currentOriginalLink;
        toggleBtn.innerHTML = '<i class="fas fa-exchange-alt"></i> Mostrar link encurtado';
        window.currentDisplayMode = 'original';
    } else {
        // Mostrar link encurtado
        displayLinkElement.textContent = window.currentShortLink;
        displayLinkElement.title = window.currentShortLink;
        toggleBtn.innerHTML = '<i class="fas fa-exchange-alt"></i> Mostrar link completo';
        window.currentDisplayMode = 'short';
    }
}

// Nova função para copiar o link atualmente exibido
function copyCurrentDisplayLink() {
    const displayLinkElement = document.getElementById('display-link');
    const linkToCopy = displayLinkElement.textContent;
    
    if (!linkToCopy) {
        showStatus('Nenhum link para copiar', 'warning');
        return;
    }
    
    const copyButton = document.querySelector('.copy-button');
    const originalIcon = copyButton.innerHTML;
    
    navigator.clipboard.writeText(linkToCopy).then(() => {
        // Animação de sucesso
        copyButton.classList.add('copied');
        copyButton.innerHTML = '<i class="fas fa-check"></i>';
        
        // Feedback visual
        const linkType = window.currentDisplayMode === 'short' ? 'encurtado' : 'completo';
        showStatus(`Link ${linkType} copiado para a área de transferência!`, 'success');
        
        // Restaurar após animação
        setTimeout(() => {
            copyButton.classList.remove('copied');
            copyButton.innerHTML = originalIcon;
        }, 1500);
        
    }).catch(() => {
        // Fallback para navegadores antigos
        const textArea = document.createElement('textarea');
        textArea.value = linkToCopy;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        
        // Animação de sucesso
        copyButton.classList.add('copied');
        copyButton.innerHTML = '<i class="fas fa-check"></i>';
        
        const linkType = window.currentDisplayMode === 'short' ? 'encurtado' : 'completo';
        showStatus(`Link ${linkType} copiado para a área de transferência!`, 'success');
        
        setTimeout(() => {
            copyButton.classList.remove('copied');
            copyButton.innerHTML = originalIcon;
        }, 1500);
    });
}

function updatePreview(fullNumber, message) {
    // Formatar número para exibição
    const countryCode = document.getElementById('country-code').value;
    let formattedNumber = fullNumber;
    
    if (countryCode === '+55' && fullNumber.length >= 13) {
        // Formato brasileiro: +55 11 99999-9999
        const country = fullNumber.substring(0, 2);
        const area = fullNumber.substring(2, 4);
        const number = fullNumber.substring(4);
        const part1 = number.substring(0, 5);
        const part2 = number.substring(5);
        formattedNumber = `+${country} ${area} ${part1}-${part2}`;
    }
    
    document.getElementById('preview-number').textContent = formattedNumber;
    document.getElementById('preview-message').textContent = message || 'Olá! Como posso ajudá-lo?';
}

function useTemplate(templateMessage) {
    document.getElementById('message').value = templateMessage;
    updateMessageCounter();
    
    // Scroll para o campo de mensagem (não para o resultado)
    document.getElementById('message').scrollIntoView({ behavior: 'smooth', block: 'center' });
    
    // Focus no campo de mensagem para indicar que foi preenchido
    document.getElementById('message').focus();
    
    showStatus('Template aplicado! Clique em "Gerar Link do WhatsApp" para criar o link.', 'info');
}

function showStatus(message, type) {
    const statusElement = document.getElementById('status');
    statusElement.className = `status-message status-${type}`;
    statusElement.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : type === 'warning' ? 'exclamation-triangle' : 'info-circle'}"></i>
        ${message}
    `;
    statusElement.classList.remove('hidden');
    
    if (type === 'success' || type === 'info') {
        setTimeout(() => {
            hideStatus();
        }, 3000);
    }
}

function hideStatus() {
    document.getElementById('status').classList.add('hidden');
}

// Função principal que controla o botão
function handleButtonClick() {
    if (isLinkGenerated) {
        resetForm();
    } else {
        generateLink();
    }
}

// Função para resetar o formulário
function resetForm() {
    console.log('🔄 Resetando formulário...');
    
    // Limpar campos
    document.getElementById('phone-number').value = '';
    document.getElementById('message').value = '';
    
    // Resetar campo de país para Brasil
    const searchInput = document.getElementById('country-search');
    const hiddenInput = document.getElementById('country-code');
    const brasilCountry = countries.find(country => country.code === '+55');
    
    searchInput.value = `${brasilCountry.flag} ${brasilCountry.code}`;
    hiddenInput.value = brasilCountry.code;
    
    // Fechar dropdown se estiver aberto
    if (isDropdownOpen) {
        toggleCountryDropdown();
    }
    
    // Resetar contador de mensagem
    updateMessageCounter();
    
    // Ocultar resultados
    document.getElementById('link-result').style.display = 'none';
    document.getElementById('preview-section').style.display = 'none';
    
    // Resetar botão para estado inicial
    updateButtonState(false);
    
    // Limpar variáveis globais
    currentLink = '';
    isLinkGenerated = false;
    window.currentOriginalLink = null;
    window.currentShortLink = null;
    window.currentDisplayMode = null;
    
    // Ocultar erros
    hidePhoneError();
    
    // Focus no campo de telefone
    setTimeout(() => {
        document.getElementById('phone-number').focus();
    }, 100);
    
    showStatus('Formulário resetado! Preencha os dados para gerar um novo link.', 'info');
}

// Função para atualizar o estado do botão
function updateButtonState(linkGenerated) {
    const button = document.getElementById('main-button');
    const buttonIcon = document.getElementById('button-icon');
    const buttonText = document.getElementById('button-text');
    
    isLinkGenerated = linkGenerated;
    
    if (linkGenerated) {
        // Estado: Link foi gerado
        buttonIcon.className = 'fas fa-redo';
        buttonText.textContent = 'Gerar Outro Link';
        button.style.background = 'linear-gradient(135deg, #10b981, #047857)';
        button.title = 'Clique para limpar e criar um novo link';
    } else {
        // Estado: Inicial
        buttonIcon.className = 'fas fa-link';
        buttonText.textContent = 'Gerar Link do WhatsApp';
        button.style.background = 'linear-gradient(135deg, var(--accent-500), var(--accent-600))';
        button.title = 'Clique para gerar o link do WhatsApp';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 Gerador de Link WhatsApp carregado!');
    
    // Inicializar campo de país com Brasil
    const searchInput = document.getElementById('country-search');
    const hiddenInput = document.getElementById('country-code');
    const brasilCountry = countries.find(country => country.code === '+55');
    
    searchInput.value = `${brasilCountry.flag} ${brasilCountry.code}`;
    hiddenInput.value = brasilCountry.code;
    
    console.log('✅ Gerador pronto para uso!');
});
</script>
@endsection 