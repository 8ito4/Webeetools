@extends('layouts.modern')

@section('title', 'Política de Cookies - Webeetools')

@section('content')
<div class="tool-container">
    <div class="tool-header">
        <h1 class="tool-title">
            🍪 Política de Cookies
        </h1>
        <p class="tool-description">
            Como utilizamos cookies de forma mínima e responsável
        </p>
        <div style="color: #9ca3af; font-size: 0.875rem; margin-top: 1rem;">
            Última atualização: {{ date('d/m/Y') }}
        </div>
    </div>

    <!-- Banner de Destaque -->
    <div style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(234, 179, 8, 0.2)); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem;">
        <div style="display: flex; align-items: flex-start; gap: 1rem;">
            <div style="background: #10b981; border-radius: 50%; padding: 0.75rem; flex-shrink: 0;">
                <i class="fas fa-cookie-bite" style="color: white; font-size: 1.25rem;"></i>
            </div>
            <div>
                <h3 style="color: #34d399; font-size: 1.25rem; font-weight: 700; margin-bottom: 0.5rem;">
                    Política de Cookies Mínima
                </h3>
                <p style="color: #a7f3d0;">
                    Utilizamos apenas cookies essenciais para funcionamento. <strong>Sem rastreamento, sem analytics, sem publicidade.</strong>
                </p>
            </div>
        </div>
    </div>

    <div class="tool-content">
        
        <!-- 1. O que são Cookies -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: var(--accent-400); font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-info-circle"></i>
                1. O que são Cookies?
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <p style="margin-bottom: 1rem;">
                    Cookies são pequenos arquivos de texto que os sites armazenam no seu navegador. 
                    Eles são amplamente utilizados para fazer os sites funcionarem ou funcionar de forma mais eficiente.
                </p>
                <p>
                    No <strong>Webeetools</strong>, mantemos o uso de cookies ao <strong>mínimo absoluto</strong>, 
                    utilizando apenas o que é essencial para o funcionamento básico do site.
                </p>
            </div>
        </section>

        <!-- 2. Cookies que Utilizamos -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: #10b981; font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-check-circle"></i>
                2. Cookies que Utilizamos
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                
                <!-- Session Cookies -->
                <div style="background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.2); border-radius: 0.5rem; padding: 1rem; margin-bottom: 1.5rem;">
                    <h4 style="color: #60a5fa; font-weight: 700; margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-clock"></i>
                        Session Cookies (Essenciais)
                    </h4>
                    <div style="font-size: 0.875rem;">
                        <p style="margin-bottom: 0.5rem;"><strong>Finalidade:</strong> Manter sua sessão ativa durante a visita</p>
                        <p style="margin-bottom: 0.5rem;"><strong>Duração:</strong> Até você fechar o navegador</p>
                        <p style="margin-bottom: 0.5rem;"><strong>Conteúdo:</strong> Identificador de sessão (não contém dados pessoais)</p>
                        <p><strong>Exemplo:</strong> <code style="background: rgba(30, 41, 59, 0.8); padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-family: 'JetBrains Mono', monospace;">webeetools_session</code></p>
                    </div>
                </div>

                <!-- Preference Cookies -->
                <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.2); border-radius: 0.5rem; padding: 1rem;">
                    <h4 style="color: #34d399; font-weight: 700; margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-cog"></i>
                        Preference Cookies (Funcionais)
                    </h4>
                    <div style="font-size: 0.875rem;">
                        <p style="margin-bottom: 0.5rem;"><strong>Finalidade:</strong> Lembrar suas preferências de uso</p>
                        <p style="margin-bottom: 0.5rem;"><strong>Duração:</strong> 30 dias</p>
                        <p style="margin-bottom: 0.5rem;"><strong>Conteúdo:</strong> Configurações como tema escuro/claro, idioma</p>
                        <p><strong>Exemplo:</strong> <code style="background: rgba(30, 41, 59, 0.8); padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-family: 'JetBrains Mono', monospace;">webeetools_preferences</code></p>
                    </div>
                </div>

            </div>
        </section>

        <!-- 3. Cookies que NÃO Utilizamos -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: #ef4444; font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-ban"></i>
                3. Cookies que NÃO Utilizamos
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <p style="margin-bottom: 1rem;">Nós <strong>NÃO</strong> utilizamos:</p>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1rem;">
                    <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); border-radius: 0.5rem; padding: 1rem;">
                        <h4 style="color: #f87171; font-weight: 700; margin-bottom: 0.5rem;">🚫 Cookies de Rastreamento</h4>
                        <ul style="font-size: 0.875rem;">
                            <li style="margin-bottom: 0.25rem;">• Google Analytics</li>
                            <li style="margin-bottom: 0.25rem;">• Facebook Pixel</li>
                            <li style="margin-bottom: 0.25rem;">• Hotjar, Mixpanel</li>
                            <li style="margin-bottom: 0.25rem;">• Qualquer analytics</li>
                        </ul>
                    </div>
                    
                    <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); border-radius: 0.5rem; padding: 1rem;">
                        <h4 style="color: #f87171; font-weight: 700; margin-bottom: 0.5rem;">🚫 Cookies de Publicidade</h4>
                        <ul style="font-size: 0.875rem;">
                            <li style="margin-bottom: 0.25rem;">• Google Ads</li>
                            <li style="margin-bottom: 0.25rem;">• Facebook Ads</li>
                            <li style="margin-bottom: 0.25rem;">• Redes de display</li>
                            <li style="margin-bottom: 0.25rem;">• Retargeting</li>
                        </ul>
                    </div>
                    
                    <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); border-radius: 0.5rem; padding: 1rem;">
                        <h4 style="color: #f87171; font-weight: 700; margin-bottom: 0.5rem;">🚫 Cookies de Terceiros</h4>
                        <ul style="font-size: 0.875rem;">
                            <li style="margin-bottom: 0.25rem;">• Redes sociais</li>
                            <li style="margin-bottom: 0.25rem;">• CDNs de tracking</li>
                            <li style="margin-bottom: 0.25rem;">• Widgets externos</li>
                            <li style="margin-bottom: 0.25rem;">• Compartilhamento</li>
                        </ul>
                    </div>
                    
                    <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); border-radius: 0.5rem; padding: 1rem;">
                        <h4 style="color: #f87171; font-weight: 700; margin-bottom: 0.5rem;">🚫 Cookies de Perfil</h4>
                        <ul style="font-size: 0.875rem;">
                            <li style="margin-bottom: 0.25rem;">• Comportamento</li>
                            <li style="margin-bottom: 0.25rem;">• Preferências de compra</li>
                            <li style="margin-bottom: 0.25rem;">• Histórico de navegação</li>
                            <li style="margin-bottom: 0.25rem;">• Dados demográficos</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. Por que Precisamos dos Cookies Essenciais -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: #3b82f6; font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-question-circle"></i>
                4. Por que Precisamos dos Cookies Essenciais?
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
                    <div>
                        <h4 style="color: #60a5fa; font-weight: 700; margin-bottom: 0.5rem;">🔐 Segurança</h4>
                        <ul style="list-style: disc; padding-left: 1rem; font-size: 0.875rem;">
                            <li style="margin-bottom: 0.25rem;">Prevenção de ataques CSRF</li>
                            <li style="margin-bottom: 0.25rem;">Validação de sessão</li>
                            <li style="margin-bottom: 0.25rem;">Proteção contra bots</li>
                        </ul>
                    </div>
                    <div>
                        <h4 style="color: #34d399; font-weight: 700; margin-bottom: 0.5rem;">⚡ Funcionalidade</h4>
                        <ul style="list-style: disc; padding-left: 1rem; font-size: 0.875rem;">
                            <li style="margin-bottom: 0.25rem;">Manter sessão ativa</li>
                            <li style="margin-bottom: 0.25rem;">Lembrar preferências</li>
                            <li style="margin-bottom: 0.25rem;">Melhor experiência</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- 5. Gerenciamento de Cookies -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: var(--accent-400); font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-sliders-h"></i>
                5. Como Gerenciar Cookies
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <p style="margin-bottom: 1.5rem;">
                    Você tem controle total sobre os cookies. Pode gerenciá-los através do seu navegador:
                </p>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
                    <!-- Chrome -->
                    <div style="background: rgba(30, 41, 59, 0.8); border: 1px solid rgba(71, 85, 105, 0.5); border-radius: 0.5rem; padding: 1rem;">
                        <h4 style="color: #60a5fa; font-weight: 700; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fab fa-chrome"></i>
                            Google Chrome
                        </h4>
                        <ol style="list-style: decimal; padding-left: 1rem; font-size: 0.875rem;">
                            <li style="margin-bottom: 0.25rem;">Configurações → Privacidade e segurança</li>
                            <li style="margin-bottom: 0.25rem;">Cookies e outros dados de sites</li>
                            <li style="margin-bottom: 0.25rem;">Ver todos os cookies e dados de sites</li>
                            <li style="margin-bottom: 0.25rem;">Busque por "webeetools" e gerencie</li>
                        </ol>
                    </div>
                    
                    <!-- Firefox -->
                    <div style="background: rgba(30, 41, 59, 0.8); border: 1px solid rgba(71, 85, 105, 0.5); border-radius: 0.5rem; padding: 1rem;">
                        <h4 style="color: #f97316; font-weight: 700; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fab fa-firefox"></i>
                            Mozilla Firefox
                        </h4>
                        <ol style="list-style: decimal; padding-left: 1rem; font-size: 0.875rem;">
                            <li style="margin-bottom: 0.25rem;">Configurações → Privacidade e Segurança</li>
                            <li style="margin-bottom: 0.25rem;">Cookies e Dados do Site</li>
                            <li style="margin-bottom: 0.25rem;">Gerenciar Dados</li>
                            <li style="margin-bottom: 0.25rem;">Busque por "webeetools"</li>
                        </ol>
                    </div>
                    
                    <!-- Safari -->
                    <div style="background: rgba(30, 41, 59, 0.8); border: 1px solid rgba(71, 85, 105, 0.5); border-radius: 0.5rem; padding: 1rem;">
                        <h4 style="color: #94a3b8; font-weight: 700; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fab fa-safari"></i>
                            Safari
                        </h4>
                        <ol style="list-style: decimal; padding-left: 1rem; font-size: 0.875rem;">
                            <li style="margin-bottom: 0.25rem;">Safari → Preferências</li>
                            <li style="margin-bottom: 0.25rem;">Privacidade</li>
                            <li style="margin-bottom: 0.25rem;">Gerenciar Dados do Website</li>
                            <li style="margin-bottom: 0.25rem;">Busque por "webeetools"</li>
                        </ol>
                    </div>
                    
                    <!-- Edge -->
                    <div style="background: rgba(30, 41, 59, 0.8); border: 1px solid rgba(71, 85, 105, 0.5); border-radius: 0.5rem; padding: 1rem;">
                        <h4 style="color: #0ea5e9; font-weight: 700; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fab fa-edge"></i>
                            Microsoft Edge
                        </h4>
                        <ol style="list-style: decimal; padding-left: 1rem; font-size: 0.875rem;">
                            <li style="margin-bottom: 0.25rem;">Configurações → Cookies e permissões</li>
                            <li style="margin-bottom: 0.25rem;">Cookies e dados de sites</li>
                            <li style="margin-bottom: 0.25rem;">Ver todos os cookies</li>
                            <li style="margin-bottom: 0.25rem;">Busque por "webeetools"</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- 6. Impacto de Desabilitar Cookies -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: var(--accent-400); font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-toggle-off"></i>
                6. Impacto de Desabilitar Cookies
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <div style="background: rgba(234, 179, 8, 0.1); border: 1px solid rgba(234, 179, 8, 0.2); border-radius: 0.5rem; padding: 1rem; margin-bottom: 1rem;">
                    <p style="color: var(--accent-400); font-weight: 600;">
                        <i class="fas fa-info-circle" style="margin-right: 0.5rem;"></i>
                        Impacto Mínimo
                    </p>
                </div>
                <p style="margin-bottom: 1rem;">
                    Como utilizamos apenas cookies essenciais, desabilitá-los terá <strong>impacto mínimo</strong>:
                </p>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem;">
                    <div>
                        <h4 style="color: #f87171; font-weight: 700; margin-bottom: 0.5rem;">❌ O que não funcionará:</h4>
                        <ul style="list-style: disc; padding-left: 1rem; font-size: 0.875rem;">
                            <li style="margin-bottom: 0.25rem;">Lembrar suas preferências</li>
                            <li style="margin-bottom: 0.25rem;">Manter sessão entre páginas</li>
                            <li style="margin-bottom: 0.25rem;">Algumas funcionalidades CSRF</li>
                        </ul>
                    </div>
                    <div>
                        <h4 style="color: #34d399; font-weight: 700; margin-bottom: 0.5rem;">✅ O que continuará funcionando:</h4>
                        <ul style="list-style: disc; padding-left: 1rem; font-size: 0.875rem;">
                            <li style="margin-bottom: 0.25rem;">Todas as ferramentas principais</li>
                            <li style="margin-bottom: 0.25rem;">Processamento local de dados</li>
                            <li style="margin-bottom: 0.25rem;">Navegação entre páginas</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- 7. Transparência Total -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: #10b981; font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-eye"></i>
                7. Transparência Total
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <p style="margin-bottom: 1rem;">
                    Você pode verificar nossos cookies facilmente:
                </p>
                
                <div style="background: rgba(30, 41, 59, 0.8); border: 1px solid rgba(71, 85, 105, 0.5); border-radius: 0.5rem; padding: 1rem;">
                    <h4 style="color: #60a5fa; font-weight: 700; margin-bottom: 0.5rem;">🔍 Como Verificar:</h4>
                    <ol style="list-style: decimal; padding-left: 1rem; font-size: 0.875rem;">
                        <li style="margin-bottom: 0.5rem;">Pressione <kbd style="background: rgba(71, 85, 105, 0.5); padding: 0.25rem; border-radius: 0.25rem;">F12</kbd> para abrir o DevTools</li>
                        <li style="margin-bottom: 0.5rem;">Vá para a aba <strong>Application</strong> (Chrome) ou <strong>Storage</strong> (Firefox)</li>
                        <li style="margin-bottom: 0.5rem;">Clique em <strong>Cookies</strong> → webeetools.com</li>
                        <li style="margin-bottom: 0.5rem;">Veja exatamente quais cookies temos</li>
                    </ol>
                    <p style="color: #9ca3af; font-size: 0.75rem; margin-top: 0.5rem;">
                        💡 Dica: Você verá que temos apenas 1-2 cookies essenciais, sem dados pessoais.
                    </p>
                </div>
            </div>
        </section>

        <!-- 8. Contato -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: var(--accent-400); font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-envelope"></i>
                8. Contato
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <p style="margin-bottom: 1rem;">
                    Dúvidas sobre nossa política de cookies?
                </p>
                <div style="background: rgba(30, 41, 59, 0.8); border: 1px solid rgba(71, 85, 105, 0.5); border-radius: 0.5rem; padding: 1rem;">
                    <p style="margin-bottom: 0.5rem;"><strong>Email:</strong> contato@webeetools.com</p>
                    <p style="margin-bottom: 0.5rem;"><strong>Assunto:</strong> "Cookies - [Sua dúvida]"</p>
                    <p><strong>Website:</strong> <a href="/" style="color: var(--accent-400); text-decoration: none;">webeetools.com</a></p>
                </div>
            </div>
        </section>

    </div>

    <!-- Navegação -->
    <div style="margin-top: 2rem; display: flex; flex-wrap: wrap; gap: 1rem; justify-content: space-between;">
        <a href="/politica-privacidade" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i>
            Política de Privacidade
        </a>
        <a href="/licensa" class="btn btn-primary">
            Licença
            <i class="fas fa-arrow-right"></i>
        </a>
    </div>
</div>
@endsection 