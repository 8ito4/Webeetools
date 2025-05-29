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
}

.country-code select {
    font-size: 0.875rem;
    padding: 0.75rem 0.5rem;
    text-align: center;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 0.5rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    padding-right: 2.5rem;
    width: 100%;
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
                        <div class="country-code">
                            <select id="country-code" class="form-input">
                                <option value="+55">🇧🇷 +55</option>
                                <option value="+1">🇺🇸 +1</option>
                                <option value="+54">🇦🇷 +54</option>
                                <option value="+56">🇨🇱 +56</option>
                                <option value="+57">🇨🇴 +57</option>
                                <option value="+51">🇵🇪 +51</option>
                                <option value="+598">🇺🇾 +598</option>
                                <option value="+595">🇵🇾 +595</option>
                                <option value="+591">🇧🇴 +591</option>
                                <option value="+593">🇪🇨 +593</option>
                                <option value="+58">🇻🇪 +58</option>
                            </select>
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
                    <button onclick="generateLink()" class="btn btn-primary" style="width: 100%;">
                        <i class="fas fa-link"></i>
                        Gerar Link do WhatsApp
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

document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 Gerador de Link WhatsApp carregado!');
    
    console.log('✅ Gerador pronto para uso!');
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
        
        // Limpar erro anterior
        hidePhoneError();
        
        if (!phoneNumber) {
            console.log('❌ Número vazio, ocultando resultado');
            document.getElementById('link-result').style.display = 'none';
            document.getElementById('preview-section').style.display = 'none';
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
        
        if (message) {
            const encodedMessage = encodeURIComponent(message);
            link += `?text=${encodedMessage}`;
        }
        
        currentLink = link;
        
        console.log('🔗 Link gerado:', link);
        console.log('📱 Chamando displayResult...');
        
        // Exibir resultado
        displayResult(link, fullNumber, message);
        
        console.log('✅ displayResult chamado, mostrando status...');
        showStatus('Link do WhatsApp gerado com sucesso!', 'success');
        
    } catch (error) {
        console.error('💥 ERRO na função generateLink:', error);
        alert('Erro: ' + error.message);
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

function displayResult(link, fullNumber, message) {
    console.log('🎯 displayResult chamado com:', { link, fullNumber, message });
    
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
    
    // Encurtar link para exibição
    const displayLink = shortenLink(link);
    
    // Mostrar link encurtado com tooltip do link completo
    const isShortened = link.length > 60;
    linkDisplay.innerHTML = `
        <span class="link-text" title="${link}">${displayLink}</span>
        <button onclick="copyCurrentLink()" class="copy-button" title="Copiar link completo">
            <i class="far fa-copy"></i>
        </button>
        ${isShortened ? `
            <div style="color: #9ca3af; font-size: 0.75rem; margin-top: 0.5rem; width: 100%;">
                <i class="fas fa-info-circle"></i> Link encurtado para visualização. Passe o mouse para ver completo.
            </div>
        ` : ''}
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

function shortenLink(link) {
    const maxLength = 60; // Comprimento máximo para exibição
    
    if (link.length <= maxLength) {
        return link;
    }
    
    // Pegar o início e o final do link
    const start = link.substring(0, 30);
    const end = link.substring(link.length - 20);
    
    return `${start}<span style="color: #9ca3af; font-weight: bold;">...</span>${end}`;
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
    generateLink();
    
    // Scroll para o resultado
    document.getElementById('message').scrollIntoView({ behavior: 'smooth', block: 'center' });
    
    showStatus('Template aplicado com sucesso!', 'success');
}

function copyCurrentLink() {
    if (!currentLink) {
        showStatus('Nenhum link para copiar', 'warning');
        return;
    }
    
    const copyButton = document.querySelector('.copy-button');
    const originalIcon = copyButton.innerHTML;
    
    navigator.clipboard.writeText(currentLink).then(() => {
        // Animação de sucesso
        copyButton.classList.add('copied');
        copyButton.innerHTML = '<i class="fas fa-check"></i>';
        
        // Feedback visual
        showStatus('Link copiado para a área de transferência!', 'success');
        
        // Restaurar após animação
        setTimeout(() => {
            copyButton.classList.remove('copied');
            copyButton.innerHTML = originalIcon;
        }, 1500);
        
    }).catch(() => {
        // Fallback para navegadores antigos
        const textArea = document.createElement('textarea');
        textArea.value = currentLink;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        
        // Animação de sucesso
        copyButton.classList.add('copied');
        copyButton.innerHTML = '<i class="fas fa-check"></i>';
        
        showStatus('Link copiado para a área de transferência!', 'success');
        
        setTimeout(() => {
            copyButton.classList.remove('copied');
            copyButton.innerHTML = originalIcon;
        }, 1500);
    });
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
</script>
@endsection 