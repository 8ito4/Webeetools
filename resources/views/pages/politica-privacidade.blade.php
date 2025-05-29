@extends('layouts.modern')

@section('title', 'Política de Privacidade - Webeetools')

@section('content')
<div class="tool-container">
    <div class="tool-header">
        <h1 class="tool-title">
            🛡️ Política de Privacidade
        </h1>
        <p class="tool-description">
            Como protegemos seus dados e garantimos sua privacidade
        </p>
        <div style="color: #9ca3af; font-size: 0.875rem; margin-top: 1rem;">
            Última atualização: {{ date('d/m/Y') }}
        </div>
    </div>

    <!-- Banner de Destaque -->
    <div style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(59, 130, 246, 0.2)); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem;">
        <div style="display: flex; align-items: flex-start; gap: 1rem;">
            <div style="background: #10b981; border-radius: 50%; padding: 0.75rem; flex-shrink: 0;">
                <i class="fas fa-shield-alt" style="color: white; font-size: 1.25rem;"></i>
            </div>
            <div>
                <h3 style="color: #34d399; font-size: 1.25rem; font-weight: 700; margin-bottom: 0.5rem;">
                    Compromisso Zero Data Collection
                </h3>
                <p style="color: #a7f3d0;">
                    <strong>100% Privado:</strong> Não coletamos, armazenamos, processamos ou vendemos seus dados pessoais. 
                    Todas as operações são realizadas localmente no seu navegador.
                </p>
            </div>
        </div>
    </div>

    <div class="tool-content">
        
        <!-- 1. Introdução -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: var(--accent-400); font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-info-circle"></i>
                1. Introdução
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <p style="margin-bottom: 1rem;">
                    No <strong>Webeetools</strong>, respeitamos e valorizamos sua privacidade. Esta Política de Privacidade 
                    explica como (não) coletamos, usamos e protegemos suas informações quando você usa nossos serviços.
                </p>
                <p>
                    Nossa filosofia é simples: <strong>seus dados são seus</strong>. Criamos nossas ferramentas para funcionar 
                    completamente no seu navegador, sem enviar informações para nossos servidores.
                </p>
            </div>
        </section>

        <!-- 2. Informações que NÃO Coletamos -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: #ef4444; font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-times-circle"></i>
                2. Informações que NÃO Coletamos
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <p style="margin-bottom: 1rem;">Nós <strong>NÃO</strong> coletamos:</p>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem;">
                    <ul style="list-style: disc; padding-left: 1.5rem;">
                        <li style="margin-bottom: 0.5rem;">Dados pessoais (nome, email, telefone)</li>
                        <li style="margin-bottom: 0.5rem;">Informações de localização</li>
                        <li style="margin-bottom: 0.5rem;">Endereços IP</li>
                        <li style="margin-bottom: 0.5rem;">Informações do dispositivo</li>
                        <li style="margin-bottom: 0.5rem;">Histórico de navegação</li>
                    </ul>
                    <ul style="list-style: disc; padding-left: 1.5rem;">
                        <li style="margin-bottom: 0.5rem;">Dados inseridos nas ferramentas</li>
                        <li style="margin-bottom: 0.5rem;">Arquivos enviados ou processados</li>
                        <li style="margin-bottom: 0.5rem;">Senhas ou chaves geradas</li>
                        <li style="margin-bottom: 0.5rem;">Resultados das operações</li>
                        <li style="margin-bottom: 0.5rem;">Cookies de rastreamento</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- 3. Como Nossas Ferramentas Funcionam -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: #3b82f6; font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-cogs"></i>
                3. Como Nossas Ferramentas Funcionam
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <p style="margin-bottom: 1.5rem;">
                    Todas as nossas ferramentas são projetadas para funcionar <strong>100% localmente</strong> no seu navegador:
                </p>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
                    <div style="background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.2); border-radius: 0.5rem; padding: 1rem;">
                        <h4 style="color: #60a5fa; font-weight: 700; margin-bottom: 0.5rem;">🔧 Processamento Local</h4>
                        <p style="font-size: 0.875rem;">
                            JSON, XML, Base64, hashes e outras operações são executadas inteiramente no seu navegador usando JavaScript.
                        </p>
                    </div>
                    <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.2); border-radius: 0.5rem; padding: 1rem;">
                        <h4 style="color: #34d399; font-weight: 700; margin-bottom: 0.5rem;">🔒 Sem Transmissão</h4>
                        <p style="font-size: 0.875rem;">
                            Seus dados nunca saem do seu dispositivo. Não há comunicação com nossos servidores durante o uso das ferramentas.
                        </p>
                    </div>
                    <div style="background: rgba(168, 85, 247, 0.1); border: 1px solid rgba(168, 85, 247, 0.2); border-radius: 0.5rem; padding: 1rem;">
                        <h4 style="color: #c084fc; font-weight: 700; margin-bottom: 0.5rem;">⚡ Performance</h4>
                        <p style="font-size: 0.875rem;">
                            Processamento instantâneo sem dependência de internet ou latência de servidor.
                        </p>
                    </div>
                    <div style="background: rgba(234, 179, 8, 0.1); border: 1px solid rgba(234, 179, 8, 0.2); border-radius: 0.5rem; padding: 1rem;">
                        <h4 style="color: var(--accent-400); font-weight: 700; margin-bottom: 0.5rem;">🛡️ Segurança</h4>
                        <p style="font-size: 0.875rem;">
                            Dados sensíveis permanecem seguros no seu ambiente local, sem risco de interceptação.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. Logs do Servidor -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: var(--accent-400); font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-server"></i>
                4. Logs do Servidor
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <p style="margin-bottom: 1rem;">
                    Como qualquer website, nossos servidores mantêm logs básicos de acesso que incluem:
                </p>
                <ul style="list-style: disc; padding-left: 1.5rem; margin-bottom: 1rem;">
                    <li style="margin-bottom: 0.5rem;">Endereço IP (automaticamente removido após 24 horas)</li>
                    <li style="margin-bottom: 0.5rem;">User-agent do navegador</li>
                    <li style="margin-bottom: 0.5rem;">Páginas acessadas</li>
                    <li style="margin-bottom: 0.5rem;">Timestamp das visitas</li>
                </ul>
                <p style="margin-bottom: 1rem;">
                    <strong>Importante:</strong> Estes logs são usados apenas para:
                </p>
                <ul style="list-style: disc; padding-left: 1.5rem;">
                    <li style="margin-bottom: 0.5rem;">Monitoramento de performance</li>
                    <li style="margin-bottom: 0.5rem;">Detecção de problemas técnicos</li>
                    <li style="margin-bottom: 0.5rem;">Prevenção de abuso (DDoS, spam)</li>
                    <li style="margin-bottom: 0.5rem;"><strong>Não</strong> são utilizados para rastreamento ou analytics</li>
                </ul>
            </div>
        </section>

        <!-- 5. Cookies -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: var(--accent-400); font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-cookie-bite"></i>
                5. Cookies
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.2); border-radius: 0.5rem; padding: 1rem; margin-bottom: 1rem;">
                    <p style="color: #34d399; font-weight: 600;">
                        <i class="fas fa-check-circle" style="margin-right: 0.5rem;"></i>
                        Política de Cookies Mínima
                    </p>
                </div>
                <p style="margin-bottom: 1rem;">
                    Utilizamos apenas cookies técnicos essenciais para o funcionamento do site:
                </p>
                <ul style="list-style: disc; padding-left: 1.5rem; margin-bottom: 1rem;">
                    <li style="margin-bottom: 0.5rem;"><strong>Session cookies:</strong> Para manter a sessão ativa durante sua visita</li>
                    <li style="margin-bottom: 0.5rem;"><strong>Preference cookies:</strong> Para lembrar suas configurações (tema, idioma)</li>
                </ul>
                <p style="margin-bottom: 1rem;">
                    <strong>NÃO utilizamos:</strong>
                </p>
                <ul style="list-style: disc; padding-left: 1.5rem;">
                    <li style="margin-bottom: 0.5rem;">Cookies de rastreamento</li>
                    <li style="margin-bottom: 0.5rem;">Cookies de analytics</li>
                    <li style="margin-bottom: 0.5rem;">Cookies de publicidade</li>
                    <li style="margin-bottom: 0.5rem;">Cookies de terceiros</li>
                </ul>
            </div>
        </section>

        <!-- 6. Serviços de Terceiros -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: var(--accent-400); font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-external-link-alt"></i>
                6. Serviços de Terceiros
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <p style="margin-bottom: 1rem;">
                    Nosso compromisso com a privacidade se estende à escolha de serviços externos:
                </p>
                <ul style="list-style: disc; padding-left: 1.5rem; margin-bottom: 1rem;">
                    <li style="margin-bottom: 0.5rem;"><strong>Não utilizamos</strong> Google Analytics, Facebook Pixel ou similares</li>
                    <li style="margin-bottom: 0.5rem;"><strong>Não temos</strong> integração com redes sociais que coletam dados</li>
                    <li style="margin-bottom: 0.5rem;"><strong>Não carregamos</strong> scripts de publicidade ou rastreamento</li>
                </ul>
                <p style="margin-bottom: 1rem;">
                    Os únicos recursos externos são:
                </p>
                <ul style="list-style: disc; padding-left: 1.5rem;">
                    <li style="margin-bottom: 0.5rem;"><strong>Font Awesome:</strong> Para ícones (CDN sem tracking)</li>
                    <li style="margin-bottom: 0.5rem;"><strong>CDNs de fonts:</strong> Para fontes web (sem tracking)</li>
                </ul>
            </div>
        </section>

        <!-- 7. Segurança -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: #10b981; font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-lock"></i>
                7. Medidas de Segurança
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <p style="margin-bottom: 1rem;">
                    Implementamos diversas medidas de segurança:
                </p>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem;">
                    <ul style="list-style: disc; padding-left: 1.5rem;">
                        <li style="margin-bottom: 0.5rem;"><strong>HTTPS:</strong> Conexão criptografada</li>
                        <li style="margin-bottom: 0.5rem;"><strong>CSP:</strong> Content Security Policy</li>
                        <li style="margin-bottom: 0.5rem;"><strong>HSTS:</strong> HTTP Strict Transport Security</li>
                    </ul>
                    <ul style="list-style: disc; padding-left: 1.5rem;">
                        <li style="margin-bottom: 0.5rem;"><strong>Rate Limiting:</strong> Proteção contra abuso</li>
                        <li style="margin-bottom: 0.5rem;"><strong>Security Headers:</strong> Proteção adicional</li>
                        <li style="margin-bottom: 0.5rem;"><strong>Regular Updates:</strong> Manutenção de segurança</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- 8. Seus Direitos -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: #3b82f6; font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-user-shield"></i>
                8. Seus Direitos
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <p style="margin-bottom: 1rem;">
                    Como não coletamos dados pessoais, você automaticamente tem:
                </p>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem;">
                    <ul style="list-style: disc; padding-left: 1.5rem;">
                        <li style="margin-bottom: 0.5rem;"><strong>Controle total:</strong> Seus dados permanecem com você</li>
                        <li style="margin-bottom: 0.5rem;"><strong>Transparência:</strong> Esta política explica tudo</li>
                        <li style="margin-bottom: 0.5rem;"><strong>Portabilidade:</strong> Use offline se desejar</li>
                    </ul>
                    <ul style="list-style: disc; padding-left: 1.5rem;">
                        <li style="margin-bottom: 0.5rem;"><strong>Anonimato:</strong> Não exigimos identificação</li>
                        <li style="margin-bottom: 0.5rem;"><strong>Não-rastreamento:</strong> Navegue livremente</li>
                        <li style="margin-bottom: 0.5rem;"><strong>Sem perfis:</strong> Não criamos perfis de usuário</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- 9. Alterações na Política -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: var(--accent-400); font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-edit"></i>
                9. Alterações nesta Política
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <p style="margin-bottom: 1rem;">
                    Podemos atualizar esta Política de Privacidade ocasionalmente. Quando fizermos alterações:
                </p>
                <ul style="list-style: disc; padding-left: 1.5rem;">
                    <li style="margin-bottom: 0.5rem;">Atualizaremos a data de "Última atualização"</li>
                    <li style="margin-bottom: 0.5rem;">Notificaremos sobre mudanças significativas</li>
                    <li style="margin-bottom: 0.5rem;">Manteremos nosso compromisso com a privacidade</li>
                </ul>
            </div>
        </section>

        <!-- 10. Contato -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: var(--accent-400); font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-envelope"></i>
                10. Contato
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <p style="margin-bottom: 1rem;">
                    Se você tiver dúvidas sobre nossa Política de Privacidade:
                </p>
                <div style="background: rgba(30, 41, 59, 0.8); border: 1px solid rgba(71, 85, 105, 0.5); border-radius: 0.5rem; padding: 1rem;">
                    <p style="margin-bottom: 0.5rem;"><strong>Email:</strong> contato@webeetools.com</p>
                    <p style="margin-bottom: 0.5rem;"><strong>Assunto:</strong> "Privacidade - [Sua dúvida]"</p>
                    <p><strong>Website:</strong> <a href="/" style="color: var(--accent-400); text-decoration: none;">webeetools.com</a></p>
                </div>
            </div>
        </section>

    </div>

    <!-- Resumo Final -->
    <div style="margin-top: 2rem; background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(59, 130, 246, 0.1)); border: 1px solid rgba(16, 185, 129, 0.2); border-radius: 1rem; padding: 1.5rem;">
        <h3 style="color: #34d399; font-size: 1.25rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
            <i class="fas fa-shield-alt"></i>
            Resumo da Nossa Política
        </h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; text-align: center;">
            <div>
                <div style="font-size: 3rem; margin-bottom: 0.5rem;">🚫</div>
                <h4 style="color: #34d399; font-weight: 700;">Zero Coleta</h4>
                <p style="color: #cbd5e1; font-size: 0.875rem;">Não coletamos dados pessoais</p>
            </div>
            <div>
                <div style="font-size: 3rem; margin-bottom: 0.5rem;">🔒</div>
                <h4 style="color: #60a5fa; font-weight: 700;">100% Local</h4>
                <p style="color: #cbd5e1; font-size: 0.875rem;">Tudo processado no seu navegador</p>
            </div>
            <div>
                <div style="font-size: 3rem; margin-bottom: 0.5rem;">🛡️</div>
                <h4 style="color: #c084fc; font-weight: 700;">Privacidade Total</h4>
                <p style="color: #cbd5e1; font-size: 0.875rem;">Seus dados permanecem seus</p>
            </div>
        </div>
    </div>

    <!-- Navegação -->
    <div style="margin-top: 2rem; display: flex; flex-wrap: wrap; gap: 1rem; justify-content: space-between;">
        <a href="/termos-de-uso" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i>
            Termos de Uso
        </a>
        <a href="/" class="btn btn-primary">
            Voltar ao Início
            <i class="fas fa-home"></i>
        </a>
    </div>
</div>
@endsection 