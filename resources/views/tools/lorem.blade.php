@extends('layouts.modern')

@section('title', 'Gerador Lorem Ipsum - Webeetools')

@section('styles')
<style>
/* Lorem Ipsum Generator Styles */
.lorem-container {
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

.lorem-section {
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

/* Configurações */
.settings-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.setting-group {
    display: flex;
    flex-direction: column;
}

.setting-label {
    color: #cbd5e1;
    font-weight: 500;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.setting-input, .setting-select {
    background: rgba(30, 41, 59, 0.5);
    border: 1px solid rgba(71, 85, 105, 0.5);
    border-radius: 0.75rem;
    padding: 0.75rem;
    color: white;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.setting-input:focus, .setting-select:focus {
    outline: none;
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    background: rgba(30, 41, 59, 0.7);
}

.setting-select option {
    background: #1e293b;
    color: white;
}

/* Checkbox personalizado */
.checkbox-group {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-top: 0.5rem;
}

.custom-checkbox {
    position: relative;
    display: inline-block;
    width: 20px;
    height: 20px;
}

.custom-checkbox input {
    opacity: 0;
    width: 0;
    height: 0;
}

.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 20px;
    width: 20px;
    background: rgba(30, 41, 59, 0.5);
    border: 1px solid rgba(71, 85, 105, 0.5);
    border-radius: 4px;
    transition: all 0.3s ease;
}

.custom-checkbox:hover input ~ .checkmark {
    border-color: #6366f1;
}

.custom-checkbox input:checked ~ .checkmark {
    background: #6366f1;
    border-color: #6366f1;
}

.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

.custom-checkbox input:checked ~ .checkmark:after {
    display: block;
}

.custom-checkbox .checkmark:after {
    left: 6px;
    top: 2px;
    width: 6px;
    height: 10px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}

.checkbox-label {
    color: #cbd5e1;
    font-size: 0.9rem;
    cursor: pointer;
}

/* Botões de ação */
.action-buttons {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    justify-content: center;
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
    min-width: 140px;
    justify-content: center;
}

.btn-primary {
    background: linear-gradient(135deg, #6366f1, #4f46e5);
    color: white;
    box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
}

.btn-secondary {
    background: rgba(30, 41, 59, 0.5);
    color: #f1f5f9;
    border: 1px solid rgba(71, 85, 105, 0.5);
}

.btn-secondary:hover {
    background: rgba(51, 65, 85, 0.6);
    border-color: rgba(99, 102, 241, 0.5);
    transform: translateY(-2px);
}

/* Área de resultado */
.result-area {
    background: rgba(15, 23, 42, 0.3);
    border: 1px solid rgba(71, 85, 105, 0.3);
    border-radius: 1rem;
    padding: 2rem;
    min-height: 300px;
    position: relative;
}

.result-text {
    color: #e2e8f0;
    line-height: 1.8;
    font-size: 1.1rem;
    white-space: pre-wrap;
    word-wrap: break-word;
    font-family: 'Inter', sans-serif;
}

.result-placeholder {
    color: #6b7280;
    font-style: italic;
    text-align: center;
    padding: 4rem 2rem;
    font-size: 1.1rem;
}

.copy-button {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: rgba(99, 102, 241, 0.2);
    border: 1px solid rgba(99, 102, 241, 0.3);
    border-radius: 0.5rem;
    color: #6366f1;
    padding: 0.5rem;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
}

.copy-button:hover {
    background: rgba(99, 102, 241, 0.3);
    border-color: rgba(99, 102, 241, 0.5);
    transform: scale(1.05);
}

.copy-button.copied {
    background: rgba(16, 185, 129, 0.2);
    border-color: rgba(16, 185, 129, 0.3);
    color: #10b981;
}

/* Estatísticas */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 1rem;
    margin-top: 1.5rem;
}

.stat-item {
    text-align: center;
    padding: 1rem;
    background: rgba(15, 23, 42, 0.3);
    border-radius: 0.75rem;
    border: 1px solid rgba(71, 85, 105, 0.3);
}

.stat-number {
    font-size: 1.5rem;
    font-weight: 700;
    color: #6366f1;
    margin-bottom: 0.25rem;
    font-family: 'JetBrains Mono', monospace;
}

.stat-label {
    color: #9ca3af;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* Responsivo */
@media (max-width: 768px) {
    .lorem-container {
        padding: 1rem;
    }
    
    .page-title h1 {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .settings-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .action-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .btn {
        width: 100%;
        max-width: 250px;
    }
    
    .result-area {
        padding: 1.5rem;
    }
    
    .copy-button {
        position: static;
        margin: 1rem auto 0;
        width: auto;
        padding: 0.75rem 1.5rem;
    }
}
</style>
@endsection

@section('content')
<div class="tool-container">
    <!-- Page Title -->
    <div class="page-title">
        <h1>
            <i class="fas fa-paragraph" style="color: #6366f1;"></i>
            Gerador Lorem Ipsum
        </h1>
        <p>
            Gere texto placeholder personalizado para seus projetos. Configure quantidade, tipo e formato do texto.
        </p>
    </div>

    <div class="lorem-container">
        <!-- Configurações -->
        <div class="lorem-section">
            <h3 class="section-title">
                <i class="fas fa-cog" style="color: #6366f1;"></i>
                Configurações
            </h3>
            
            <div class="settings-grid">
                <div class="setting-group">
                    <label class="setting-label">Tipo de Texto</label>
                    <select class="setting-select" id="textType">
                        <option value="lorem">Lorem Ipsum Clássico</option>
                        <option value="cicero">Cícero (Original)</option>
                        <option value="random">Palavras Aleatórias</option>
                        <option value="business">Texto Corporativo</option>
                        <option value="tech">Texto Tecnológico</option>
                    </select>
                </div>
                
                <div class="setting-group">
                    <label class="setting-label">Unidade</label>
                    <select class="setting-select" id="unit">
                        <option value="paragraphs">Parágrafos</option>
                        <option value="sentences">Frases</option>
                        <option value="words">Palavras</option>
                        <option value="characters">Caracteres</option>
                    </select>
                </div>
                
                <div class="setting-group">
                    <label class="setting-label">Quantidade</label>
                    <input type="number" class="setting-input" id="amount" value="3" min="1" max="100">
                </div>
                
                <div class="setting-group">
                    <label class="setting-label">Opções</label>
                    <div class="checkbox-group">
                        <label class="custom-checkbox">
                            <input type="checkbox" id="startWithLorem" checked>
                            <span class="checkmark"></span>
                        </label>
                        <label class="checkbox-label" for="startWithLorem">Começar com "Lorem ipsum"</label>
                    </div>
                    <div class="checkbox-group">
                        <label class="custom-checkbox">
                            <input type="checkbox" id="addLineBreaks" checked>
                            <span class="checkmark"></span>
                        </label>
                        <label class="checkbox-label" for="addLineBreaks">Quebras de linha</label>
                    </div>
                </div>
            </div>
            
            <div class="action-buttons">
                <button class="btn btn-primary" id="generateBtn">
                    <i class="fas fa-magic"></i>
                    Gerar Texto
                </button>
                <button class="btn btn-secondary" id="clearBtn">
                    <i class="fas fa-trash"></i>
                    Limpar
                </button>
            </div>
        </div>

        <!-- Resultado -->
        <div class="lorem-section">
            <h3 class="section-title">
                <i class="fas fa-file-text" style="color: #6366f1;"></i>
                Texto Gerado
            </h3>
            
            <div class="result-area">
                <button class="copy-button" id="copyBtn" title="Copiar texto">
                    <i class="fas fa-copy"></i>
                </button>
                <div class="result-text" id="resultText">
                    <div class="result-placeholder">
                        Clique em "Gerar Texto" para criar seu Lorem Ipsum personalizado
                    </div>
                </div>
            </div>
            
            <!-- Estatísticas -->
            <div class="stats-grid" id="statsGrid" style="display: none;">
                <div class="stat-item">
                    <div class="stat-number" id="charCount">0</div>
                    <div class="stat-label">Caracteres</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" id="wordCount">0</div>
                    <div class="stat-label">Palavras</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" id="sentenceCount">0</div>
                    <div class="stat-label">Frases</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" id="paragraphCount">0</div>
                    <div class="stat-label">Parágrafos</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// ===== LOREM IPSUM GENERATOR =====
class LoremGenerator {
    constructor() {
        // Textos base
        this.texts = {
            lorem: [
                'Lorem', 'ipsum', 'dolor', 'sit', 'amet', 'consectetur', 'adipiscing', 'elit',
                'sed', 'do', 'eiusmod', 'tempor', 'incididunt', 'ut', 'labore', 'et', 'dolore',
                'magna', 'aliqua', 'Ut', 'enim', 'ad', 'minim', 'veniam', 'quis', 'nostrud',
                'exercitation', 'ullamco', 'laboris', 'nisi', 'aliquip', 'ex', 'ea', 'commodo',
                'consequat', 'Duis', 'aute', 'irure', 'in', 'reprehenderit', 'voluptate',
                'velit', 'esse', 'cillum', 'fugiat', 'nulla', 'pariatur', 'Excepteur', 'sint',
                'occaecat', 'cupidatat', 'non', 'proident', 'sunt', 'culpa', 'qui', 'officia',
                'deserunt', 'mollit', 'anim', 'id', 'est', 'laborum'
            ],
            cicero: [
                'Sed', 'ut', 'perspiciatis', 'unde', 'omnis', 'iste', 'natus', 'error',
                'sit', 'voluptatem', 'accusantium', 'doloremque', 'laudantium', 'totam',
                'rem', 'aperiam', 'eaque', 'ipsa', 'quae', 'ab', 'illo', 'inventore',
                'veritatis', 'et', 'quasi', 'architecto', 'beatae', 'vitae', 'dicta',
                'sunt', 'explicabo', 'Nemo', 'enim', 'ipsam', 'voluptatem', 'quia',
                'voluptas', 'aspernatur', 'aut', 'odit', 'fugit', 'sed', 'consequuntur',
                'magni', 'dolores', 'eos', 'qui', 'ratione', 'sequi', 'nesciunt'
            ],
            random: [
                'the', 'quick', 'brown', 'fox', 'jumps', 'over', 'lazy', 'dog',
                'pack', 'my', 'box', 'with', 'five', 'dozen', 'liquor', 'jugs',
                'how', 'vexingly', 'quick', 'daft', 'zebras', 'jump', 'amazingly',
                'few', 'quips', 'galvanized', 'jockey', 'sphinx', 'of', 'black',
                'quartz', 'judge', 'vow', 'bright', 'jinx', 'waltz', 'nymph'
            ],
            business: [
                'synergy', 'leverage', 'paradigm', 'innovative', 'solution', 'strategic',
                'optimization', 'efficiency', 'scalable', 'robust', 'enterprise',
                'methodology', 'framework', 'implementation', 'integration', 'workflow',
                'analytics', 'metrics', 'performance', 'deliverable', 'stakeholder',
                'engagement', 'collaboration', 'transformation', 'agile', 'dynamic'
            ],
            tech: [
                'algorithm', 'database', 'framework', 'API', 'interface', 'protocol',
                'architecture', 'deployment', 'scalability', 'optimization', 'debugging',
                'refactoring', 'repository', 'version', 'control', 'authentication',
                'encryption', 'middleware', 'microservice', 'container', 'orchestration',
                'pipeline', 'automation', 'monitoring', 'logging', 'performance'
            ]
        };
        
        // Elementos DOM
        this.elements = {};
        
        // Inicializar
        this.init();
    }
    
    init() {
        console.log('🚀 Inicializando Lorem Generator...');
        
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.setupDOM());
        } else {
            this.setupDOM();
        }
    }
    
    setupDOM() {
        console.log('📋 Configurando elementos DOM...');
        
        this.elements = {
            textType: document.getElementById('textType'),
            unit: document.getElementById('unit'),
            amount: document.getElementById('amount'),
            startWithLorem: document.getElementById('startWithLorem'),
            addLineBreaks: document.getElementById('addLineBreaks'),
            generateBtn: document.getElementById('generateBtn'),
            clearBtn: document.getElementById('clearBtn'),
            copyBtn: document.getElementById('copyBtn'),
            resultText: document.getElementById('resultText'),
            statsGrid: document.getElementById('statsGrid'),
            charCount: document.getElementById('charCount'),
            wordCount: document.getElementById('wordCount'),
            sentenceCount: document.getElementById('sentenceCount'),
            paragraphCount: document.getElementById('paragraphCount')
        };
        
        this.setupEvents();
        console.log('✅ Lorem Generator inicializado!');
    }
    
    setupEvents() {
        this.elements.generateBtn.addEventListener('click', () => this.generate());
        this.elements.clearBtn.addEventListener('click', () => this.clear());
        this.elements.copyBtn.addEventListener('click', () => this.copy());
        
        // Gerar automaticamente quando mudar configurações
        ['textType', 'unit', 'amount'].forEach(id => {
            this.elements[id].addEventListener('change', () => {
                if (this.elements.resultText.textContent.trim() && 
                    !this.elements.resultText.querySelector('.result-placeholder')) {
                    this.generate();
                }
            });
        });
    }
    
    generate() {
        const config = this.getConfig();
        let result = '';
        
        switch (config.unit) {
            case 'paragraphs':
                result = this.generateParagraphs(config);
                break;
            case 'sentences':
                result = this.generateSentences(config);
                break;
            case 'words':
                result = this.generateWords(config);
                break;
            case 'characters':
                result = this.generateCharacters(config);
                break;
        }
        
        this.displayResult(result);
        this.updateStats(result);
    }
    
    getConfig() {
        return {
            textType: this.elements.textType.value,
            unit: this.elements.unit.value,
            amount: parseInt(this.elements.amount.value) || 1,
            startWithLorem: this.elements.startWithLorem.checked,
            addLineBreaks: this.elements.addLineBreaks.checked
        };
    }
    
    generateParagraphs(config) {
        const paragraphs = [];
        
        for (let i = 0; i < config.amount; i++) {
            const sentenceCount = Math.floor(Math.random() * 5) + 3; // 3-7 frases
            const sentences = [];
            
            for (let j = 0; j < sentenceCount; j++) {
                const isFirst = i === 0 && j === 0 && config.startWithLorem && config.textType === 'lorem';
                sentences.push(this.generateSentence(config.textType, isFirst));
            }
            
            paragraphs.push(sentences.join(' '));
        }
        
        return config.addLineBreaks ? paragraphs.join('\n\n') : paragraphs.join(' ');
    }
    
    generateSentences(config) {
        const sentences = [];
        
        for (let i = 0; i < config.amount; i++) {
            const isFirst = i === 0 && config.startWithLorem && config.textType === 'lorem';
            sentences.push(this.generateSentence(config.textType, isFirst));
        }
        
        return config.addLineBreaks ? sentences.join('\n') : sentences.join(' ');
    }
    
    generateWords(config) {
        const words = [];
        const wordList = this.texts[config.textType];
        
        if (config.startWithLorem && config.textType === 'lorem') {
            words.push('Lorem', 'ipsum');
        }
        
        while (words.length < config.amount) {
            const word = wordList[Math.floor(Math.random() * wordList.length)];
            words.push(word);
        }
        
        return words.slice(0, config.amount).join(' ');
    }
    
    generateCharacters(config) {
        let text = this.generateWords({ ...config, amount: Math.ceil(config.amount / 5) });
        return text.substring(0, config.amount);
    }
    
    generateSentence(textType, startWithLorem = false) {
        const wordList = this.texts[textType];
        const wordCount = Math.floor(Math.random() * 10) + 5; // 5-14 palavras
        const words = [];
        
        if (startWithLorem && textType === 'lorem') {
            words.push('Lorem', 'ipsum', 'dolor', 'sit', 'amet');
        }
        
        while (words.length < wordCount) {
            const word = wordList[Math.floor(Math.random() * wordList.length)];
            words.push(word);
        }
        
        // Capitalizar primeira palavra
        if (words.length > 0) {
            words[0] = words[0].charAt(0).toUpperCase() + words[0].slice(1);
        }
        
        return words.join(' ') + '.';
    }
    
    displayResult(text) {
        this.elements.resultText.innerHTML = `<div class="result-text">${text}</div>`;
        this.elements.statsGrid.style.display = 'grid';
    }
    
    updateStats(text) {
        const chars = text.length;
        const words = text.trim().split(/\s+/).length;
        const sentences = (text.match(/[.!?]+/g) || []).length;
        const paragraphs = text.split(/\n\s*\n/).length;
        
        this.elements.charCount.textContent = chars.toLocaleString();
        this.elements.wordCount.textContent = words.toLocaleString();
        this.elements.sentenceCount.textContent = sentences.toLocaleString();
        this.elements.paragraphCount.textContent = paragraphs.toLocaleString();
    }
    
    clear() {
        this.elements.resultText.innerHTML = `
            <div class="result-placeholder">
                Clique em "Gerar Texto" para criar seu Lorem Ipsum personalizado
            </div>
        `;
        this.elements.statsGrid.style.display = 'none';
    }
    
    copy() {
        const textElement = this.elements.resultText.querySelector('.result-text');
        if (!textElement) return;
        
        const text = textElement.textContent;
        
        navigator.clipboard.writeText(text).then(() => {
            // Feedback visual
            const icon = this.elements.copyBtn.querySelector('i');
            const originalClass = icon.className;
            
            this.elements.copyBtn.classList.add('copied');
            icon.className = 'fas fa-check';
            
            setTimeout(() => {
                this.elements.copyBtn.classList.remove('copied');
                icon.className = originalClass;
            }, 2000);
        }).catch(err => {
            console.error('Erro ao copiar:', err);
        });
    }
}

// Inicializar
const loremGenerator = new LoremGenerator();
</script>
@endsection 