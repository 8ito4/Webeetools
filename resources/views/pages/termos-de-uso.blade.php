@extends('layouts.modern')

@section('title', 'Termos de Uso - Webeetools')

@section('content')
<div class="tool-container">
    <div class="tool-header">
        <h1 class="tool-title">
            📜 Termos de Uso
        </h1>
        <p class="tool-description">
            Condições de uso dos serviços Webeetools
        </p>
        <div style="color: #9ca3af; font-size: 0.875rem; margin-top: 1rem;">
            Última atualização: {{ date('d/m/Y') }}
        </div>
    </div>

    <div class="tool-content">
        
        <!-- 1. Aceitação dos Termos -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: var(--accent-400); font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-handshake"></i>
                1. Aceitação dos Termos
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <p style="margin-bottom: 1rem;">
                    Ao acessar e usar o <strong>Webeetools</strong>, você concorda em cumprir e estar vinculado a estes Termos de Uso. 
                    Se você não concordar com qualquer parte destes termos, não deve usar nossos serviços.
                </p>
                <p>
                    Estes termos aplicam-se a todos os visitantes, usuários e outras pessoas que acessam ou usam o serviço.
                </p>
            </div>
        </section>

        <!-- 2. Descrição do Serviço -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: var(--accent-400); font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-tools"></i>
                2. Descrição do Serviço
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <p style="margin-bottom: 1rem;">
                    O <strong>Webeetools</strong> é uma plataforma que oferece ferramentas gratuitas para desenvolvedores e usuários em geral, incluindo:
                </p>
                <ul style="list-style: disc; padding-left: 1.5rem; margin-bottom: 1rem;">
                    <li style="margin-bottom: 0.5rem;">Formatador e validador JSON</li>
                    <li style="margin-bottom: 0.5rem;">Gerador de senhas seguras</li>
                    <li style="margin-bottom: 0.5rem;">Codificador/decodificador Base64</li>
                    <li style="margin-bottom: 0.5rem;">Gerador de QR Code</li>
                    <li style="margin-bottom: 0.5rem;">Formatador de documentos (CPF/CNPJ)</li>
                    <li style="margin-bottom: 0.5rem;">Validador de e-mail</li>
                    <li style="margin-bottom: 0.5rem;">Gerador de hash SHA256</li>
                    <li style="margin-bottom: 0.5rem;">Formatador XML</li>
                    <li style="margin-bottom: 0.5rem;">E outras ferramentas úteis</li>
                </ul>
                <p>
                    Todos os nossos serviços são fornecidos gratuitamente e sem necessidade de registro.
                </p>
            </div>
        </section>

        <!-- 3. Uso Permitido -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: #10b981; font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-check-circle"></i>
                3. Uso Permitido
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <p style="margin-bottom: 1rem;">Você pode usar nossos serviços para:</p>
                <ul style="list-style: disc; padding-left: 1.5rem;">
                    <li style="margin-bottom: 0.5rem;">Fins pessoais e comerciais legítimos</li>
                    <li style="margin-bottom: 0.5rem;">Desenvolvimento de software</li>
                    <li style="margin-bottom: 0.5rem;">Educação e aprendizado</li>
                    <li style="margin-bottom: 0.5rem;">Testes e validações</li>
                </ul>
            </div>
        </section>

        <!-- 4. Uso Proibido -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: #ef4444; font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-ban"></i>
                4. Uso Proibido
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <p style="margin-bottom: 1rem;">É <strong>proibido</strong> usar nossos serviços para:</p>
                <ul style="list-style: disc; padding-left: 1.5rem;">
                    <li style="margin-bottom: 0.5rem;">Atividades ilegais ou não autorizadas</li>
                    <li style="margin-bottom: 0.5rem;">Transmitir vírus, malware ou código malicioso</li>
                    <li style="margin-bottom: 0.5rem;">Tentar hackear, quebrar ou comprometer a segurança do serviço</li>
                    <li style="margin-bottom: 0.5rem;">Fazer uso excessivo que possa prejudicar o desempenho</li>
                    <li style="margin-bottom: 0.5rem;">Violar direitos de propriedade intelectual</li>
                    <li style="margin-bottom: 0.5rem;">Assediar, abusar ou prejudicar outras pessoas</li>
                    <li style="margin-bottom: 0.5rem;">Coletar dados de outros usuários sem permissão</li>
                </ul>
            </div>
        </section>

        <!-- 5. Privacidade e Dados -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: #10b981; font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-shield-alt"></i>
                5. Privacidade e Dados
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 0.5rem; padding: 1rem; margin-bottom: 1rem;">
                    <p style="color: #10b981; font-weight: 600; margin-bottom: 0.5rem;">
                        <i class="fas fa-shield-alt" style="margin-right: 0.5rem;"></i>
                        Compromisso com a Privacidade
                    </p>
                    <p style="color: #34d399;">
                        <strong>Não coletamos, armazenamos ou processamos dados pessoais.</strong> 
                        Todas as operações são realizadas localmente no seu navegador.
                    </p>
                </div>
                <ul style="list-style: disc; padding-left: 1.5rem;">
                    <li style="margin-bottom: 0.5rem;">Os dados inseridos nas ferramentas não são enviados para nossos servidores</li>
                    <li style="margin-bottom: 0.5rem;">Não utilizamos cookies de rastreamento</li>
                    <li style="margin-bottom: 0.5rem;">Não compartilhamos informações com terceiros</li>
                    <li style="margin-bottom: 0.5rem;">Não exigimos registro ou login</li>
                </ul>
            </div>
        </section>

        <!-- 6. Limitação de Responsabilidade -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: var(--accent-400); font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-exclamation-triangle"></i>
                6. Limitação de Responsabilidade
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <p style="margin-bottom: 1rem;">
                    O <strong>Webeetools</strong> é fornecido "como está" e "conforme disponível". 
                    Não garantimos que o serviço:
                </p>
                <ul style="list-style: disc; padding-left: 1.5rem; margin-bottom: 1rem;">
                    <li style="margin-bottom: 0.5rem;">Estará sempre disponível ou livre de erros</li>
                    <li style="margin-bottom: 0.5rem;">Atenderá às suas necessidades específicas</li>
                    <li style="margin-bottom: 0.5rem;">Será ininterrupto ou seguro</li>
                    <li style="margin-bottom: 0.5rem;">Produzirá resultados precisos em todos os casos</li>
                </ul>
                <p>
                    Não seremos responsáveis por quaisquer danos diretos, indiretos, incidentais, 
                    especiais ou consequenciais resultantes do uso de nossos serviços.
                </p>
            </div>
        </section>

        <!-- 7. Propriedade Intelectual -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: var(--accent-400); font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-copyright"></i>
                7. Propriedade Intelectual
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <p style="margin-bottom: 1rem;">
                    O serviço e seu conteúdo original, recursos e funcionalidades são e permanecerão 
                    propriedade exclusiva do <strong>Webeetools</strong> e seus licenciadores.
                </p>
                <p>
                    O serviço é protegido por direitos autorais, marcas registradas e outras leis.
                </p>
            </div>
        </section>

        <!-- 8. Modificações -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: var(--accent-400); font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-edit"></i>
                8. Modificações dos Termos
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <p style="margin-bottom: 1rem;">
                    Reservamo-nos o direito de modificar ou substituir estes Termos a qualquer momento. 
                    Se uma revisão for material, tentaremos fornecer um aviso com pelo menos 30 dias de antecedência.
                </p>
                <p>
                    O uso continuado do serviço após essas alterações constituirá aceitação dos novos termos.
                </p>
            </div>
        </section>

        <!-- 9. Contato -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: var(--accent-400); font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-envelope"></i>
                9. Contato
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <p style="margin-bottom: 1rem;">
                    Se você tiver dúvidas sobre estes Termos de Uso, entre em contato conosco:
                </p>
                <div style="background: rgba(30, 41, 59, 0.8); border: 1px solid rgba(71, 85, 105, 0.5); border-radius: 0.5rem; padding: 1rem;">
                    <p style="margin-bottom: 0.5rem;"><strong>Email:</strong> contato@webeetools.com</p>
                    <p><strong>Website:</strong> <a href="/" style="color: var(--accent-400); text-decoration: none;">webeetools.com</a></p>
                </div>
            </div>
        </section>

    </div>

    <!-- Navegação -->
    <div style="margin-top: 2rem; display: flex; flex-wrap: wrap; gap: 1rem; justify-content: space-between;">
        <a href="/" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i>
            Voltar ao Início
        </a>
        <a href="/politica-privacidade" class="btn btn-primary">
            Política de Privacidade
            <i class="fas fa-arrow-right"></i>
        </a>
    </div>
</div>
@endsection 