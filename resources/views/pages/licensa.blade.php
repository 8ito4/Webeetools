@extends('layouts.modern')

@section('title', 'Licença - Webeetools')

@section('content')
<div class="tool-container">
    <div class="tool-header">
        <h1 class="tool-title">
            ⚖️ Licença
        </h1>
        <p class="tool-description">
            Informações sobre licenciamento e direitos autorais
        </p>
        <div style="color: #9ca3af; font-size: 0.875rem; margin-top: 1rem;">
            Última atualização: {{ date('d/m/Y') }}
        </div>
    </div>

    <!-- Banner de Destaque -->
    <div style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(168, 85, 247, 0.2)); border: 1px solid rgba(59, 130, 246, 0.3); border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem;">
        <div style="display: flex; align-items: flex-start; gap: 1rem;">
            <div style="background: #3b82f6; border-radius: 50%; padding: 0.75rem; flex-shrink: 0;">
                <i class="fas fa-balance-scale" style="color: white; font-size: 1.25rem;"></i>
            </div>
            <div>
                <h3 style="color: #60a5fa; font-size: 1.25rem; font-weight: 700; margin-bottom: 0.5rem;">
                    Software Proprietário com Uso Livre
                </h3>
                <p style="color: #bfdbfe;">
                    <strong>Webeetools</strong> é um software proprietário oferecido gratuitamente para uso pessoal e comercial, 
                    com algumas restrições para proteção da propriedade intelectual.
                </p>
            </div>
        </div>
    </div>

    <div class="tool-content">
        
        <!-- 1. Direitos Autorais -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: var(--accent-400); font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-copyright"></i>
                1. Direitos Autorais
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <div style="background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.2); border-radius: 0.5rem; padding: 1rem; margin-bottom: 1rem;">
                    <p style="color: #60a5fa; font-weight: 600;">
                        <i class="fas fa-info-circle" style="margin-right: 0.5rem;"></i>
                        Copyright Notice
                    </p>
                    <p style="color: #bfdbfe; margin-top: 0.5rem;">
                        © 2024 <strong>Webeetools</strong>. Todos os direitos reservados.
                    </p>
                </div>
                <p style="margin-bottom: 1rem;">
                    O <strong>Webeetools</strong> e todo o seu conteúdo, incluindo mas não limitado a:
                </p>
                <ul style="list-style: disc; padding-left: 1.5rem; margin-bottom: 1rem;">
                    <li style="margin-bottom: 0.5rem;">Código-fonte das ferramentas</li>
                    <li style="margin-bottom: 0.5rem;">Interface do usuário e design</li>
                    <li style="margin-bottom: 0.5rem;">Documentação e textos</li>
                    <li style="margin-bottom: 0.5rem;">Logotipos e elementos visuais</li>
                    <li style="margin-bottom: 0.5rem;">Algoritmos e funcionalidades</li>
                </ul>
                <p>
                    São protegidos por direitos autorais e pertencem exclusivamente aos proprietários do <strong>Webeetools</strong>.
                </p>
            </div>
        </section>

        <!-- 2. Licença de Uso -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: #10b981; font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-check-circle"></i>
                2. Licença de Uso Concedida
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <p style="margin-bottom: 1.5rem;">
                    Concedemos a você uma licença <strong>não exclusiva, intransferível e revogável</strong> para:
                </p>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
                    <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.2); border-radius: 0.5rem; padding: 1rem;">
                        <h4 style="color: #34d399; font-weight: 700; margin-bottom: 0.5rem;">✅ Uso Permitido</h4>
                        <ul style="list-style: disc; padding-left: 1rem; font-size: 0.875rem;">
                            <li style="margin-bottom: 0.25rem;">Usar todas as ferramentas gratuitamente</li>
                            <li style="margin-bottom: 0.25rem;">Processar seus dados pessoais/comerciais</li>
                            <li style="margin-bottom: 0.25rem;">Integrar em fluxos de trabalho</li>
                            <li style="margin-bottom: 0.25rem;">Compartilhar links das ferramentas</li>
                            <li style="margin-bottom: 0.25rem;">Uso educacional e de pesquisa</li>
                        </ul>
                    </div>
                    
                    <div style="background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.2); border-radius: 0.5rem; padding: 1rem;">
                        <h4 style="color: #60a5fa; font-weight: 700; margin-bottom: 0.5rem;">📋 Condições</h4>
                        <ul style="list-style: disc; padding-left: 1rem; font-size: 0.875rem;">
                            <li style="margin-bottom: 0.25rem;">Respeitar os Termos de Uso</li>
                            <li style="margin-bottom: 0.25rem;">Não violar direitos autorais</li>
                            <li style="margin-bottom: 0.25rem;">Usar de forma legal e ética</li>
                            <li style="margin-bottom: 0.25rem;">Não sobrecarregar os servidores</li>
                            <li style="margin-bottom: 0.25rem;">Atribuir créditos quando apropriado</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. Restrições -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: #ef4444; font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-ban"></i>
                3. Restrições e Proibições
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <p style="margin-bottom: 1rem;">Você <strong>NÃO pode</strong>:</p>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1rem;">
                    <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); border-radius: 0.5rem; padding: 1rem;">
                        <h4 style="color: #f87171; font-weight: 700; margin-bottom: 0.5rem;">🚫 Código e Software</h4>
                        <ul style="font-size: 0.875rem;">
                            <li style="margin-bottom: 0.25rem;">• Copiar, modificar ou redistribuir o código</li>
                            <li style="margin-bottom: 0.25rem;">• Fazer engenharia reversa</li>
                            <li style="margin-bottom: 0.25rem;">• Criar versões derivadas</li>
                            <li style="margin-bottom: 0.25rem;">• Descompilar ou desassemblar</li>
                        </ul>
                    </div>
                    
                    <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); border-radius: 0.5rem; padding: 1rem;">
                        <h4 style="color: #f87171; font-weight: 700; margin-bottom: 0.5rem;">🚫 Comercial e Distribuição</h4>
                        <ul style="font-size: 0.875rem;">
                            <li style="margin-bottom: 0.25rem;">• Vender ou licenciar o software</li>
                            <li style="margin-bottom: 0.25rem;">• Redistribuir para terceiros</li>
                            <li style="margin-bottom: 0.25rem;">• Usar marcas registradas</li>
                            <li style="margin-bottom: 0.25rem;">• Criar produtos concorrentes</li>
                        </ul>
                    </div>
                    
                    <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); border-radius: 0.5rem; padding: 1rem;">
                        <h4 style="color: #f87171; font-weight: 700; margin-bottom: 0.5rem;">🚫 Hosting e Infraestrutura</h4>
                        <ul style="font-size: 0.875rem;">
                            <li style="margin-bottom: 0.25rem;">• Hospedar cópias do serviço</li>
                            <li style="margin-bottom: 0.25rem;">• Criar mirrors ou proxies</li>
                            <li style="margin-bottom: 0.25rem;">• Extrair funcionalidades</li>
                            <li style="margin-bottom: 0.25rem;">• Contornar limitações técnicas</li>
                        </ul>
                    </div>
                    
                    <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); border-radius: 0.5rem; padding: 1rem;">
                        <h4 style="color: #f87171; font-weight: 700; margin-bottom: 0.5rem;">🚫 Propriedade Intelectual</h4>
                        <ul style="font-size: 0.875rem;">
                            <li style="margin-bottom: 0.25rem;">• Remover avisos de copyright</li>
                            <li style="margin-bottom: 0.25rem;">• Reivindicar autoria</li>
                            <li style="margin-bottom: 0.25rem;">• Usar logos sem permissão</li>
                            <li style="margin-bottom: 0.25rem;">• Violar marcas registradas</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. Tecnologias de Terceiros -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: #3b82f6; font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-puzzle-piece"></i>
                4. Tecnologias e Bibliotecas de Terceiros
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <p style="margin-bottom: 1rem;">
                    O <strong>Webeetools</strong> utiliza algumas tecnologias de terceiros com suas próprias licenças:
                </p>
                
                <div style="background: rgba(30, 41, 59, 0.8); border: 1px solid rgba(71, 85, 105, 0.5); border-radius: 0.5rem; padding: 1rem;">
                    <h4 style="color: #e2e8f0; font-weight: 700; margin-bottom: 0.75rem;">🔧 Componentes Externos</h4>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; font-size: 0.875rem;">
                        <div>
                            <p><strong>Font Awesome:</strong></p>
                            <p style="color: #9ca3af;">Ícones sob SIL OFL 1.1 License</p>
                            <p style="margin-top: 0.5rem;"><strong>Laravel Framework:</strong></p>
                            <p style="color: #9ca3af;">MIT License</p>
                        </div>
                        <div>
                            <p><strong>JavaScript Libraries:</strong></p>
                            <p style="color: #9ca3af;">Várias licenças MIT/Apache</p>
                            <p style="margin-top: 0.5rem;"><strong>CSS Frameworks:</strong></p>
                            <p style="color: #9ca3af;">MIT License</p>
                        </div>
                    </div>
                </div>
                
                <p style="color: #9ca3af; font-size: 0.875rem; margin-top: 1rem;">
                    <strong>Nota:</strong> Estas tecnologias mantêm suas licenças originais e não afetam 
                    os direitos autorais do Webeetools como um todo.
                </p>
            </div>
        </section>

        <!-- 5. Uso Comercial -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: #10b981; font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-briefcase"></i>
                5. Uso Comercial Permitido
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.2); border-radius: 0.5rem; padding: 1rem; margin-bottom: 1rem;">
                    <p style="color: #34d399; font-weight: 600;">
                        <i class="fas fa-check-circle" style="margin-right: 0.5rem;"></i>
                        Uso Comercial Gratuito
                    </p>
                </div>
                <p style="margin-bottom: 1rem;">
                    Você <strong>PODE</strong> usar o Webeetools comercialmente:
                </p>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem;">
                    <ul style="list-style: disc; padding-left: 1.5rem;">
                        <li style="margin-bottom: 0.5rem;"><strong>Empresas:</strong> Uso interno em qualquer empresa</li>
                        <li style="margin-bottom: 0.5rem;"><strong>Freelancers:</strong> Processamento de dados para clientes</li>
                        <li style="margin-bottom: 0.5rem;"><strong>Agências:</strong> Desenvolvimento de projetos</li>
                    </ul>
                    <ul style="list-style: disc; padding-left: 1.5rem;">
                        <li style="margin-bottom: 0.5rem;"><strong>Consultoria:</strong> Uso em serviços de consultoria</li>
                        <li style="margin-bottom: 0.5rem;"><strong>Educação:</strong> Cursos e treinamentos pagos</li>
                        <li style="margin-bottom: 0.5rem;"><strong>Startup:</strong> Desenvolvimento de produtos</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- 6. Isenção de Garantias -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: var(--accent-400); font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-exclamation-triangle"></i>
                6. Isenção de Garantias
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <p style="margin-bottom: 1rem;">
                    O software é fornecido <strong>"como está"</strong>, sem garantias de qualquer tipo:
                </p>
                <ul style="list-style: disc; padding-left: 1.5rem; margin-bottom: 1rem;">
                    <li style="margin-bottom: 0.5rem;">Não garantimos funcionamento ininterrupto ou livre de erros</li>
                    <li style="margin-bottom: 0.5rem;">Não garantimos resultados específicos ou precisão absoluta</li>
                    <li style="margin-bottom: 0.5rem;">Não garantimos compatibilidade com todos os sistemas</li>
                    <li style="margin-bottom: 0.5rem;">Não garantimos segurança absoluta contra vulnerabilidades</li>
                </ul>
                <p>
                    Use por sua própria conta e risco, seguindo as melhores práticas de segurança.
                </p>
            </div>
        </section>

        <!-- 7. Limitação de Responsabilidade -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: var(--accent-400); font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-shield-alt"></i>
                7. Limitação de Responsabilidade
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <p style="margin-bottom: 1rem;">
                    Em nenhuma circunstância seremos responsáveis por:
                </p>
                <ul style="list-style: disc; padding-left: 1.5rem;">
                    <li style="margin-bottom: 0.5rem;">Danos diretos, indiretos, incidentais ou consequenciais</li>
                    <li style="margin-bottom: 0.5rem;">Perda de dados, lucros ou oportunidades de negócio</li>
                    <li style="margin-bottom: 0.5rem;">Interrupção de serviços ou falhas de sistema</li>
                    <li style="margin-bottom: 0.5rem;">Decisões tomadas com base nos resultados das ferramentas</li>
                </ul>
            </div>
        </section>

        <!-- 8. Violações e Rescisão -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: #ef4444; font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-gavel"></i>
                8. Violações e Rescisão
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <p style="margin-bottom: 1rem;">
                    Reservamo-nos o direito de:
                </p>
                <ul style="list-style: disc; padding-left: 1.5rem; margin-bottom: 1rem;">
                    <li style="margin-bottom: 0.5rem;">Revogar sua licença em caso de violação dos termos</li>
                    <li style="margin-bottom: 0.5rem;">Bloquear acesso a usuários que violem estas condições</li>
                    <li style="margin-bottom: 0.5rem;">Tomar medidas legais para proteger nossos direitos</li>
                    <li style="margin-bottom: 0.5rem;">Modificar ou descontinuar o serviço a qualquer momento</li>
                </ul>
                <p>
                    A rescisão não afeta direitos e obrigações anteriores à data de rescisão.
                </p>
            </div>
        </section>

        <!-- 9. Modificações na Licença -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: var(--accent-400); font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-edit"></i>
                9. Modificações na Licença
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <p style="margin-bottom: 1rem;">
                    Podemos modificar esta licença ocasionalmente:
                </p>
                <ul style="list-style: disc; padding-left: 1.5rem;">
                    <li style="margin-bottom: 0.5rem;">Atualizaremos a data de "Última atualização"</li>
                    <li style="margin-bottom: 0.5rem;">Notificaremos sobre mudanças significativas</li>
                    <li style="margin-bottom: 0.5rem;">O uso continuado implica aceitação das novas condições</li>
                    <li style="margin-bottom: 0.5rem;">Versões anteriores permanecerão válidas para uso existente</li>
                </ul>
            </div>
        </section>

        <!-- 10. Contato e Suporte -->
        <section style="margin-bottom: 3rem;">
            <h2 style="color: var(--accent-400); font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-envelope"></i>
                10. Contato e Suporte
            </h2>
            <div style="color: #cbd5e1; line-height: 1.6;">
                <p style="margin-bottom: 1rem;">
                    Para questões sobre licenciamento:
                </p>
                <div style="background: rgba(30, 41, 59, 0.8); border: 1px solid rgba(71, 85, 105, 0.5); border-radius: 0.5rem; padding: 1rem;">
                    <p style="margin-bottom: 0.5rem;"><strong>Email:</strong> contato@webeetools.com</p>
                    <p style="margin-bottom: 0.5rem;"><strong>Assunto:</strong> "Licença - [Sua dúvida]"</p>
                    <p style="margin-bottom: 0.5rem;"><strong>Website:</strong> <a href="/" style="color: var(--accent-400); text-decoration: none;">webeetools.com</a></p>
                    <p><strong>Documentação:</strong> <a href="/termos-de-uso" style="color: var(--accent-400); text-decoration: none;">Termos de Uso</a></p>
                </div>
            </div>
        </section>

    </div>

    <!-- Resumo da Licença -->
    <div style="margin-top: 2rem; background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(168, 85, 247, 0.1)); border: 1px solid rgba(59, 130, 246, 0.2); border-radius: 1rem; padding: 1.5rem;">
        <h3 style="color: #60a5fa; font-size: 1.25rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
            <i class="fas fa-balance-scale"></i>
            Resumo da Licença
        </h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; text-align: center;">
            <div>
                <div style="font-size: 3rem; margin-bottom: 0.5rem;">✅</div>
                <h4 style="color: #34d399; font-weight: 700;">Uso Livre</h4>
                <p style="color: #cbd5e1; font-size: 0.875rem;">Pessoal e comercial gratuito</p>
            </div>
            <div>
                <div style="font-size: 3rem; margin-bottom: 0.5rem;">🔒</div>
                <h4 style="color: #60a5fa; font-weight: 700;">Código Protegido</h4>
                <p style="color: #cbd5e1; font-size: 0.875rem;">Proprietário e protegido</p>
            </div>
            <div>
                <div style="font-size: 3rem; margin-bottom: 0.5rem;">⚖️</div>
                <h4 style="color: #c084fc; font-weight: 700;">Sem Garantias</h4>
                <p style="color: #cbd5e1; font-size: 0.875rem;">Use por sua conta e risco</p>
            </div>
        </div>
    </div>

    <!-- Navegação -->
    <div style="margin-top: 2rem; display: flex; flex-wrap: wrap; gap: 1rem; justify-content: space-between;">
        <a href="/cookies" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i>
            Política de Cookies
        </a>
        <a href="/" class="btn btn-primary">
            Voltar ao Início
            <i class="fas fa-home"></i>
        </a>
    </div>
</div>
@endsection 