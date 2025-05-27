@extends('layouts.modern')

@section('title', 'Testador de Webhook - Webeetools')

@section('styles')
<style>
/* Webhook Tester Styles */
.webhook-container {
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

.webhook-section {
    background: linear-gradient(135deg, rgba(15, 23, 42, 0.6) 0%, rgba(30, 41, 59, 0.4) 50%, rgba(15, 23, 42, 0.6) 100%);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(30, 41, 59, 0.5);
    border-radius: 1.5rem;
    padding: 2rem;
    margin-bottom: 2rem;
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

.webhook-form {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
    flex-wrap: wrap;
}

.form-input {
    flex: 1;
    min-width: 200px;
    background: rgba(30, 41, 59, 0.5);
    border: 1px solid rgba(71, 85, 105, 0.5);
    border-radius: 0.75rem;
    padding: 1rem;
    color: white;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-input:focus {
    outline: none;
    border-color: #eab308;
    box-shadow: 0 0 0 3px rgba(234, 179, 8, 0.1);
    background: rgba(30, 41, 59, 0.7);
}

.btn {
    padding: 1rem 2rem;
    border: none;
    border-radius: 0.75rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    text-decoration: none;
    font-size: 1rem;
}

.btn-primary {
    background: linear-gradient(135deg, #eab308, #ca8a04);
    color: #0f172a;
    box-shadow: 0 4px 15px rgba(234, 179, 8, 0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(234, 179, 8, 0.4);
}

.btn-danger {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
    box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
}

.btn-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
}

.webhook-info {
    background: rgba(15, 23, 42, 0.3);
    border-radius: 1rem;
    padding: 1.5rem;
    border: 1px solid rgba(71, 85, 105, 0.3);
}

.webhook-url {
    background: rgba(30, 41, 59, 0.5);
    border: 1px solid rgba(71, 85, 105, 0.5);
    border-radius: 0.5rem;
    padding: 1rem;
    font-family: 'JetBrains Mono', monospace;
    color: #eab308;
    word-break: break-all;
    margin: 1rem 0;
    position: relative;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.webhook-url-text {
    flex: 1;
}

.url-actions {
    display: flex;
    gap: 0.25rem;
    align-items: center;
}

.copy-btn, .delete-btn {
    background: rgba(71, 85, 105, 0.5);
    border: none;
    border-radius: 0.25rem;
    color: #9ca3af;
    padding: 0.5rem;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
}

.copy-btn:hover {
    background: rgba(234, 179, 8, 0.2);
    color: #eab308;
}

.delete-btn:hover {
    background: rgba(239, 68, 68, 0.2);
    color: #ef4444;
}

.waiting-animation {
    text-align: center;
    padding: 3rem;
    color: #9ca3af;
}

.listening-indicator {
    display: inline-block;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, #eab308, #f59e0b);
    margin: 0 auto 1.5rem;
    position: relative;
    animation: listening-core 3s ease-in-out infinite;
    box-shadow: 0 0 15px rgba(234, 179, 8, 0.3);
}

.listening-indicator::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 120%;
    height: 120%;
    border-radius: 50%;
    background: rgba(234, 179, 8, 0.3);
    animation: listening-layer1 3s ease-in-out infinite;
    z-index: -1;
}

.listening-indicator::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 150%;
    height: 150%;
    border-radius: 50%;
    background: rgba(234, 179, 8, 0.15);
    animation: listening-layer2 3s ease-in-out infinite 0.5s;
    z-index: -2;
}

/* Terceira camada usando JavaScript */
.listening-layer3 {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 180%;
    height: 180%;
    border-radius: 50%;
    background: rgba(234, 179, 8, 0.08);
    animation: listening-layer3 3s ease-in-out infinite 1s;
    z-index: -3;
    pointer-events: none;
}

@keyframes listening-core {
    0%, 100% { 
        transform: scale(1);
        box-shadow: 0 0 15px rgba(234, 179, 8, 0.3);
    }
    25% { 
        transform: scale(1.05);
        box-shadow: 0 0 20px rgba(234, 179, 8, 0.5);
    }
    50% { 
        transform: scale(1.1);
        box-shadow: 0 0 25px rgba(234, 179, 8, 0.4);
    }
    75% { 
        transform: scale(1.03);
        box-shadow: 0 0 18px rgba(234, 179, 8, 0.3);
    }
}

@keyframes listening-layer1 {
    0%, 100% { 
        transform: translate(-50%, -50%) scale(1);
        opacity: 0.3;
    }
    25% { 
        transform: translate(-50%, -50%) scale(1.15);
        opacity: 0.5;
    }
    50% { 
        transform: translate(-50%, -50%) scale(1.3);
        opacity: 0.4;
    }
    75% { 
        transform: translate(-50%, -50%) scale(1.08);
        opacity: 0.2;
    }
}

@keyframes listening-layer2 {
    0%, 100% { 
        transform: translate(-50%, -50%) scale(1);
        opacity: 0.15;
    }
    25% { 
        transform: translate(-50%, -50%) scale(1.2);
        opacity: 0.3;
    }
    50% { 
        transform: translate(-50%, -50%) scale(1.4);
        opacity: 0.2;
    }
    75% { 
        transform: translate(-50%, -50%) scale(1.15);
        opacity: 0.1;
    }
}

@keyframes listening-layer3 {
    0%, 100% { 
        transform: translate(-50%, -50%) scale(1);
        opacity: 0.08;
    }
    25% { 
        transform: translate(-50%, -50%) scale(1.25);
        opacity: 0.2;
    }
    50% { 
        transform: translate(-50%, -50%) scale(1.5);
        opacity: 0.15;
    }
    75% { 
        transform: translate(-50%, -50%) scale(1.2);
        opacity: 0.05;
    }
}

.pulse-dot {
    display: inline-block;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #eab308;
    margin: 0 2px;
    animation: pulse 1.5s ease-in-out infinite;
}

.pulse-dot:nth-child(2) { animation-delay: 0.2s; }
.pulse-dot:nth-child(3) { animation-delay: 0.4s; }

@keyframes pulse {
    0%, 80%, 100% { opacity: 0.3; transform: scale(1); }
    40% { opacity: 1; transform: scale(1.2); }
}

.request-card {
    background: rgba(15, 23, 42, 0.3);
    border: 1px solid rgba(71, 85, 105, 0.3);
    border-radius: 1rem;
    padding: 1.5rem;
    margin-bottom: 1rem;
    transition: all 0.3s ease;
}

.request-card:hover {
    border-color: rgba(234, 179, 8, 0.3);
    transform: translateY(-2px);
}

.request-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.request-method {
    padding: 0.25rem 0.75rem;
    border-radius: 0.5rem;
    font-weight: 600;
    font-size: 0.875rem;
}

.method-get { background: #10b981; color: white; }
.method-post { background: #3b82f6; color: white; }
.method-put { background: #f59e0b; color: white; }
.method-delete { background: #ef4444; color: white; }

.request-time {
    color: #9ca3af;
    font-size: 0.875rem;
}

.request-details {
    display: grid;
    gap: 1rem;
}

.detail-section {
    background: rgba(30, 41, 59, 0.3);
    border-radius: 0.5rem;
    padding: 1rem;
}

.detail-title {
    font-weight: 600;
    color: #eab308;
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.detail-content {
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.875rem;
    color: #e2e8f0;
    white-space: pre-wrap;
    word-break: break-word;
}

@media (max-width: 768px) {
    .webhook-container {
        padding: 1rem;
    }
    
    .webhook-form {
        flex-direction: column;
    }
    
    .page-title h1 {
        flex-direction: column;
        gap: 0.5rem;
    }
}
</style>
@endsection

@section('content')
<div class="tool-container">
    <!-- Page Title -->
    <div class="page-title">
        <h1>
            <i class="fas fa-satellite-dish" style="color: #eab308;"></i>
            Testador de Webhook
        </h1>
        <p>
            Teste e monitore webhooks em tempo real. Crie um endpoint temporário e veja as requisições chegando.
        </p>
    </div>

    <div class="webhook-container">
        @if(!$webhook)
            <!-- Create Webhook Form -->
            <div class="webhook-section">
                <h3 class="section-title">
                    <i class="fas fa-plus-circle" style="color: #eab308;"></i>
                    Criar Webhook
                </h3>
                
                <form action="{{ route('tools.webhook.create') }}" method="POST" class="webhook-form">
                    @csrf
                    <input type="text" name="project_name" placeholder="Nome do projeto (opcional)" class="form-input" value="{{ old('project_name') }}">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-rocket"></i>
                        Criar Webhook
                    </button>
                </form>
                
                @if($errors->any())
                    <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); border-radius: 0.5rem; padding: 1rem; margin-top: 1rem;">
                        <p style="color: #ef4444; margin: 0;">
                            <i class="fas fa-exclamation-triangle"></i>
                            {{ $errors->first() }}
                        </p>
                    </div>
                @endif

                @if(session('success'))
                    <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 0.5rem; padding: 1rem; margin-top: 1rem;">
                        <p style="color: #10b981; margin: 0;">
                            <i class="fas fa-check-circle"></i>
                            {{ session('success') }}
                        </p>
                    </div>
                @endif

                <div style="background: rgba(15, 23, 42, 0.3); border-radius: 0.5rem; padding: 1rem; margin-top: 1rem; border: 1px solid rgba(71, 85, 105, 0.3);">
                    <p style="color: #cbd5e1; margin-bottom: 0.5rem;">
                        <i class="fas fa-info-circle" style="color: #eab308;"></i>
                        <strong>Como funciona:</strong>
                    </p>
                    <p style="color: #9ca3af; font-size: 0.9rem; margin: 0;">
                        Será gerada automaticamente uma URL única para seu webhook: <br>
                        <code style="color: #eab308; background: rgba(30, 41, 59, 0.5); padding: 0.2rem 0.4rem; border-radius: 0.25rem;">{{ url('/api/webhook/') }}/smart-webhook-123</code>
                    </p>
                </div>
            </div>
        @else
            <!-- Webhook Info -->
            <div class="webhook-section">
                <div class="webhook-info">
                    <h3 class="section-title">
                        <i class="fas fa-link" style="color: #eab308;"></i>
                        URL do Webhook
                    </h3>
                    
                    <p style="color: #cbd5e1; margin-bottom: 1rem;">
                        Use esta URL para enviar requisições HTTP. Todas as requisições serão exibidas abaixo em tempo real.
                    </p>
                    
                    <div class="webhook-url">
                        <span class="webhook-url-text">{{ url('/api/webhook/' . $webhook->custom_url) }}</span>
                        <div class="url-actions">
                            <button class="copy-btn" onclick="copyToClipboard('{{ url('/api/webhook/' . $webhook->custom_url) }}', this)" title="Copiar URL">
                                <i class="fas fa-copy"></i>
                            </button>
                            <form action="{{ route('tools.webhook.delete') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="delete-btn" onclick="return confirm('Tem certeza que deseja deletar este webhook?')" title="Deletar webhook">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <div style="margin-top: 1rem;">
                        <form action="{{ route('tools.webhook.delete') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn" style="background: rgba(71, 85, 105, 0.5); color: #9ca3af; padding: 0.75rem 1.5rem; font-size: 0.875rem;" onclick="return confirm('Isso irá deletar o webhook atual. Deseja continuar?')">
                                <i class="fas fa-redo"></i>
                                Recriar Webhook
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Requests Section -->
            <div class="webhook-section">
                <h3 class="section-title">
                    <i class="fas fa-list" style="color: #eab308;"></i>
                    Requisições Recebidas
                </h3>
                
                <div id="requests-container">
                    @if(count($requests) > 0)
                        @foreach($requests as $request)
                            <div class="request-card">
                                <div class="request-header">
                                    <span class="request-method method-{{ strtolower($request->method) }}">
                                        {{ $request->method }}
                                    </span>
                                    <span class="request-time">
                                        {{ $request->created_at->format('d/m/Y H:i:s') }}
                                    </span>
                                </div>
                                
                                <div class="request-details">
                                    @if($request->headers)
                                        <div class="detail-section">
                                            <div class="detail-title">Headers</div>
                                            <div class="detail-content">{{ json_encode($request->headers, JSON_PRETTY_PRINT) }}</div>
                                        </div>
                                    @endif
                                    
                                    @if($request->query_params)
                                        <div class="detail-section">
                                            <div class="detail-title">Query Parameters</div>
                                            <div class="detail-content">{{ json_encode($request->query_params, JSON_PRETTY_PRINT) }}</div>
                                        </div>
                                    @endif
                                    
                                    @if($request->body)
                                        <div class="detail-section">
                                            <div class="detail-title">Body</div>
                                            <div class="detail-content">{{ $request->body }}</div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="waiting-animation">
                            <div class="listening-indicator"></div>
                            <h4 style="margin-bottom: 1rem;">Aguardando requisições...</h4>
                            <p style="margin-bottom: 2rem;">Envie uma requisição HTTP para o webhook acima e ela aparecerá aqui automaticamente.</p>
                            <div>
                                <span class="pulse-dot"></span>
                                <span class="pulse-dot"></span>
                                <span class="pulse-dot"></span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>

<script>
function copyToClipboard(text, button) {
    navigator.clipboard.writeText(text).then(function() {
        // Feedback visual
        const icon = button.querySelector('i');
        icon.className = 'fas fa-check';
        button.style.color = '#10b981';
        
        setTimeout(() => {
            icon.className = 'fas fa-copy';
            button.style.color = '';
        }, 2000);
    });
}

@if(isset($webhook) && $webhook)
// Sistema de polling em tempo real - lógica original
let isPolling = false;
let lastRequestCount = {{ count($requests) }};

async function checkForNewRequests() {
    if (isPolling) return;
    isPolling = true;
    
    try {
        const response = await fetch(window.location.href, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        });
        
        if (response.ok) {
            const html = await response.text();
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newContainer = doc.getElementById('requests-container');
            
            if (newContainer) {
                const currentContainer = document.getElementById('requests-container');
                const newCards = newContainer.querySelectorAll('.request-card');
                
                if (newCards.length > lastRequestCount) {
                    // Há novas requisições - atualizar conteúdo
                    currentContainer.innerHTML = newContainer.innerHTML;
                    lastRequestCount = newCards.length;
                    
                    // Mostrar feedback visual
                    showListeningFeedback();
                }
            }
        }
    } catch (error) {
        console.error('Erro ao verificar novas requisições:', error);
    } finally {
        isPolling = false;
    }
}

function showListeningFeedback() {
    const indicator = document.querySelector('.listening-indicator');
    const layer3 = document.querySelector('.listening-layer3');
    
    if (indicator) {
        // Efeito de "recebido" - todas as camadas ficam verdes
        indicator.style.animation = 'none';
        indicator.style.background = 'linear-gradient(135deg, #10b981, #059669)';
        indicator.style.boxShadow = '0 0 20px rgba(16, 185, 129, 0.5)';
        
        if (layer3) {
            layer3.style.background = 'rgba(16, 185, 129, 0.2)';
        }
        
        setTimeout(() => {
            indicator.style.animation = 'listening-core 3s ease-in-out infinite';
            indicator.style.background = 'linear-gradient(135deg, #eab308, #f59e0b)';
            indicator.style.boxShadow = '0 0 15px rgba(234, 179, 8, 0.3)';
            
            if (layer3) {
                layer3.style.background = 'rgba(234, 179, 8, 0.08)';
            }
        }, 800);
    }
    
    // Mostrar notificação discreta
    const newCount = document.querySelectorAll('.request-card').length - (lastRequestCount - 1);
    if (newCount > 0) {
        console.log(`✅ ${newCount} nova(s) requisição(ões) recebida(s)`);
    }
}

// Verificar a cada 1.5 segundos (frequência original)
setInterval(checkForNewRequests, 1500);

// Verificar imediatamente ao carregar
document.addEventListener('DOMContentLoaded', function() {
    // Garantir que a animação está funcionando e adicionar terceira camada
    const indicator = document.querySelector('.listening-indicator');
    if (indicator) {
        // Criar terceira camada
        const layer3 = document.createElement('div');
        layer3.className = 'listening-layer3';
        indicator.appendChild(layer3);
        
        console.log('🎯 Webhook ativo - aguardando requisições...');
    }
    
    // Primeira verificação após 1 segundo
    setTimeout(checkForNewRequests, 1000);
});

// Detectar quando o usuário sai da página (mas não ao recarregar)
let isReloading = false;
let isNavigatingAway = false;

// Detectar F5 ou Ctrl+R (reload)
document.addEventListener('keydown', function(e) {
    if (e.key === 'F5' || (e.ctrlKey && e.key === 'r') || (e.metaKey && e.key === 'r')) {
        isReloading = true;
        setTimeout(() => { isReloading = false; }, 1000);
    }
});

// Detectar navegação para outras páginas através de links
document.addEventListener('click', function(e) {
    const link = e.target.closest('a');
    if (link && link.href && !link.href.includes('/tools/webhook') && !link.href.startsWith('#')) {
        isNavigatingAway = true;
        // Limpar sessão imediatamente
        fetch('/tools/webhook/clear-session', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                'Content-Type': 'application/json'
            }
        }).catch(() => {});
    }
});

// Detectar quando a página está sendo fechada/navegação
window.addEventListener('beforeunload', function(e) {
    // Se não é um reload e não já detectamos navegação, limpar a sessão
    if (!isReloading && !isNavigatingAway) {
        navigator.sendBeacon('/tools/webhook/clear-session', new FormData());
    }
});

// Detectar mudanças na URL (navegação via JavaScript)
let currentUrl = window.location.href;
setInterval(() => {
    if (window.location.href !== currentUrl && !window.location.href.includes('/tools/webhook')) {
        currentUrl = window.location.href;
        fetch('/tools/webhook/clear-session', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                'Content-Type': 'application/json'
            }
        }).catch(() => {});
    }
}, 500);
@endif
</script>
@endsection 