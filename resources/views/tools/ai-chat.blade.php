@extends('layouts.modern')

@section('title', 'Chat com IA - Webeetools')

@section('styles')
<style>
/* AI Chat Styles */
.ai-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

.page-title {
    text-align: center;
    margin-bottom: 3rem;
}

.page-title h1 {
    font-size: clamp(2.5rem, 5vw, 4rem);
    font-weight: 700;
    color: white;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
}

.page-title p {
    font-size: 1.25rem;
    color: #9ca3af;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
}

.ai-section {
    background: linear-gradient(135deg, rgba(15, 23, 42, 0.6) 0%, rgba(30, 41, 59, 0.4) 50%, rgba(15, 23, 42, 0.6) 100%);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(30, 41, 59, 0.5);
    border-radius: 1.5rem;
    padding: 2rem;
    margin-bottom: 2rem;
    height: 600px;
    display: flex;
    flex-direction: column;
}

.section-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: white;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.chat-container {
    flex: 1;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.chat-messages {
    flex: 1;
    overflow-y: auto;
    padding: 1rem;
    background: rgba(15, 23, 42, 0.3);
    border-radius: 1rem;
    margin-bottom: 1rem;
    border: 1px solid rgba(71, 85, 105, 0.3);
}

.message {
    margin-bottom: 1rem;
    display: flex;
    gap: 0.75rem;
    animation: messageSlide 0.3s ease-out;
}

.message.user {
    flex-direction: row-reverse;
}

.message-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.125rem;
    flex-shrink: 0;
}

.message.user .message-avatar {
    background: linear-gradient(135deg, #eab308, #ca8a04);
    color: #0f172a;
}

.message.ai .message-avatar {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    color: white;
    animation: aiPulse 2s ease-in-out infinite;
}

.message-content {
    background: rgba(30, 41, 59, 0.5);
    border-radius: 1rem;
    padding: 1rem;
    max-width: 70%;
    border: 1px solid rgba(71, 85, 105, 0.3);
}

.message.user .message-content {
    background: rgba(234, 179, 8, 0.1);
    border-color: rgba(234, 179, 8, 0.3);
}

.message.ai .message-content {
    background: rgba(59, 130, 246, 0.1);
    border-color: rgba(59, 130, 246, 0.3);
}

.message-text {
    color: #e2e8f0;
    line-height: 1.6;
    margin: 0;
}

.message-time {
    font-size: 0.75rem;
    color: #9ca3af;
    margin-top: 0.5rem;
}

.chat-input-container {
    display: flex;
    gap: 1rem;
    align-items: flex-end;
}

.chat-input {
    flex: 1;
    background: rgba(30, 41, 59, 0.5);
    border: 1px solid rgba(71, 85, 105, 0.5);
    border-radius: 1rem;
    padding: 1rem;
    color: white;
    font-size: 1rem;
    resize: none;
    min-height: 50px;
    max-height: 120px;
    transition: all 0.3s ease;
}

.chat-input:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    background: rgba(30, 41, 59, 0.7);
}

.send-button {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    border: none;
    border-radius: 1rem;
    padding: 1rem;
    color: white;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
}

.send-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
}

.send-button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none;
}

.typing-indicator {
    display: none;
    align-items: center;
    gap: 0.5rem;
    color: #9ca3af;
    font-style: italic;
    margin-bottom: 1rem;
}

.typing-dots {
    display: flex;
    gap: 0.25rem;
}

.typing-dot {
    width: 6px;
    height: 6px;
    background: #3b82f6;
    border-radius: 50%;
    animation: typingBounce 1.4s ease-in-out infinite;
}

.typing-dot:nth-child(2) { animation-delay: 0.2s; }
.typing-dot:nth-child(3) { animation-delay: 0.4s; }

.welcome-message {
    text-align: center;
    color: #9ca3af;
    padding: 2rem;
    font-style: italic;
}

.suggestions {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-top: 1rem;
}

.suggestion-chip {
    background: rgba(59, 130, 246, 0.1);
    border: 1px solid rgba(59, 130, 246, 0.3);
    border-radius: 1rem;
    padding: 0.5rem 1rem;
    color: #3b82f6;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 0.875rem;
}

.suggestion-chip:hover {
    background: rgba(59, 130, 246, 0.2);
    transform: translateY(-1px);
}

@keyframes messageSlide {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes aiPulse {
    0%, 100% {
        box-shadow: 0 0 10px rgba(59, 130, 246, 0.3);
    }
    50% {
        box-shadow: 0 0 20px rgba(59, 130, 246, 0.6);
    }
}

@keyframes typingBounce {
    0%, 60%, 100% {
        transform: translateY(0);
    }
    30% {
        transform: translateY(-10px);
    }
}

/* Scrollbar personalizada */
.chat-messages::-webkit-scrollbar {
    width: 6px;
}

.chat-messages::-webkit-scrollbar-track {
    background: rgba(15, 23, 42, 0.3);
    border-radius: 3px;
}

.chat-messages::-webkit-scrollbar-thumb {
    background: rgba(59, 130, 246, 0.5);
    border-radius: 3px;
}

.chat-messages::-webkit-scrollbar-thumb:hover {
    background: rgba(59, 130, 246, 0.7);
}

/* Responsivo */
@media (max-width: 768px) {
    .ai-container {
        padding: 1rem;
    }
    
    .page-title h1 {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .ai-section {
        height: 500px;
        padding: 1.5rem;
    }
    
    .message-content {
        max-width: 85%;
    }
    
    .chat-input-container {
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .send-button {
        width: 100%;
        height: 50px;
        border-radius: 0.75rem;
    }
}
</style>
@endsection

@section('content')
<div class="tool-container">
    <!-- Page Title -->
    <div class="page-title">
        <h1>
            <div class="ai-button-icon" style="font-size: 2rem;">
                <i class="fas fa-star star" style="color: #fbbf24;"></i>
                <i class="fas fa-sparkles star" style="color: #3b82f6;"></i>
                <i class="fas fa-star star" style="color: #fbbf24;"></i>
            </div>
            Chat com IA
        </h1>
        <p>
            Converse com nossa inteligência artificial. Faça perguntas, peça ajuda ou simplesmente bata um papo!
        </p>
    </div>

    <div class="ai-container">
        <!-- Chat Section -->
        <div class="ai-section">
            <h3 class="section-title">
                <i class="fas fa-comments" style="color: #3b82f6;"></i>
                Conversa
            </h3>
            
            <div class="chat-container">
                <div class="chat-messages" id="chatMessages">
                    <div class="welcome-message">
                        <p>👋 Olá! Sou sua assistente de IA. Como posso ajudar você hoje?</p>
                        <div class="suggestions">
                            <div class="suggestion-chip" onclick="sendSuggestion('Como usar as ferramentas do Webeetools?')">
                                Como usar as ferramentas?
                            </div>
                            <div class="suggestion-chip" onclick="sendSuggestion('Explique sobre desenvolvimento web')">
                                Desenvolvimento web
                            </div>
                            <div class="suggestion-chip" onclick="sendSuggestion('Dicas de programação')">
                                Dicas de programação
                            </div>
                            <div class="suggestion-chip" onclick="sendSuggestion('Gerar código HTML/CSS')">
                                Gerar código
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="typing-indicator" id="typingIndicator">
                    <i class="fas fa-robot" style="color: #3b82f6;"></i>
                    <span>IA está digitando</span>
                    <div class="typing-dots">
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                    </div>
                </div>
                
                <div class="chat-input-container">
                    <textarea 
                        id="chatInput" 
                        class="chat-input" 
                        placeholder="Digite sua mensagem..."
                        rows="1"
                    ></textarea>
                    <button id="sendButton" class="send-button">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// ===== AI CHAT SYSTEM =====
class AIChat {
    constructor() {
        this.messages = [];
        this.isTyping = false;
        
        // Elementos DOM
        this.chatMessages = document.getElementById('chatMessages');
        this.chatInput = document.getElementById('chatInput');
        this.sendButton = document.getElementById('sendButton');
        this.typingIndicator = document.getElementById('typingIndicator');
        
        this.init();
    }
    
    init() {
        console.log('🤖 Inicializando AI Chat...');
        
        // Event listeners
        this.sendButton.addEventListener('click', () => this.sendMessage());
        this.chatInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                this.sendMessage();
            }
        });
        
        // Auto-resize textarea
        this.chatInput.addEventListener('input', () => {
            this.chatInput.style.height = 'auto';
            this.chatInput.style.height = Math.min(this.chatInput.scrollHeight, 120) + 'px';
        });
        
        console.log('✅ AI Chat inicializado!');
    }
    
    sendMessage() {
        const message = this.chatInput.value.trim();
        if (!message || this.isTyping) return;
        
        // Adicionar mensagem do usuário
        this.addMessage('user', message);
        this.chatInput.value = '';
        this.chatInput.style.height = 'auto';
        
        // Simular resposta da IA
        this.simulateAIResponse(message);
    }
    
    addMessage(type, text, time = null) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${type}`;
        
        const currentTime = time || new Date().toLocaleTimeString('pt-BR', {
            hour: '2-digit',
            minute: '2-digit'
        });
        
        messageDiv.innerHTML = `
            <div class="message-avatar">
                ${type === 'user' ? '<i class="fas fa-user"></i>' : '<i class="fas fa-robot"></i>'}
            </div>
            <div class="message-content">
                <p class="message-text">${text}</p>
                <div class="message-time">${currentTime}</div>
            </div>
        `;
        
        // Remover mensagem de boas-vindas se existir
        const welcomeMessage = this.chatMessages.querySelector('.welcome-message');
        if (welcomeMessage) {
            welcomeMessage.remove();
        }
        
        this.chatMessages.appendChild(messageDiv);
        this.scrollToBottom();
        
        this.messages.push({ type, text, time: currentTime });
    }
    
    simulateAIResponse(userMessage) {
        this.isTyping = true;
        this.sendButton.disabled = true;
        this.showTypingIndicator();
        
        // Simular delay de digitação
        setTimeout(() => {
            const response = this.generateAIResponse(userMessage);
            this.hideTypingIndicator();
            this.addMessage('ai', response);
            this.isTyping = false;
            this.sendButton.disabled = false;
        }, Math.random() * 2000 + 1000); // 1-3 segundos
    }
    
    generateAIResponse(message) {
        const lowerMessage = message.toLowerCase();
        
        // Respostas específicas sobre o Webeetools
        if (lowerMessage.includes('webeetools') || lowerMessage.includes('ferramentas')) {
            return `🛠️ O Webeetools oferece mais de 9 ferramentas gratuitas para desenvolvedores! Temos gerador de senhas, formatador JSON, testador de API, gerador de Lorem Ipsum, Pomodoro Timer e muito mais. Todas as ferramentas são 100% gratuitas e não coletamos seus dados.`;
        }
        
        if (lowerMessage.includes('como usar') || lowerMessage.includes('tutorial')) {
            return `📚 É muito simples! Navegue pela página inicial e clique na ferramenta que deseja usar. Cada ferramenta tem uma interface intuitiva com instruções claras. Por exemplo, no Gerador de Senhas você pode ajustar o comprimento e tipos de caracteres, no Formatador JSON você cola seu código e ele formata automaticamente!`;
        }
        
        if (lowerMessage.includes('desenvolvimento web') || lowerMessage.includes('web dev')) {
            return `💻 Desenvolvimento web é uma área fascinante! Envolve HTML para estrutura, CSS para estilo e JavaScript para interatividade. No backend temos linguagens como PHP, Python, Node.js. O Webeetools pode ajudar com ferramentas como testador de API, gerador de dados de teste e formatadores de código!`;
        }
        
        if (lowerMessage.includes('programação') || lowerMessage.includes('código')) {
            return `👨‍💻 Algumas dicas valiosas: 1) Pratique todos os dias, mesmo que por 30 minutos; 2) Leia código de outros desenvolvedores; 3) Use ferramentas como as do Webeetools para agilizar seu trabalho; 4) Documente seu código; 5) Teste sempre suas aplicações!`;
        }
        
        if (lowerMessage.includes('html') || lowerMessage.includes('css')) {
            return `🎨 HTML e CSS são a base do frontend! HTML estrutura o conteúdo e CSS define a aparência. Dica: use o gerador de Lorem Ipsum do Webeetools para texto placeholder e o formatador JSON para organizar dados de configuração!`;
        }
        
        if (lowerMessage.includes('javascript') || lowerMessage.includes('js')) {
            return `⚡ JavaScript é a linguagem que dá vida às páginas web! Permite interatividade, manipulação do DOM, requisições AJAX e muito mais. Use nosso testador de API para testar suas chamadas JavaScript!`;
        }
        
        if (lowerMessage.includes('api') || lowerMessage.includes('rest')) {
            return `🔌 APIs são essenciais no desenvolvimento moderno! Permitem comunicação entre sistemas. Use nosso Testador de API para fazer requisições GET, POST, PUT, DELETE e ver as respostas em tempo real. Muito útil para debug!`;
        }
        
        if (lowerMessage.includes('json')) {
            return `📋 JSON é o formato padrão para troca de dados na web! Use nosso Formatador JSON para validar, formatar e minificar seus dados JSON. Muito útil para APIs e configurações!`;
        }
        
        if (lowerMessage.includes('senha') || lowerMessage.includes('password')) {
            return `🔐 Senhas seguras são fundamentais! Use nosso Gerador de Senhas para criar senhas fortes com diferentes tipos de caracteres. Recomendo pelo menos 12 caracteres com maiúsculas, minúsculas, números e símbolos!`;
        }
        
        if (lowerMessage.includes('pomodoro') || lowerMessage.includes('produtividade')) {
            return `🍅 A técnica Pomodoro é excelente para produtividade! 25 minutos de foco + 5 minutos de pausa. Use nosso Pomodoro Timer para manter o ritmo e aumentar sua concentração no desenvolvimento!`;
        }
        
        // Respostas gerais
        const responses = [
            `Interessante pergunta! 🤔 Como posso ajudar você com mais detalhes sobre isso?`,
            `Entendi! 💡 Você gostaria que eu elabore mais sobre algum aspecto específico?`,
            `Ótima questão! 🎯 Posso explicar melhor ou você tem alguma dúvida específica?`,
            `Compreendo! 📝 Há algo particular sobre isso que você gostaria de saber?`,
            `Perfeito! ✨ Como posso tornar essa informação mais útil para você?`,
            `Excelente! 🚀 Você gostaria de exemplos práticos ou mais teoria sobre isso?`,
            `Muito bem! 🎉 Posso ajudar com algum exemplo ou caso de uso específico?`
        ];
        
        return responses[Math.floor(Math.random() * responses.length)];
    }
    
    showTypingIndicator() {
        this.typingIndicator.style.display = 'flex';
        this.scrollToBottom();
    }
    
    hideTypingIndicator() {
        this.typingIndicator.style.display = 'none';
    }
    
    scrollToBottom() {
        setTimeout(() => {
            this.chatMessages.scrollTop = this.chatMessages.scrollHeight;
        }, 100);
    }
}

// Função para sugestões
function sendSuggestion(text) {
    const chatInput = document.getElementById('chatInput');
    chatInput.value = text;
    chatInput.focus();
    
    // Simular envio
    setTimeout(() => {
        aiChat.sendMessage();
    }, 100);
}

// Inicializar chat
let aiChat;
document.addEventListener('DOMContentLoaded', function() {
    aiChat = new AIChat();
});
</script>
@endsection 