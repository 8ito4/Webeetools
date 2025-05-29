@extends('layouts.modern')

@section('title', 'Formatador JSON - Webeetools')

@section('styles')
/* JSON Syntax Highlighting */
.json-string { color: #ce9178; }
.json-number { color: #b5cea8; }
.json-boolean { color: #569cd6; }
.json-null { color: #569cd6; }
.json-key { color: #9cdcfe; }

.json-output {
    white-space: pre;
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.875rem;
    line-height: 1.25rem;
    tab-size: 4;
    padding: 1rem;
    background: rgba(2, 6, 23, 0.8);
    color: #d4d4d4;
    border-radius: 0.5rem;
    border: 1px solid rgba(71, 85, 105, 0.5);
    overflow: auto;
    min-height: 400px;
    position: relative;
}

.json-input {
    font-family: 'JetBrains Mono', monospace;
    border: 2px solid rgba(71, 85, 105, 0.5);
    transition: all 0.3s ease;
}

.json-input.valid {
    border-color: #10b981;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
}

.json-input.invalid {
    border-color: #ef4444;
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}

.copy-button {
    position: absolute;
    top: 0.75rem;
    right: 0.75rem;
    z-index: 10;
    padding: 0.5rem;
    border-radius: 0.25rem;
    background: rgba(15, 23, 42, 0.8);
    color: #9ca3af;
    border: 1px solid rgba(71, 85, 105, 0.3);
    cursor: pointer;
    transition: all 0.3s ease;
}

.copy-button:hover {
    background: rgba(30, 41, 59, 0.8);
    color: var(--accent-400);
    border-color: var(--accent-400);
}

.clear-button {
    position: absolute;
    top: 0.75rem;
    right: 0.75rem;
    color: #9ca3af;
    cursor: pointer;
    transition: all 0.3s ease;
    padding: 0.25rem;
    border-radius: 0.25rem;
}

.clear-button:hover {
    color: #ef4444;
    background: rgba(239, 68, 68, 0.1);
}

.status-message {
    padding: 1rem;
    border-radius: 0.5rem;
    margin-top: 1rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.status-success {
    background: rgba(16, 185, 129, 0.1);
    border: 1px solid rgba(16, 185, 129, 0.3);
    color: #10b981;
}

.status-error {
    background: rgba(239, 68, 68, 0.1);
    border: 1px solid rgba(239, 68, 68, 0.3);
    color: #ef4444;
}

.status-warning {
    background: rgba(245, 158, 11, 0.1);
    border: 1px solid rgba(245, 158, 11, 0.3);
    color: #f59e0b;
}

.status-info {
    background: rgba(59, 130, 246, 0.1);
    border: 1px solid rgba(59, 130, 246, 0.3);
    color: #3b82f6;
}
@endsection

@section('content')
<div class="tool-container">
    <div class="tool-header">
        <h1 class="tool-title">
            <i class="fas fa-code" style="color: var(--accent-400); margin-right: 0.5rem;"></i>
            Formatador JSON
        </h1>
        <p class="tool-description">
            Formate e corrija seus dados JSON com facilidade
        </p>
    </div>

    <div class="tool-content">
        <div class="grid grid-cols-2">
            <div class="form-group">
                <label class="form-label" for="input">
                    <i class="fas fa-edit"></i> JSON de Entrada
                </label>
                <div style="position: relative;">
                    <textarea id="input" 
                        class="form-textarea json-input" 
                        style="min-height: 400px;"
                        placeholder='{"exemplo": "Cole seu JSON aqui"}'></textarea>
                    <button onclick="clearInput()" class="clear-button">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="output">
                    <i class="fas fa-code"></i> JSON Formatado
                </label>
                <div style="position: relative;">
                    <pre id="output" class="json-output"></pre>
                    <button onclick="copyOutput()" class="copy-button">
                        <i class="far fa-copy"></i>
                    </button>
                </div>
            </div>
        </div>

        <div style="display: flex; flex-wrap: wrap; gap: 1rem; margin-top: 1.5rem;">
            <button onclick="formatJSON()" class="btn btn-primary">
                <i class="fas fa-indent"></i>
                Formatar
            </button>
            <button onclick="correctJSON()" class="btn btn-accent">
                <i class="fas fa-magic"></i>
                Corrigir Automaticamente
            </button>
            <button onclick="loadTestExample()" class="btn btn-secondary">
                <i class="fas fa-flask"></i>
                Exemplo de Teste
            </button>
        </div>

        <div id="status" class="hidden"></div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 Formatador JSON carregado!');
    
    // Carrega exemplo inicial
    document.getElementById('input').value = '{"nome": "João", "idade": 30, "ativo": true}';
    
    console.log('✅ Formatador pronto para uso!');
});

function formatJSON() {
    console.log('📝 Formatando JSON...');
    
    const inputElement = document.getElementById('input');
    const outputElement = document.getElementById('output');
    const input = inputElement.value.trim();
    
    if (!input) {
        showStatus('Por favor, insira algum conteúdo para formatar', 'warning');
        return;
    }
    
    try {
        // Estratégia 1: Tenta parse direto primeiro
        const parsed = JSON.parse(input);
        const formatted = JSON.stringify(parsed, null, 4);
        outputElement.innerHTML = colorizeJSON(formatted);
        showStatus('JSON formatado com sucesso!', 'success');
        inputElement.classList.add('valid');
        inputElement.classList.remove('invalid');
        
    } catch (error) {
        console.log('❌ JSON inválido, tentando correção básica...');
        
        try {
            // Estratégia 2: Tenta correção básica
            const corrected = basicFix(input);
            const parsed = JSON.parse(corrected);
            const formatted = JSON.stringify(parsed, null, 4);
            
            outputElement.innerHTML = colorizeJSON(formatted);
            inputElement.value = corrected;
            showStatus('JSON corrigido e formatado com sucesso!', 'success');
            inputElement.classList.add('valid');
            inputElement.classList.remove('invalid');
            
        } catch (error2) {
            console.log('❌ Correção básica falhou, tentando extração avançada...');
            
            try {
                // Estratégia 3: Extração e reconstrução completa
                const extracted = extractAndRebuild(input);
                if (extracted) {
                    const formatted = JSON.stringify(extracted, null, 4);
                    outputElement.innerHTML = colorizeJSON(formatted);
                    inputElement.value = JSON.stringify(extracted);
                    showStatus('Dados extraídos e formatados com sucesso!', 'success');
                    inputElement.classList.add('valid');
                    inputElement.classList.remove('invalid');
                } else {
                    throw new Error('Extração falhou');
                }
                
            } catch (error3) {
                console.error('❌ Todas as estratégias falharam:', error3);
                outputElement.innerHTML = '';
                showStatus('Não foi possível formatar o conteúdo fornecido', 'error');
                inputElement.classList.add('invalid');
                inputElement.classList.remove('valid');
            }
        }
    }
}

function extractAndRebuild(input) {
    console.log('🔄 Extraindo e reconstruindo dados de forma ultra robusta...');
    
    const data = {};
    let workingText = input;
    
    // Remove chaves externas se existirem
    workingText = workingText.replace(/^\s*\{\s*/, '').replace(/\s*\}\s*$/, '');
    
    // Estratégia 1: Extração de objetos aninhados primeiro
    const nestedObjectPattern = /([a-zA-Z_$][a-zA-Z0-9_$]*)\s*:\s*\{([^}]*)\}/g;
    let match;
    while ((match = nestedObjectPattern.exec(workingText)) !== null) {
        const key = match[1];
        const content = match[2];
        
        console.log(`Extraindo objeto aninhado: ${key} = {${content}}`);
        
        const nestedData = {};
        
        // Extrai propriedades do objeto aninhado
        const nestedPairs = content.split(/[,\n;]/);
        nestedPairs.forEach(pair => {
            if (pair.includes(':')) {
                const colonIndex = pair.indexOf(':');
                let nestedKey = pair.substring(0, colonIndex).trim();
                let nestedValue = pair.substring(colonIndex + 1).trim();
                
                // Limpa chave e valor
                nestedKey = nestedKey.replace(/^["']|["']$/g, '').replace(/[^a-zA-Z0-9_]/g, '');
                nestedValue = nestedValue.replace(/^["']|["']$/g, '').replace(/[^a-zA-Z0-9\s\-@.]/g, ' ').trim();
                
                if (nestedKey && nestedValue) {
                    // Converte números
                    if (nestedValue.match(/^\d+$/)) {
                        nestedData[nestedKey] = parseInt(nestedValue);
                    } else {
                        nestedData[nestedKey] = nestedValue;
                    }
                }
            } else {
                // Propriedade sem dois pontos como "numero 1000"
                const parts = pair.trim().split(/\s+/);
                if (parts.length >= 2) {
                    const nestedKey = parts[0].replace(/[^a-zA-Z0-9_]/g, '');
                    const nestedValue = parts.slice(1).join(' ').replace(/[^a-zA-Z0-9\s\-@.]/g, ' ').trim();
                    
                    if (nestedKey && nestedValue) {
                        if (nestedValue.match(/^\d+$/)) {
                            nestedData[nestedKey] = parseInt(nestedValue);
                        } else {
                            nestedData[nestedKey] = nestedValue;
                        }
                    }
                }
            }
        });
        
        if (Object.keys(nestedData).length > 0) {
            data[key] = nestedData;
        }
        
        // Remove o objeto aninhado do texto de trabalho
        workingText = workingText.replace(match[0], '');
    }
    
    // Estratégia 2: Extração de arrays complexos
    const arrayPattern = /([a-zA-Z_$][a-zA-Z0-9_$]*)\s*:\s*\[([^\]]*)\]/g;
    while ((match = arrayPattern.exec(workingText)) !== null) {
        const key = match[1];
        const content = match[2];
        
        console.log(`Extraindo array: ${key} = [${content}]`);
        
        const arrayItems = [];
        let currentItem = '';
        let inQuotes = false;
        
        for (let i = 0; i < content.length; i++) {
            const char = content[i];
            
            if (char === '"' && content[i-1] !== '\\') {
                inQuotes = !inQuotes;
                currentItem += char;
            } else if (char === ',' && !inQuotes) {
                if (currentItem.trim()) {
                    arrayItems.push(currentItem.trim());
                }
                currentItem = '';
            } else {
                currentItem += char;
            }
        }
        
        // Adiciona o último item
        if (currentItem.trim()) {
            arrayItems.push(currentItem.trim());
        }
        
        const processedItems = [];
        
        arrayItems.forEach(item => {
            if (item.includes(':')) {
                // Item com propriedade como "livros: ficção científica"
                const parts = item.split(':');
                if (parts.length >= 2) {
                    const itemKey = parts[0].trim().replace(/^["']|["']$/g, '');
                    const itemValue = parts.slice(1).join(':').trim().replace(/^["']|["']$/g, '');
                    
                    if (itemKey) processedItems.push(itemKey);
                    if (itemValue) processedItems.push(itemValue);
                }
            } else {
                // Item normal
                const cleanItem = item.replace(/^["']|["']$/g, '');
                if (cleanItem) processedItems.push(cleanItem);
            }
        });
        
        if (processedItems.length > 0) {
            data[key] = processedItems;
        }
        
        // Remove o array do texto de trabalho
        workingText = workingText.replace(match[0], '');
    }
    
    // Estratégia 3: Padrões estruturados básicos
    const structuredPatterns = [
        // Padrão básico: chave: valor
        /([a-zA-Z_$][a-zA-Z0-9_$]*)\s*:\s*"([^"]*)"(?:\s*,|\s*$|\s*})/g,
        // Padrão com aspas na chave
        /"([^"]+)"\s*:\s*"([^"]*)"(?:\s*,|\s*$|\s*})/g,
        // Padrão com valores numéricos
        /([a-zA-Z_$][a-zA-Z0-9_$]*)\s*:\s*(\d+)(?:\s*,|\s*$|\s*})/g,
        // Padrão com valores booleanos
        /([a-zA-Z_$][a-zA-Z0-9_$]*)\s*:\s*(true|false)(?:\s*,|\s*$|\s*})/g
    ];
    
    structuredPatterns.forEach(pattern => {
        let match;
        while ((match = pattern.exec(workingText)) !== null) {
            const key = match[1].replace(/^["']|["']$/g, '');
            let value = match[2];
            
            // Evita sobrescrever objetos/arrays já extraídos
            if (!data[key]) {
                if (value === 'true' || value === 'false') {
                    data[key] = value === 'true';
                } else if (value && value.match(/^\d+$/)) {
                    data[key] = parseInt(value);
                } else {
                    data[key] = value;
                }
                
                console.log(`Extraído estruturado: ${key} = ${JSON.stringify(data[key])}`);
            }
        }
    });
    
    // Estratégia 4: Extração por vírgulas e dois pontos
    if (Object.keys(data).length === 0) {
        console.log('🔥 Tentando extração por separadores...');
        
        // Remove caracteres problemáticos mas preserva conteúdo
        let cleanText = workingText.replace(/[{}]/g, ' ');
        
        // Divide por vírgulas e tenta extrair pares
        const parts = cleanText.split(/[,\n;]/);
        
        parts.forEach(part => {
            part = part.trim();
            if (part.includes(':')) {
                const colonIndex = part.indexOf(':');
                let key = part.substring(0, colonIndex).trim();
                let value = part.substring(colonIndex + 1).trim();
                
                // Limpa a chave
                key = key.replace(/^["']|["']$/g, '');
                key = key.replace(/[^a-zA-Z0-9_$]/g, '');
                
                // Limpa o valor
                value = value.replace(/^["']|["']$/g, '');
                value = value.replace(/[^a-zA-Z0-9\s\-@.]/g, ' ').trim();
                
                if (key.length > 0 && value.length > 0 && !data[key]) {
                    data[key] = value;
                    console.log(`Extração por separador: ${key} = ${value}`);
                }
            } else {
                // Tenta extrair propriedades sem dois pontos como "nome João"
                const words = part.trim().split(/\s+/);
                if (words.length >= 2) {
                    const key = words[0].replace(/[^a-zA-Z0-9_]/g, '');
                    const value = words.slice(1).join(' ').replace(/[^a-zA-Z0-9\s\-@.]/g, ' ').trim();
                    
                    if (key.length > 0 && value.length > 0 && !data[key]) {
                        data[key] = value;
                        console.log(`Extração sem dois pontos: ${key} = ${value}`);
                    }
                }
            }
        });
    }
    
    // Estratégia 5: Extração inteligente por palavras-chave
    if (Object.keys(data).length === 0) {
        console.log('🧠 Tentando extração inteligente por palavras-chave...');
        
        const keywordPatterns = [
            // Padrões comuns de dados
            /nome[:\s]+([a-zA-Z\s]+)/gi,
            /email[:\s]+([a-zA-Z0-9@._-]+)/gi,
            /idade[:\s]+(\d+)/gi,
            /telefone[:\s]+([0-9\s\-()]+)/gi,
            /endereco[:\s]+([a-zA-Z0-9\s,.-]+)/gi,
            /cidade[:\s]+([a-zA-Z\s]+)/gi,
            /estado[:\s]+([A-Z]{2})/gi,
            /cep[:\s]+([0-9\-]+)/gi,
            /usuario[:\s]+([a-zA-Z0-9_]+)/gi,
            /senha[:\s]+([a-zA-Z0-9@#$%]+)/gi,
            /data[:\s]+([0-9\/\-]+)/gi,
            /valor[:\s]+([0-9.,]+)/gi,
            /preco[:\s]+([0-9.,]+)/gi,
            /quantidade[:\s]+(\d+)/gi,
            /descricao[:\s]+([a-zA-Z0-9\s.,!?-]+)/gi,
            /titulo[:\s]+([a-zA-Z0-9\s.,!?-]+)/gi,
            /categoria[:\s]+([a-zA-Z\s]+)/gi,
            /status[:\s]+([a-zA-Z]+)/gi,
            /ativo[:\s]+(true|false|sim|nao|yes|no)/gi,
            /tipo[:\s]+([a-zA-Z]+)/gi,
            /interesses[:\s]+([a-zA-Z0-9\s,\[\]"'-]+)/gi
        ];
        
        keywordPatterns.forEach(pattern => {
            let match;
            while ((match = pattern.exec(workingText)) !== null) {
                const key = match[0].split(/[:\s]/)[0].toLowerCase();
                let value = match[1].trim();
                
                // Converte valores especiais
                if (value.match(/^(true|sim|yes)$/i)) {
                    value = true;
                } else if (value.match(/^(false|nao|no)$/i)) {
                    value = false;
                } else if (value.match(/^\d+$/)) {
                    value = parseInt(value);
                } else if (value.includes('[') && value.includes(']')) {
                    // Tenta processar como array
                    const arrayContent = value.replace(/[\[\]]/g, '');
                    const items = arrayContent.split(',').map(item => item.trim().replace(/^["']|["']$/g, '')).filter(item => item.length > 0);
                    value = items;
                }
                
                if (!data[key]) {
                    data[key] = value;
                    console.log(`Extração inteligente: ${key} = ${JSON.stringify(value)}`);
                }
            }
        });
    }
    
    // Estratégia 6: Extração por proximidade de palavras
    if (Object.keys(data).length === 0) {
        console.log('🎯 Tentando extração por proximidade...');
        
        // Divide o texto em palavras
        const words = workingText.split(/\s+/);
        
        for (let i = 0; i < words.length - 1; i++) {
            const word = words[i].toLowerCase().replace(/[^a-zA-Z]/g, '');
            const nextWord = words[i + 1].replace(/[^a-zA-Z0-9@._-]/g, '');
            
            // Lista de palavras-chave comuns
            const commonKeys = [
                'nome', 'email', 'idade', 'telefone', 'endereco', 'cidade', 
                'estado', 'cep', 'usuario', 'senha', 'data', 'valor', 'preco',
                'quantidade', 'descricao', 'titulo', 'categoria', 'status', 'tipo',
                'interesses', 'rua', 'numero', 'bairro'
            ];
            
            if (commonKeys.includes(word) && nextWord.length > 0) {
                if (!data[word]) {
                    data[word] = nextWord;
                    console.log(`Extração por proximidade: ${word} = ${nextWord}`);
                }
            }
        }
    }
    
    // Estratégia 7: Extração de qualquer par palavra-valor
    if (Object.keys(data).length === 0) {
        console.log('🌟 Tentando extração universal...');
        
        // Padrão muito amplo para capturar qualquer coisa que pareça um par
        const universalPattern = /([a-zA-Z]+)[:\s=]+([a-zA-Z0-9@._\-\s]+?)(?=[a-zA-Z]+[:\s=]|$)/g;
        
        let match;
        while ((match = universalPattern.exec(workingText)) !== null) {
            const key = match[1].toLowerCase().trim();
            let value = match[2].trim();
            
            // Remove caracteres extras no final
            value = value.replace(/[,;.!?]+$/, '').trim();
            
            if (key.length > 1 && value.length > 0 && !data[key]) {
                data[key] = value;
                console.log(`Extração universal: ${key} = ${value}`);
            }
        }
    }
    
    // Estratégia 8: Se ainda não conseguiu nada, cria um objeto com o texto
    if (Object.keys(data).length === 0) {
        console.log('📝 Criando objeto com texto completo...');
        
        // Tenta identificar se é uma lista de itens
        const lines = workingText.split(/[\n,;]/);
        if (lines.length > 1) {
            data.items = lines.map(line => line.trim()).filter(line => line.length > 0);
        } else {
            // Se é um texto único, coloca como conteúdo
            data.conteudo = workingText.trim();
        }
    }
    
    console.log('Dados finais extraídos:', data);
    return Object.keys(data).length > 0 ? data : null;
}

function basicFix(input) {
    console.log('🔧 Aplicando correção ultra avançada...');
    console.log('Input original:', input);
    
    let fixed = input;
    
    // Remove comentários
    fixed = fixed.replace(/\/\*[\s\S]*?\*\//g, '');
    fixed = fixed.replace(/\/\/.*$/gm, '');
    
    // Normaliza espaços múltiplos mas preserva estrutura
    fixed = fixed.replace(/\s+/g, ' ').trim();
    
    // Correção específica para aspas malformadas e caracteres especiais
    fixed = fixed.replace(/\\"/g, '"');
    fixed = fixed.replace(/\\"([^"]*)/g, '$1');
    fixed = fixed.replace(/"([^"]*)\\"([^"]*)"([^"]*)/g, '"$1$2$3"');
    fixed = fixed.replace(/\\([^"\\])/g, '$1');
    
    // Corrige aspas duplas consecutivas malformadas como ""São Paulo"
    fixed = fixed.replace(/""([^"]+)"/g, '"$1"');
    fixed = fixed.replace(/"([^"]+)""/g, '"$1"');
    
    // Corrige aspas simples para duplas
    fixed = fixed.replace(/'/g, '"');
    
    // Adiciona chaves se necessário
    if (!fixed.startsWith('{') && !fixed.startsWith('[') && (fixed.includes(':') || fixed.includes('='))) {
        fixed = '{' + fixed + '}';
    }
    
    // Correção específica para objetos aninhados malformados
    // Identifica padrões como: endereço: {rua: "valor", numero 1000, ...}
    fixed = fixed.replace(/([a-zA-Z_$][a-zA-Z0-9_$]*)\s*:\s*\{([^}]*)\}/g, function(match, key, content) {
        console.log(`Processando objeto aninhado: ${key} = {${content}}`);
        
        // Corrige o conteúdo do objeto aninhado
        let fixedContent = content;
        
        // Adiciona aspas em chaves sem aspas
        fixedContent = fixedContent.replace(/([a-zA-Z_$][a-zA-Z0-9_$]*)\s*:/g, '"$1":');
        
        // Adiciona aspas em valores string sem aspas
        fixedContent = fixedContent.replace(/:(\s*)([a-zA-Z][a-zA-Z0-9\s\-\.]*[a-zA-Z0-9])(\s*[,}])/g, function(match, space1, value, space2) {
            if (value.match(/^(true|false|null|\d+)$/)) {
                return ':' + space1 + value + space2;
            }
            return ':' + space1 + '"' + value + '"' + space2;
        });
        
        // Corrige valores numéricos sem vírgula
        fixedContent = fixedContent.replace(/([a-zA-Z_$][a-zA-Z0-9_$]*)\s+(\d+)/g, '"$1": $2,');
        
        // Remove vírgulas extras
        fixedContent = fixedContent.replace(/,(\s*[}])/g, '$1');
        fixedContent = fixedContent.replace(/,\s*,/g, ',');
        
        return `"${key}": {${fixedContent}}`;
    });
    
    // Correções específicas para arrays extremamente malformados
    fixed = fixed.replace(/\[([^\]]*)\]/g, function(match, content) {
        console.log('Processando array malformado:', content);
        
        if (content.includes(':')) {
            // Array com propriedades malformadas como: ["música", "filmes", livros: "ficção científica", "fantasia"]
            let items = [];
            let currentItem = '';
            let inQuotes = false;
            let depth = 0;
            
            for (let i = 0; i < content.length; i++) {
                const char = content[i];
                
                if (char === '"' && content[i-1] !== '\\') {
                    inQuotes = !inQuotes;
                    currentItem += char;
                } else if (char === '{' && !inQuotes) {
                    depth++;
                    currentItem += char;
                } else if (char === '}' && !inQuotes) {
                    depth--;
                    currentItem += char;
                } else if (char === ',' && !inQuotes && depth === 0) {
                    if (currentItem.trim()) {
                        items.push(currentItem.trim());
                    }
                    currentItem = '';
                } else {
                    currentItem += char;
                }
            }
            
            // Adiciona o último item
            if (currentItem.trim()) {
                items.push(currentItem.trim());
            }
            
            let validItems = [];
            
            for (let item of items) {
                if (item.includes(':')) {
                    // Item com propriedade malformada como: livros: "ficção científica"
                    let parts = item.split(':');
                    if (parts.length >= 2) {
                        let key = parts[0].trim().replace(/^["']|["']$/g, '');
                        let value = parts.slice(1).join(':').trim().replace(/^["']|["']$/g, '');
                        
                        // Adiciona a chave como string
                        if (key) validItems.push(`"${key}"`);
                        
                        // Adiciona o valor apropriadamente
                        if (value && value !== 'true' && value !== 'false' && value !== 'null' && !value.match(/^\d+$/)) {
                            validItems.push(`"${value}"`);
                        } else if (value) {
                            validItems.push(value);
                        }
                    }
                } else {
                    // Item normal do array
                    item = item.replace(/^["']|["']$/g, '');
                    if (item && item !== 'true' && item !== 'false' && item !== 'null' && !item.match(/^\d+$/)) {
                        validItems.push(`"${item}"`);
                    } else if (item) {
                        validItems.push(item);
                    }
                }
            }
            
            return '[' + validItems.join(', ') + ']';
        }
        
        // Array normal, apenas normaliza
        let items = content.split(',').map(item => {
            item = item.trim();
            if (item && !item.startsWith('"') && !item.match(/^(true|false|null|\d+)$/)) {
                return `"${item}"`;
            }
            return item;
        }).filter(item => item.length > 0);
        
        return '[' + items.join(', ') + ']';
    });
    
    // Correções específicas para propriedades problemáticas
    // endereco: true: "valor" -> "endereco": "valor"
    fixed = fixed.replace(/([a-zA-Z_$][a-zA-Z0-9_$]*)\s*:\s*(true|false)\s*:\s*"([^"]*)"/g, '"$1": "$3"');
    
    // Corrige múltiplos dois pontos consecutivos
    fixed = fixed.replace(/:\s*:\s*/g, ': ');
    
    // Corrige aspas malformadas específicas
    fixed = fixed.replace(/([a-zA-Z0-9]+)"\s*([a-zA-Z0-9\s]+)"/g, '"$1 $2"');
    
    // Adiciona aspas em chaves sem aspas (mais robusto)
    fixed = fixed.replace(/([{,]\s*)([a-zA-Z_$][a-zA-Z0-9_$]*)\s*:/g, '$1"$2":');
    
    // Correção específica para propriedades sem dois pontos como: nome João idade:25
    fixed = fixed.replace(/([a-zA-Z_$][a-zA-Z0-9_$]*)\s+([a-zA-Z][a-zA-Z0-9\s]*[a-zA-Z0-9])\s+([a-zA-Z_$][a-zA-Z0-9_$]*)\s*:/g, '"$1": "$2", "$3":');
    
    // Adiciona aspas em valores string sem aspas (mais específico e robusto)
    fixed = fixed.replace(/:(\s*)([a-zA-Z][a-zA-Z0-9\s\-\.@]*[a-zA-Z0-9])(\s*[,}])/g, function(match, space1, value, space2) {
        // Não adiciona aspas se já é um valor válido
        if (value.match(/^(true|false|null|\d+)$/)) {
            return ':' + space1 + value + space2;
        }
        // Remove aspas extras se existirem
        value = value.replace(/^["']|["']$/g, '');
        return ':' + space1 + '"' + value + '"' + space2;
    });
    
    // Corrige valores sem aspas no final de objetos
    fixed = fixed.replace(/:(\s*)([a-zA-Z][a-zA-Z0-9\s\-\.@]*[a-zA-Z0-9])(\s*})$/g, function(match, space1, value, space2) {
        if (value.match(/^(true|false|null|\d+)$/)) {
            return ':' + space1 + value + space2;
        }
        value = value.replace(/^["']|["']$/g, '');
        return ':' + space1 + '"' + value + '"' + space2;
    });
    
    // Corrige números com espaços
    fixed = fixed.replace(/:\s*(\d+)\s*([,}])/g, ':$1$2');
    
    // Remove vírgulas extras
    fixed = fixed.replace(/,(\s*[}\]])/g, '$1');
    fixed = fixed.replace(/,\s*,/g, ',');
    
    // Adiciona vírgulas ausentes entre propriedades
    fixed = fixed.replace(/([}\]"])\s*(["{])/g, '$1,$2');
    fixed = fixed.replace(/([0-9])\s*(["{])/g, '$1,$2');
    fixed = fixed.replace(/(true|false|null)\s*(["{])/g, '$1,$2');
    
    // Corrige undefined para null
    fixed = fixed.replace(/\bundefined\b/g, 'null');
    
    // Correção para valores que começam com números mas têm texto
    fixed = fixed.replace(/:\s*(\d+)([a-zA-Z\-]+)/g, ':"$1$2"');
    
    // Correção para CEPs e telefones malformados
    fixed = fixed.replace(/:\s*(\d{5}-\d{3})/g, ':"$1"');
    fixed = fixed.replace(/:\s*(\(\d+\)\s*\d+[\d\s\-]*)/g, ':"$1"');
    
    // Correção específica para CEPs sem aspas como: 12345-678
    fixed = fixed.replace(/:\s*(\d+\-\d+)/g, ':"$1"');
    
    // Correção final: remove chaves/colchetes extras no final
    fixed = fixed.replace(/\}\s*\}\s*$/, '}');
    fixed = fixed.replace(/\]\s*\]\s*$/, ']');
    
    // Correção para propriedades que ficaram sem valor
    fixed = fixed.replace(/:\s*,/g, ': null,');
    fixed = fixed.replace(/:\s*}/g, ': null}');
    
    // Correção específica para vírgulas extras antes de fechar chaves
    fixed = fixed.replace(/,(\s*})/g, '$1');
    
    // Última verificação: se ainda tem problemas, tenta uma abordagem mais agressiva
    if (!fixed.match(/^\s*[\[{]/)) {
        console.log('🚨 Aplicando correção de emergência...');
        
        // Se não parece JSON, tenta extrair pares chave-valor básicos
        const emergencyData = {};
        const pairs = fixed.split(/[,;\n]/);
        
        pairs.forEach(pair => {
            if (pair.includes(':')) {
                const [key, ...valueParts] = pair.split(':');
                const cleanKey = key.trim().replace(/[^a-zA-Z0-9_]/g, '');
                const cleanValue = valueParts.join(':').trim().replace(/[^a-zA-Z0-9\s\-@.]/g, ' ').trim();
                
                if (cleanKey && cleanValue) {
                    emergencyData[cleanKey] = cleanValue;
                }
            }
        });
        
        if (Object.keys(emergencyData).length > 0) {
            fixed = JSON.stringify(emergencyData);
        }
    }
    
    console.log('Resultado da correção ultra avançada:', fixed);
    return fixed;
}

function correctJSON() {
    console.log('🔧 Corrigindo JSON...');
    
    const inputElement = document.getElementById('input');
    const input = inputElement.value.trim();
    
    if (!input) {
        showStatus('Por favor, insira algum conteúdo para corrigir', 'warning');
        return;
    }
    
    try {
        const corrected = basicFix(input);
        const parsed = JSON.parse(corrected);
        const formatted = JSON.stringify(parsed, null, 4);
        
        inputElement.value = corrected;
        document.getElementById('output').innerHTML = colorizeJSON(formatted);
        showStatus('JSON corrigido com sucesso!', 'success');
        inputElement.classList.add('valid');
        inputElement.classList.remove('invalid');
        
    } catch (error) {
        console.error('❌ Erro na correção:', error);
        showStatus('Não foi possível corrigir o conteúdo fornecido', 'error');
        inputElement.classList.add('invalid');
        inputElement.classList.remove('valid');
    }
}

function copyOutput() {
    console.log('📋 Copiando resultado...');
    
    const output = document.getElementById('output');
    const text = output.textContent;
    
    if (!text || !text.trim()) {
        showStatus('Nenhum conteúdo para copiar', 'warning');
        return;
    }
    
    navigator.clipboard.writeText(text).then(() => {
        showStatus('Copiado para a área de transferência!', 'success');
    }).catch(() => {
        showStatus('Erro ao copiar conteúdo', 'error');
    });
}

function clearInput() {
    console.log('🧹 Limpando campos...');
    
    document.getElementById('input').value = '';
    document.getElementById('output').innerHTML = '';
    document.getElementById('input').classList.remove('valid', 'invalid');
    showStatus('Campos limpos com sucesso', 'success');
}

function loadTestExample() {
    console.log('🧪 Carregando exemplo de teste...');
    
    const examples = [
        // JSON válido
        '{"nome": "João", "idade": 30, "ativo": true}',
        
        // JSON malformado básico
        'nome: João, idade: 25, cidade: "São Paulo"',
        
        // JSON com aspas malformadas
        '{"endereco":"rua \\"Rua das Flores","numero":"200","cidade":"Belo Horizonte"}',
        
        // JSON sem aspas
        '{nome: "Maria", hobbies: ["leitura", "cinema"]}',
        
        // Texto simples com dados
        'nome João idade 25 cidade São Paulo telefone 11999887766',
        
        // Lista de dados
        'produto: notebook, preco: 2500, categoria: eletrônicos, disponivel: sim',
        
        // Dados de usuário
        'usuario admin senha 123456 email admin@teste.com ativo true',
        
        // Endereço completo
        'endereco Rua das Flores 123 bairro Centro cidade São Paulo estado SP cep 01234-567',
        
        // Dados misturados
        'cliente: Maria Silva, telefone: (11) 98765-4321, email: maria@email.com, idade: 35, casada: sim',
        
        // Texto completamente não estruturado
        'O usuário João tem 30 anos e mora em São Paulo. Seu email é joao@teste.com e telefone 11987654321.',
        
        // JSON extremamente malformado (exemplo do usuário)
        '{nome: João idade:25 "cidade""São Paulo", "interesses": ["música", "filmes", livros: "ficção científica", "fantasia"], endereço: {rua: "Av. Brasil", numero 1000, bairro: "Centro" estado: "SP" "cep": 12345-678,} }'
    ];
    
    const randomExample = examples[Math.floor(Math.random() * examples.length)];
    document.getElementById('input').value = randomExample;
    document.getElementById('input').classList.remove('valid', 'invalid');
    
    showStatus('Exemplo carregado - clique em "Formatar" para processar', 'info');
}

function colorizeJSON(json) {
    return json.replace(/&/g, '&amp;')
               .replace(/</g, '&lt;')
               .replace(/>/g, '&gt;')
               .replace(/"([^"]+)":/g, '<span class="json-key">"$1"</span>:')
               .replace(/"([^"]*)"(?=\s*[,\]\}])/g, '<span class="json-string">"$1"</span>')
               .replace(/\b(true|false)\b/g, '<span class="json-boolean">$1</span>')
               .replace(/\b(null)\b/g, '<span class="json-null">$1</span>')
               .replace(/\b(-?\d+\.?\d*)\b/g, '<span class="json-number">$1</span>');
}

function showStatus(message, type = 'success') {
    const status = document.getElementById('status');
    status.innerHTML = message;
    status.classList.remove('hidden', 'status-success', 'status-error', 'status-warning', 'status-info');
    status.classList.add('status-message', 'status-' + type);
    
    setTimeout(() => {
        status.classList.add('hidden');
    }, 3000);
}
</script>
@endsection 