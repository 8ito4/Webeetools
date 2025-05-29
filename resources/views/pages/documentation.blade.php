@extends('layouts.modern')

@section('title', 'Documentação da API - Webeetools')

@section('styles')
.docs-nav {
    position: sticky;
    top: 5rem;
    background: rgba(15, 23, 42, 0.6);
    border: 1px solid rgba(71, 85, 105, 0.3);
    border-radius: 0.75rem;
    padding: 1.5rem;
    backdrop-filter: blur(10px);
    height: fit-content;
}

.docs-nav h3 {
    color: #f1f5f9;
    font-size: 1.125rem;
    font-weight: 600;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.docs-nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.docs-nav li {
    margin-bottom: 0.5rem;
}

.docs-nav a {
    color: #9ca3af;
    text-decoration: none;
    font-size: 0.875rem;
    padding: 0.5rem 0.75rem;
    border-radius: 0.375rem;
    display: block;
    transition: all 0.3s ease;
}

.docs-nav a:hover,
.docs-nav a.active {
    color: var(--accent-400);
    background: rgba(234, 179, 8, 0.1);
}

.docs-content {
    background: rgba(15, 23, 42, 0.6);
    border: 1px solid rgba(71, 85, 105, 0.3);
    border-radius: 0.75rem;
    padding: 2rem;
    backdrop-filter: blur(10px);
}

.docs-section {
    margin-bottom: 3rem;
}

.docs-section h2 {
    color: #f1f5f9;
    font-size: 1.875rem;
    font-weight: 700;
    margin-bottom: 1rem;
    border-bottom: 2px solid rgba(234, 179, 8, 0.3);
    padding-bottom: 0.5rem;
}

.docs-section h2 .section-title {
    color: var(--accent-400);
}

.docs-section h3 {
    color: #e2e8f0;
    font-size: 1.375rem;
    font-weight: 600;
    margin: 2rem 0 1rem 0;
}

.docs-section h4 {
    color: #cbd5e1;
    font-size: 1.125rem;
    font-weight: 600;
    margin: 1.5rem 0 0.75rem 0;
}

.docs-section p {
    color: #9ca3af;
    line-height: 1.6;
    margin-bottom: 1rem;
}

.code-block {
    background: #1e1e1e;
    border: 1px solid #3c3c3c;
    border-radius: 0.5rem;
    padding: 1rem;
    margin: 1rem 0;
    position: relative;
    overflow-x: auto;
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.875rem;
}

.code-block pre {
    margin: 0;
    color: #d4d4d4;
}

/* Syntax highlighting VSCode style */
.code-block .json-key {
    color: #9cdcfe;
}

.code-block .json-string {
    color: #ce9178;
}

.code-block .json-number {
    color: #b5cea8;
}

.code-block .json-boolean {
    color: #569cd6;
}

.code-block .json-null {
    color: #569cd6;
}

.code-block .comment {
    color: #6a9955;
    font-style: italic;
}

.code-block .keyword {
    color: #c586c0;
}

.code-block .function {
    color: #dcdcaa;
}

.code-block .string {
    color: #ce9178;
}

.code-block .variable {
    color: #9cdcfe;
}

.copy-code {
    position: absolute;
    top: 0.5rem;
    right: 0.5rem;
    background: rgba(234, 179, 8, 0.1);
    border: 1px solid rgba(234, 179, 8, 0.3);
    color: var(--accent-400);
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-size: 0.75rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.copy-code:hover {
    background: rgba(234, 179, 8, 0.2);
}

.endpoint-card {
    background: rgba(30, 41, 59, 0.5);
    border: 1px solid rgba(71, 85, 105, 0.3);
    border-radius: 0.5rem;
    padding: 1.5rem;
    margin: 1rem 0;
}

.endpoint-method {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 0.25rem;
    font-size: 0.75rem;
    font-weight: 600;
    margin-right: 0.75rem;
}

.method-get {
    background: rgba(34, 197, 94, 0.2);
    color: #22c55e;
    border: 1px solid rgba(34, 197, 94, 0.3);
}

.method-post {
    background: rgba(59, 130, 246, 0.2);
    color: #3b82f6;
    border: 1px solid rgba(59, 130, 246, 0.3);
}

.endpoint-url {
    font-family: 'JetBrains Mono', monospace;
    color: var(--accent-400);
    font-size: 0.875rem;
}

.param-table {
    width: 100%;
    border-collapse: collapse;
    margin: 1rem 0;
}

.param-table th,
.param-table td {
    padding: 0.75rem;
    text-align: left;
    border-bottom: 1px solid rgba(71, 85, 105, 0.3);
}

.param-table th {
    background: rgba(30, 41, 59, 0.5);
    color: #e2e8f0;
    font-weight: 600;
}

.param-table td {
    color: #9ca3af;
}

.param-type {
    color: var(--accent-400);
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.75rem;
}

.status-badge {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 0.25rem;
    font-size: 0.75rem;
    font-weight: 600;
    margin-right: 0.5rem;
}

.status-200 {
    background: rgba(34, 197, 94, 0.2);
    color: #22c55e;
}

.status-400 {
    background: rgba(239, 68, 68, 0.2);
    color: #ef4444;
}

.status-500 {
    background: rgba(156, 163, 175, 0.2);
    color: #9ca3af;
}

.highlight {
    background: rgba(234, 179, 8, 0.1);
    color: var(--accent-300);
    padding: 0.125rem 0.25rem;
    border-radius: 0.25rem;
    font-family: 'JetBrains Mono', monospace;
}

@media (max-width: 1024px) {
    .docs-grid {
        grid-template-columns: 1fr;
    }
    
    .docs-nav {
        position: static;
        margin-bottom: 2rem;
    }
}
@endsection

@section('content')
<div class="tool-container">
    <div class="tool-header">
        <h1 class="tool-title">
            <i class="fas fa-code" style="color: var(--accent-400); margin-right: 0.5rem;"></i>
            Documentação da API
        </h1>
        <p class="tool-description">
            Integre as ferramentas do Webeetools em seus projetos através da nossa API REST
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-2rem" style="display: grid; grid-template-columns: 1fr 3fr; gap: 2rem;">
        <!-- Navegação -->
        <div class="docs-nav">
            <h3>
                <i class="fas fa-list"></i>
                Índice
            </h3>
            <ul>
                <li><a href="#introduction" onclick="scrollToSection('introduction')">Introdução</a></li>
                <li><a href="#authentication" onclick="scrollToSection('authentication')">Autenticação</a></li>
                <li><a href="#endpoints" onclick="scrollToSection('endpoints')">Endpoints</a></li>
                <li><a href="#whatsapp-api" onclick="scrollToSection('whatsapp-api')">WhatsApp Link</a></li>
                <li><a href="#json-api" onclick="scrollToSection('json-api')">JSON Formatter</a></li>
                <li><a href="#password-api" onclick="scrollToSection('password-api')">Gerador de Senhas</a></li>
                <li><a href="#lorem-api" onclick="scrollToSection('lorem-api')">Lorem Ipsum</a></li>
                <li><a href="#examples" onclick="scrollToSection('examples')">Exemplos</a></li>
                <li><a href="#sdks" onclick="scrollToSection('sdks')">SDKs</a></li>
                <li><a href="#limits" onclick="scrollToSection('limits')">Limites</a></li>
                <li><a href="#support" onclick="scrollToSection('support')">Suporte</a></li>
            </ul>
        </div>

        <!-- Conteúdo -->
        <div class="docs-content">
            <!-- Introdução -->
            <section id="introduction" class="docs-section">
                <h2><span class="section-title">Introdução</span></h2>
                <p>
                    A API do Webeetools permite que você integre nossas ferramentas em seus aplicativos, sites ou sistemas. 
                    Nossa API REST é simples de usar, bem documentada e oferece respostas em JSON.
                </p>
                
                <h3>URL Base</h3>
                <div class="code-block">
                    <button class="copy-code" onclick="copyCode(this)">Copiar</button>
                    <pre>https://webeetools.com/api/v1</pre>
                </div>

                <h3>Características</h3>
                <ul style="color: #9ca3af; line-height: 1.6;">
                    <li>✅ API REST com respostas JSON</li>
                    <li>✅ Autenticação opcional via API Key</li>
                    <li>✅ Suporte a CORS para aplicações web</li>
                    <li>✅ Rate limiting amigável (1000 requests/hora)</li>
                    <li>✅ Códigos de status HTTP padrão</li>
                    <li>✅ Documentação interativa</li>
                </ul>
            </section>

            <!-- Autenticação -->
            <section id="authentication" class="docs-section">
                <h2><span class="section-title">Autenticação</span></h2>
                <p>
                    Para usar nossa API, você pode optar por usar uma chave de API para ter acesso a recursos premium e limites maiores.
                </p>

                <h3>Uso Público (Sem Autenticação)</h3>
                <p>
                    Você pode usar a maioria dos endpoints sem autenticação, mas com limites reduzidos.
                </p>

                <h3>API Key (Recomendado)</h3>
                <p>
                    Para obter uma API Key gratuita, envie um email para <span class="highlight">8ito4.contato@gmail.com</span> com:
                </p>
                <ul style="color: #9ca3af; line-height: 1.6;">
                    <li>Nome do seu projeto</li>
                    <li>Breve descrição do uso</li>
                    <li>Volume estimado de requests</li>
                </ul>

                <h4>Como usar a API Key</h4>
                <div class="code-block">
                    <button class="copy-code" onclick="copyCode(this)">Copiar</button>
                    <pre><span class="comment">// Header de autorização</span>
<span class="json-key">Authorization</span>: <span class="string">Bearer SUA_API_KEY</span>

<span class="comment">// Ou como parâmetro na URL</span>
<span class="variable">?api_key=SUA_API_KEY</span></pre>
                </div>
            </section>

            <!-- Endpoints -->
            <section id="endpoints" class="docs-section">
                <h2><span class="section-title">Endpoints Disponíveis</span></h2>
                <p>
                    Aqui estão todos os endpoints disponíveis em nossa API:
                </p>

                <!-- WhatsApp API -->
                <div id="whatsapp-api" class="docs-section">
                    <h3>📱 WhatsApp Link Generator</h3>
                    <p>Gera links diretos para WhatsApp com mensagem personalizada.</p>
                    
                    <div class="endpoint-card">
                        <div>
                            <span class="endpoint-method method-post">POST</span>
                            <span class="endpoint-url">/api/v1/whatsapp/generate</span>
                        </div>
                        
                        <h4>Parâmetros</h4>
                        <table class="param-table">
                            <thead>
                                <tr>
                                    <th>Parâmetro</th>
                                    <th>Tipo</th>
                                    <th>Obrigatório</th>
                                    <th>Descrição</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>phone</td>
                                    <td><span class="param-type">string</span></td>
                                    <td>Sim</td>
                                    <td>Número de telefone com código do país</td>
                                </tr>
                                <tr>
                                    <td>message</td>
                                    <td><span class="param-type">string</span></td>
                                    <td>Não</td>
                                    <td>Mensagem pré-preenchida (max: 1000 chars)</td>
                                </tr>
                                <tr>
                                    <td>shorten</td>
                                    <td><span class="param-type">boolean</span></td>
                                    <td>Não</td>
                                    <td>Encurtar o link gerado (default: true)</td>
                                </tr>
                            </tbody>
                        </table>

                        <h4>Exemplo de Requisição</h4>
                        <div class="code-block">
                            <button class="copy-code" onclick="copyCode(this)">Copiar</button>
                            <pre><span class="function">curl</span> <span class="variable">-X</span> <span class="string">POST</span> <span class="string">https://webeetools.com/api/v1/whatsapp/generate</span> \
  <span class="variable">-H</span> <span class="string">"Content-Type: application/json"</span> \
  <span class="variable">-H</span> <span class="string">"Authorization: Bearer SUA_API_KEY"</span> \
  <span class="variable">-d</span> <span class="string">'{
    "<span class="json-key">phone</span>": "<span class="json-string">+5511999999999</span>",
    "<span class="json-key">message</span>": "<span class="json-string">Olá! Vim através do seu site.</span>",
    "<span class="json-key">shorten</span>": <span class="json-boolean">true</span>
  }'</span></pre>
                        </div>

                        <h4>Resposta</h4>
                        <div class="code-block">
                            <button class="copy-code" onclick="copyCode(this)">Copiar</button>
                            <pre>{
  <span class="json-key">"success"</span>: <span class="json-boolean">true</span>,
  <span class="json-key">"data"</span>: {
    <span class="json-key">"original_url"</span>: <span class="json-string">"https://wa.me/5511999999999?text=Ol%C3%A1%21%20Vim%20atrav%C3%A9s%20do%20seu%20site."</span>,
    <span class="json-key">"short_url"</span>: <span class="json-string">"https://webeetools.link/w4x8k2"</span>,
    <span class="json-key">"phone"</span>: <span class="json-string">"+5511999999999"</span>,
    <span class="json-key">"message"</span>: <span class="json-string">"Olá! Vim através do seu site."</span>
  },
  <span class="json-key">"meta"</span>: {
    <span class="json-key">"generated_at"</span>: <span class="json-string">"2024-01-20T10:30:00Z"</span>,
    <span class="json-key">"expires_at"</span>: <span class="json-null">null</span>
  }
}</pre>
                        </div>
                    </div>
                </div>

                <!-- JSON API -->
                <div id="json-api" class="docs-section">
                    <h3>🔧 JSON Formatter</h3>
                    <p>Formata, valida e minifica dados JSON.</p>
                    
                    <div class="endpoint-card">
                        <div>
                            <span class="endpoint-method method-post">POST</span>
                            <span class="endpoint-url">/api/v1/json/format</span>
                        </div>
                        
                        <h4>Parâmetros</h4>
                        <table class="param-table">
                            <thead>
                                <tr>
                                    <th>Parâmetro</th>
                                    <th>Tipo</th>
                                    <th>Obrigatório</th>
                                    <th>Descrição</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>json</td>
                                    <td><span class="param-type">string</span></td>
                                    <td>Sim</td>
                                    <td>String JSON para processar</td>
                                </tr>
                                <tr>
                                    <td>action</td>
                                    <td><span class="param-type">string</span></td>
                                    <td>Não</td>
                                    <td>format, minify, validate (default: format)</td>
                                </tr>
                                <tr>
                                    <td>indent</td>
                                    <td><span class="param-type">integer</span></td>
                                    <td>Não</td>
                                    <td>Espaços para indentação (default: 2)</td>
                                </tr>
                            </tbody>
                        </table>

                        <h4>Exemplo de Requisição</h4>
                        <div class="code-block">
                            <button class="copy-code" onclick="copyCode(this)">Copiar</button>
                            <pre><span class="function">curl</span> <span class="variable">-X</span> <span class="string">POST</span> <span class="string">https://webeetools.com/api/v1/json/format</span> \
  <span class="variable">-H</span> <span class="string">"Content-Type: application/json"</span> \
  <span class="variable">-d</span> <span class="string">'{
    "<span class="json-key">json</span>": "<span class="json-string">{\"name\":\"João\",\"age\":30}</span>",
    "<span class="json-key">action</span>": "<span class="json-string">format</span>",
    "<span class="json-key">indent</span>": <span class="json-number">2</span>
  }'</span></pre>
                        </div>
                    </div>
                </div>

                <!-- Password API -->
                <div id="password-api" class="docs-section">
                    <h3>🔐 Gerador de Senhas</h3>
                    <p>Gera senhas seguras e personalizáveis.</p>
                    
                    <div class="endpoint-card">
                        <div>
                            <span class="endpoint-method method-get">GET</span>
                            <span class="endpoint-url">/api/v1/password/generate</span>
                        </div>
                        
                        <h4>Parâmetros (Query String)</h4>
                        <table class="param-table">
                            <thead>
                                <tr>
                                    <th>Parâmetro</th>
                                    <th>Tipo</th>
                                    <th>Default</th>
                                    <th>Descrição</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>length</td>
                                    <td><span class="param-type">integer</span></td>
                                    <td>12</td>
                                    <td>Comprimento da senha (8-128)</td>
                                </tr>
                                <tr>
                                    <td>uppercase</td>
                                    <td><span class="param-type">boolean</span></td>
                                    <td>true</td>
                                    <td>Incluir letras maiúsculas</td>
                                </tr>
                                <tr>
                                    <td>lowercase</td>
                                    <td><span class="param-type">boolean</span></td>
                                    <td>true</td>
                                    <td>Incluir letras minúsculas</td>
                                </tr>
                                <tr>
                                    <td>numbers</td>
                                    <td><span class="param-type">boolean</span></td>
                                    <td>true</td>
                                    <td>Incluir números</td>
                                </tr>
                                <tr>
                                    <td>symbols</td>
                                    <td><span class="param-type">boolean</span></td>
                                    <td>true</td>
                                    <td>Incluir símbolos</td>
                                </tr>
                            </tbody>
                        </table>

                        <h4>Exemplo de Requisição</h4>
                        <div class="code-block">
                            <button class="copy-code" onclick="copyCode(this)">Copiar</button>
                            <pre>curl "https://webeetools.com/api/v1/password/generate?length=16&symbols=false"</pre>
                        </div>
                    </div>
                </div>

                <!-- Lorem API -->
                <div id="lorem-api" class="docs-section">
                    <h3>📝 Lorem Ipsum Generator</h3>
                    <p>Gera texto placeholder em diferentes formatos.</p>
                    
                    <div class="endpoint-card">
                        <div>
                            <span class="endpoint-method method-get">GET</span>
                            <span class="endpoint-url">/api/v1/lorem/generate</span>
                        </div>
                        
                        <h4>Parâmetros (Query String)</h4>
                        <table class="param-table">
                            <thead>
                                <tr>
                                    <th>Parâmetro</th>
                                    <th>Tipo</th>
                                    <th>Default</th>
                                    <th>Descrição</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>type</td>
                                    <td><span class="param-type">string</span></td>
                                    <td>paragraphs</td>
                                    <td>words, sentences, paragraphs</td>
                                </tr>
                                <tr>
                                    <td>count</td>
                                    <td><span class="param-type">integer</span></td>
                                    <td>3</td>
                                    <td>Quantidade a gerar (1-50)</td>
                                </tr>
                                <tr>
                                    <td>start_with_lorem</td>
                                    <td><span class="param-type">boolean</span></td>
                                    <td>true</td>
                                    <td>Começar com "Lorem ipsum..."</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- Exemplos -->
            <section id="examples" class="docs-section">
                <h2><span class="section-title">Exemplos de Uso</span></h2>
                
                <h3>JavaScript (Fetch API)</h3>
                <div class="code-block">
                    <button class="copy-code" onclick="copyCode(this)">Copiar</button>
                    <pre><span class="comment">// Gerar link do WhatsApp</span>
<span class="keyword">async function</span> <span class="function">generateWhatsAppLink</span>(<span class="variable">phone</span>, <span class="variable">message</span>) {
  <span class="keyword">const</span> <span class="variable">response</span> = <span class="keyword">await</span> <span class="function">fetch</span>(<span class="string">'https://webeetools.com/api/v1/whatsapp/generate'</span>, {
    <span class="json-key">method</span>: <span class="string">'POST'</span>,
    <span class="json-key">headers</span>: {
      <span class="string">'Content-Type'</span>: <span class="string">'application/json'</span>,
      <span class="string">'Authorization'</span>: <span class="string">'Bearer SUA_API_KEY'</span>
    },
    <span class="json-key">body</span>: <span class="function">JSON.stringify</span>({ <span class="variable">phone</span>, <span class="variable">message</span>, <span class="json-key">shorten</span>: <span class="json-boolean">true</span> })
  });
  
  <span class="keyword">const</span> <span class="variable">data</span> = <span class="keyword">await</span> <span class="variable">response</span>.<span class="function">json</span>();
  <span class="keyword">return</span> <span class="variable">data</span>.<span class="variable">data</span>.<span class="variable">short_url</span>;
}</pre>
                </div>

                <h3>PHP (cURL)</h3>
                <div class="code-block">
                    <button class="copy-code" onclick="copyCode(this)">Copiar</button>
                    <pre><span class="keyword">&lt;?php</span>
<span class="comment">// Gerar senha segura</span>
<span class="keyword">function</span> <span class="function">generatePassword</span>(<span class="variable">$length</span> = <span class="json-number">12</span>) {
    <span class="variable">$url</span> = <span class="string">"https://webeetools.com/api/v1/password/generate?length="</span> . <span class="variable">$length</span>;
    
    <span class="variable">$ch</span> = <span class="function">curl_init</span>();
    <span class="function">curl_setopt</span>(<span class="variable">$ch</span>, <span class="variable">CURLOPT_URL</span>, <span class="variable">$url</span>);
    <span class="function">curl_setopt</span>(<span class="variable">$ch</span>, <span class="variable">CURLOPT_RETURNTRANSFER</span>, <span class="json-boolean">true</span>);
    <span class="function">curl_setopt</span>(<span class="variable">$ch</span>, <span class="variable">CURLOPT_HTTPHEADER</span>, [
        <span class="string">'Authorization: Bearer SUA_API_KEY'</span>
    ]);
    
    <span class="variable">$response</span> = <span class="function">curl_exec</span>(<span class="variable">$ch</span>);
    <span class="function">curl_close</span>(<span class="variable">$ch</span>);
    
    <span class="variable">$data</span> = <span class="function">json_decode</span>(<span class="variable">$response</span>, <span class="json-boolean">true</span>);
    <span class="keyword">return</span> <span class="variable">$data</span>[<span class="string">'data'</span>][<span class="string">'password'</span>];
}
<span class="keyword">?&gt;</span></pre>
                </div>

                <h3>Python (Requests)</h3>
                <div class="code-block">
                    <button class="copy-code" onclick="copyCode(this)">Copiar</button>
                    <pre><span class="keyword">import</span> <span class="variable">requests</span>

<span class="comment"># Formatar JSON</span>
<span class="keyword">def</span> <span class="function">format_json</span>(<span class="variable">json_string</span>):
    <span class="variable">url</span> = <span class="string">"https://webeetools.com/api/v1/json/format"</span>
    
    <span class="variable">data</span> = {
        <span class="string">"json"</span>: <span class="variable">json_string</span>,
        <span class="string">"action"</span>: <span class="string">"format"</span>,
        <span class="string">"indent"</span>: <span class="json-number">2</span>
    }
    
    <span class="variable">headers</span> = {
        <span class="string">"Content-Type"</span>: <span class="string">"application/json"</span>,
        <span class="string">"Authorization"</span>: <span class="string">"Bearer SUA_API_KEY"</span>
    }
    
    <span class="variable">response</span> = <span class="variable">requests</span>.<span class="function">post</span>(<span class="variable">url</span>, <span class="variable">json</span>=<span class="variable">data</span>, <span class="variable">headers</span>=<span class="variable">headers</span>)
    <span class="keyword">return</span> <span class="variable">response</span>.<span class="function">json</span>()[<span class="string">"data"</span>][<span class="string">"formatted"</span>]</pre>
                </div>
            </section>

            <!-- SDKs -->
            <section id="sdks" class="docs-section">
                <h2><span class="section-title">SDKs e Bibliotecas</span></h2>
                <p>
                    Estamos desenvolvendo SDKs oficiais para facilitar a integração:
                </p>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin: 2rem 0;">
                    <div style="background: rgba(30, 41, 59, 0.5); border: 1px solid rgba(71, 85, 105, 0.3); border-radius: 0.5rem; padding: 1rem; text-align: center;">
                        <h4 style="color: #f1f5f9; margin-bottom: 0.5rem;">
                            <i class="fab fa-js-square" style="color: #f7df1e;"></i> JavaScript/Node.js
                        </h4>
                        <p style="color: #9ca3af; font-size: 0.875rem;">Em desenvolvimento</p>
                    </div>
                    
                    <div style="background: rgba(30, 41, 59, 0.5); border: 1px solid rgba(71, 85, 105, 0.3); border-radius: 0.5rem; padding: 1rem; text-align: center;">
                        <h4 style="color: #f1f5f9; margin-bottom: 0.5rem;">
                            <i class="fab fa-php" style="color: #777bb4;"></i> PHP
                        </h4>
                        <p style="color: #9ca3af; font-size: 0.875rem;">Em desenvolvimento</p>
                    </div>
                    
                    <div style="background: rgba(30, 41, 59, 0.5); border: 1px solid rgba(71, 85, 105, 0.3); border-radius: 0.5rem; padding: 1rem; text-align: center;">
                        <h4 style="color: #f1f5f9; margin-bottom: 0.5rem;">
                            <i class="fab fa-python" style="color: #3776ab;"></i> Python
                        </h4>
                        <p style="color: #9ca3af; font-size: 0.875rem;">Em desenvolvimento</p>
                    </div>
                </div>

                <p style="color: #9ca3af;">
                    <strong>Quer ajudar?</strong> Entre em contato conosco se quiser contribuir com um SDK para sua linguagem favorita!
                </p>
            </section>

            <!-- Limites -->
            <section id="limits" class="docs-section">
                <h2><span class="section-title">Limites e Rate Limiting</span></h2>
                
                <h3>Plano Gratuito (Sem API Key)</h3>
                <ul style="color: #9ca3af; line-height: 1.6;">
                    <li>100 requests por hora</li>
                    <li>Máximo 10 requests por minuto</li>
                    <li>Sem suporte prioritário</li>
                </ul>

                <h3>Plano com API Key (Gratuito)</h3>
                <ul style="color: #9ca3af; line-height: 1.6;">
                    <li>1.000 requests por hora</li>
                    <li>Máximo 100 requests por minuto</li>
                    <li>Suporte por email</li>
                    <li>Estatísticas de uso</li>
                </ul>

                <h3>Headers de Rate Limiting</h3>
                <div class="code-block">
                    <button class="copy-code" onclick="copyCode(this)">Copiar</button>
                    <pre><span class="variable">X-RateLimit-Limit</span>: <span class="json-number">1000</span>
<span class="variable">X-RateLimit-Remaining</span>: <span class="json-number">999</span>
<span class="variable">X-RateLimit-Reset</span>: <span class="json-number">1642680000</span></pre>
                </div>
            </section>

            <!-- Suporte -->
            <section id="support" class="docs-section">
                <h2><span class="section-title">Suporte</span></h2>
                <p>
                    Precisando de ajuda? Estamos aqui para você!
                </p>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; margin: 2rem 0;">
                    <div style="background: rgba(30, 41, 59, 0.5); border: 1px solid rgba(71, 85, 105, 0.3); border-radius: 0.5rem; padding: 1.5rem;">
                        <h4 style="color: #f1f5f9; margin-bottom: 1rem;">
                            <i class="fas fa-envelope" style="color: var(--accent-400);"></i> Email
                        </h4>
                        <p style="color: #9ca3af; margin-bottom: 0.5rem;">Para questões técnicas e solicitação de API Keys:</p>
                        <a href="mailto:8ito4.contato@gmail.com" style="color: var(--accent-400);">8ito4.contato@gmail.com</a>
                    </div>
                    
                    <div style="background: rgba(30, 41, 59, 0.5); border: 1px solid rgba(71, 85, 105, 0.3); border-radius: 0.5rem; padding: 1.5rem;">
                        <h4 style="color: #f1f5f9; margin-bottom: 1rem;">
                            <i class="fab fa-github" style="color: var(--accent-400);"></i> GitHub
                        </h4>
                        <p style="color: #9ca3af; margin-bottom: 0.5rem;">Para reportar bugs e sugerir melhorias:</p>
                        <a href="https://github.com/8ito4" style="color: var(--accent-400);">github.com/8ito4</a>
                    </div>
                </div>

                <h3>Status da API</h3>
                <p>
                    Monitore o status em tempo real da nossa API: 
                    <a href="https://status.webeetools.com" style="color: var(--accent-400);">status.webeetools.com</a>
                </p>
            </section>
        </div>
    </div>
</div>

<script>
function scrollToSection(sectionId) {
    const element = document.getElementById(sectionId);
    if (element) {
        element.scrollIntoView({ behavior: 'smooth' });
        
        // Atualizar navegação ativa
        document.querySelectorAll('.docs-nav a').forEach(link => {
            link.classList.remove('active');
        });
        document.querySelector(`.docs-nav a[href="#${sectionId}"]`).classList.add('active');
    }
}

function copyCode(button) {
    const codeBlock = button.nextElementSibling;
    const text = codeBlock.textContent;
    
    navigator.clipboard.writeText(text).then(() => {
        const originalText = button.textContent;
        button.textContent = 'Copiado!';
        button.style.background = 'rgba(16, 185, 129, 0.2)';
        button.style.color = '#10b981';
        
        setTimeout(() => {
            button.textContent = originalText;
            button.style.background = 'rgba(234, 179, 8, 0.1)';
            button.style.color = 'var(--accent-400)';
        }, 2000);
    });
}

// Destacar seção ativa ao scrollar
document.addEventListener('scroll', function() {
    const sections = document.querySelectorAll('.docs-section');
    const navLinks = document.querySelectorAll('.docs-nav a');
    
    let current = '';
    sections.forEach(section => {
        const sectionTop = section.getBoundingClientRect().top;
        if (sectionTop <= 100) {
            current = section.getAttribute('id');
        }
    });
    
    navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === '#' + current) {
            link.classList.add('active');
        }
    });
});
</script>
@endsection 