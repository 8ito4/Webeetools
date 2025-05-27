@extends('layouts.modern')

@section('title', 'Pomodoro Timer - Webeetools')

@section('styles')
<style>
/* Reset e base */
* {
    box-sizing: border-box;
}

/* Container principal */
.timer-container {
    max-width: 900px;
    margin: 0 auto;
    padding: 2rem;
}

/* Título da página */
.page-title {
    text-align: center;
    margin-bottom: 2rem;
}

.page-title h1 {
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 700;
    color: white;
    margin-bottom: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
}

.page-title p {
    font-size: 1.1rem;
    color: #9ca3af;
    max-width: 550px;
    margin: 0 auto;
    line-height: 1.5;
}

/* Seções */
.timer-section {
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
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

/* Configurações */
.settings-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 2rem;
    max-width: 500px;
    margin: 0 auto;
}

.setting-item {
    text-align: center;
}

.setting-label {
    color: #cbd5e1;
    font-weight: 500;
    margin-bottom: 0.75rem;
    display: block;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.setting-input {
    background: rgba(30, 41, 59, 0.5);
    border: 1px solid rgba(71, 85, 105, 0.5);
    border-radius: 0.75rem;
    padding: 1rem;
    color: white;
    text-align: center;
    font-size: 1.25rem;
    font-weight: 600;
    width: 100%;
    transition: all 0.3s ease;
}

.setting-input:focus {
    outline: none;
    border-color: #eab308;
    box-shadow: 0 0 0 3px rgba(234, 179, 8, 0.1);
    background: rgba(30, 41, 59, 0.7);
}

/* Timer display */
.timer-display {
    text-align: center;
    position: relative;
}

.timer-mode {
    font-size: 1.5rem;
    font-weight: 600;
    color: #eab308;
    margin-bottom: 2rem;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.timer-circle {
    width: 280px;
    height: 280px;
    margin: 0 auto 2rem;
    position: relative;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(30, 41, 59, 0.8), rgba(15, 23, 42, 0.9));
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 
        0 20px 40px rgba(0, 0, 0, 0.3),
        inset 0 2px 0 rgba(255, 255, 255, 0.1);
}

.timer-progress {
    position: absolute;
    top: -8px;
    left: -8px;
    width: 296px;
    height: 296px;
    border-radius: 50%;
    background: conic-gradient(
        #eab308 0deg,
        #eab308 0deg,
        rgba(71, 85, 105, 0.3) 0deg
    );
    transition: all 0.5s ease;
}

.timer-time {
    font-size: 3.5rem;
    font-weight: 700;
    color: white;
    font-family: 'JetBrains Mono', monospace;
    text-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    z-index: 2;
    position: relative;
}

/* Controles */
.timer-controls {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.timer-btn {
    padding: 1rem 2rem;
    border: none;
    border-radius: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1rem;
    min-width: 140px;
    justify-content: center;
}

.timer-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.btn-primary {
    background: linear-gradient(135deg, #eab308, #ca8a04);
    color: #0f172a;
    box-shadow: 0 4px 15px rgba(234, 179, 8, 0.3);
}

.btn-primary:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(234, 179, 8, 0.4);
}

.btn-secondary {
    background: rgba(30, 41, 59, 0.5);
    color: #f1f5f9;
    border: 1px solid rgba(71, 85, 105, 0.5);
}

.btn-secondary:hover:not(:disabled) {
    background: rgba(51, 65, 85, 0.6);
    border-color: rgba(234, 179, 8, 0.5);
    transform: translateY(-2px);
}

/* Estatísticas */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1.5rem;
}

.stat-item {
    text-align: center;
    padding: 1rem;
    background: rgba(15, 23, 42, 0.3);
    border-radius: 1rem;
    border: 1px solid rgba(71, 85, 105, 0.3);
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    color: #eab308;
    margin-bottom: 0.5rem;
    font-family: 'JetBrains Mono', monospace;
}

.stat-label {
    color: #9ca3af;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* Responsivo */
@media (max-width: 768px) {
    .timer-container {
        padding: 1rem;
    }
    
    .page-title h1 {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .settings-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .timer-circle {
        width: 220px;
        height: 220px;
    }
    
    .timer-progress {
        width: 236px;
        height: 236px;
        top: -8px;
        left: -8px;
    }
    
    .timer-time {
        font-size: 2.5rem;
    }
    
    .timer-controls {
        flex-direction: column;
        align-items: center;
    }
    
    .timer-btn {
        width: 100%;
        max-width: 200px;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
}
</style>
@endsection

@section('content')
<div class="tool-container">
    <!-- Título da página -->
    <div class="page-title">
        <h1>
            <i class="fas fa-clock" style="color: #eab308;"></i>
            Pomodoro Timer
        </h1>
        <p>
            Aumente sua produtividade com a técnica Pomodoro. Trabalhe em blocos focados de tempo com pausas regulares.
        </p>
    </div>

    <div class="timer-container">
        <!-- Configurações -->
        <div class="timer-section">
            <h3 class="section-title">
                <i class="fas fa-cog" style="color: #eab308;"></i>
                Configurações
            </h3>
            <div class="settings-grid">
                <div class="setting-item">
                    <label class="setting-label">Tempo (min)</label>
                    <input type="number" class="setting-input" id="workTime" value="25" min="1" max="60">
                </div>
                <div class="setting-item">
                    <label class="setting-label">Pausa (min)</label>
                    <input type="number" class="setting-input" id="breakTime" value="5" min="1" max="30">
                </div>
            </div>
        </div>

        <!-- Timer -->
        <div class="timer-section">
            <div class="timer-display">
                <div class="timer-mode" id="timerMode">TEMPO</div>
                <div class="timer-circle">
                    <div class="timer-progress" id="timerProgress"></div>
                    <div class="timer-time" id="timerTime">25:00</div>
                </div>
                
                <div class="timer-controls">
                    <button class="timer-btn btn-primary" id="startBtn">
                        <i class="fas fa-play"></i>
                        Iniciar
                    </button>
                    <button class="timer-btn btn-secondary" id="pauseBtn" disabled>
                        <i class="fas fa-pause"></i>
                        Pausar
                    </button>
                    <button class="timer-btn btn-secondary" id="resetBtn">
                        <i class="fas fa-redo"></i>
                        Resetar
                    </button>
                </div>
            </div>
        </div>

        <!-- Estatísticas -->
        <div class="timer-section">
            <h3 class="section-title">
                <i class="fas fa-chart-bar" style="color: #eab308;"></i>
                Estatísticas da Sessão
            </h3>
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number" id="completedPomodoros">0</div>
                    <div class="stat-label">Pomodoros Completos</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" id="totalTime">0</div>
                    <div class="stat-label">Tempo Total (min)</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" id="currentStreak">0</div>
                    <div class="stat-label">Sequência Atual</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// ===== CLASSE POMODORO TIMER =====
class PomodoroTimer {
    constructor() {
        // Estado do timer
        this.isRunning = false;
        this.isPaused = false;
        this.currentMode = 'work'; // work, break
        this.timeLeft = 0;
        this.totalTime = 0;
        this.timerInterval = null;
        
        // Estatísticas
        this.completedPomodoros = 0;
        this.totalMinutes = 0;
        this.currentStreak = 0;
        
        // Configurações padrão
        this.settings = {
            work: 25,
            break: 5
        };
        
        // Elementos DOM
        this.elements = {};
        
        // Inicializar
        this.init();
    }
    
    // ===== INICIALIZAÇÃO =====
    init() {
        console.log('🚀 Inicializando Pomodoro Timer...');
        
        // Aguardar DOM carregar
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.setupDOM());
        } else {
            this.setupDOM();
        }
    }
    
    setupDOM() {
        console.log('📋 Configurando elementos DOM...');
        
        // Buscar elementos
        this.elements = {
            // Timer
            timerMode: document.getElementById('timerMode'),
            timerTime: document.getElementById('timerTime'),
            timerProgress: document.getElementById('timerProgress'),
            
            // Botões
            startBtn: document.getElementById('startBtn'),
            pauseBtn: document.getElementById('pauseBtn'),
            resetBtn: document.getElementById('resetBtn'),
            
            // Configurações
            workTime: document.getElementById('workTime'),
            breakTime: document.getElementById('breakTime'),
            
            // Estatísticas
            completedPomodoros: document.getElementById('completedPomodoros'),
            totalTime: document.getElementById('totalTime'),
            currentStreak: document.getElementById('currentStreak')
        };
        
        // Verificar se elementos existem
        const missingElements = Object.entries(this.elements)
            .filter(([key, element]) => !element)
            .map(([key]) => key);
            
        if (missingElements.length > 0) {
            console.error('❌ Elementos não encontrados:', missingElements);
            return;
        }
        
        console.log('✅ Todos os elementos encontrados!');
        
        // Configurar eventos
        this.setupEvents();
        
        // Configurar estado inicial
        this.loadSettings();
        this.updateDisplay();
        this.updateStats();
        
        console.log('🎉 Pomodoro Timer inicializado com sucesso!');
    }
    
    setupEvents() {
        console.log('🔗 Configurando eventos...');
        
        // Botões
        this.elements.startBtn.addEventListener('click', () => this.start());
        this.elements.pauseBtn.addEventListener('click', () => this.pause());
        this.elements.resetBtn.addEventListener('click', () => this.reset());
        
        // Configurações
        this.elements.workTime.addEventListener('change', () => this.loadSettings());
        this.elements.breakTime.addEventListener('change', () => this.loadSettings());
        
        console.log('✅ Eventos configurados!');
    }
    
    // ===== CONFIGURAÇÕES =====
    loadSettings() {
        console.log('⚙️ Carregando configurações...');
        
        this.settings.work = Math.max(1, Math.min(60, parseInt(this.elements.workTime.value) || 25));
        this.settings.break = Math.max(1, Math.min(30, parseInt(this.elements.breakTime.value) || 5));
        
        // Atualizar inputs com valores válidos
        this.elements.workTime.value = this.settings.work;
        this.elements.breakTime.value = this.settings.break;
        
        // Se não estiver rodando, atualizar tempo
        if (!this.isRunning) {
            this.setTime();
        }
        
        console.log('✅ Configurações carregadas:', this.settings);
    }
    
    setTime() {
        const minutes = this.settings[this.currentMode === 'work' ? 'work' : 'break'];
        this.timeLeft = minutes * 60;
        this.totalTime = this.timeLeft;
        this.updateDisplay();
    }
    
    // ===== CONTROLES DO TIMER =====
    start() {
        console.log('▶️ Iniciando timer...');
        
        if (this.timeLeft <= 0) {
            this.setTime();
        }
        
        this.isRunning = true;
        this.isPaused = false;
        
        // Atualizar botões
        this.elements.startBtn.disabled = true;
        this.elements.pauseBtn.disabled = false;
        
        // Iniciar contagem
        this.timerInterval = setInterval(() => {
            this.timeLeft--;
            this.updateDisplay();
            
            if (this.timeLeft <= 0) {
                this.complete();
            }
        }, 1000);
        
        console.log('✅ Timer iniciado com sucesso!');
    }
    
    pause() {
        console.log('⏸️ Pausando timer...');
        
        this.isRunning = false;
        this.isPaused = true;
        
        // Atualizar botões
        this.elements.startBtn.disabled = false;
        this.elements.pauseBtn.disabled = true;
        
        // Parar contagem
        if (this.timerInterval) {
            clearInterval(this.timerInterval);
            this.timerInterval = null;
        }
        
        console.log('✅ Timer pausado!');
    }
    
    reset() {
        console.log('🔄 Resetando timer...');
        
        // Parar timer
        this.isRunning = false;
        this.isPaused = false;
        
        // Parar contagem
        if (this.timerInterval) {
            clearInterval(this.timerInterval);
            this.timerInterval = null;
        }
        
        // Atualizar botões
        this.elements.startBtn.disabled = false;
        this.elements.pauseBtn.disabled = true;
        
        // Resetar tempo
        this.setTime();
        
        console.log('✅ Timer resetado!');
    }
    
    complete() {
        console.log('🎯 Timer completado! Modo:', this.currentMode);
        
        // Parar timer
        this.isRunning = false;
        this.isPaused = false;
        
        // Parar contagem
        if (this.timerInterval) {
            clearInterval(this.timerInterval);
            this.timerInterval = null;
        }
        
        // Atualizar botões
        this.elements.startBtn.disabled = false;
        this.elements.pauseBtn.disabled = true;
        
        // Atualizar estatísticas
        if (this.currentMode === 'work') {
            this.completedPomodoros++;
            this.currentStreak++;
            this.totalMinutes += this.settings.work;
            
            // Determinar próximo modo
            this.currentMode = 'break';
        } else {
            this.currentMode = 'work';
        }
        
        // Configurar próxima sessão
        this.setTime();
        this.updateStats();
        this.playSound();
        
        // Auto-iniciar após 3 segundos
        setTimeout(() => {
            if (!this.isRunning) {
                setTimeout(() => this.start(), 1000);
            }
        }, 3000);
    }
    
    // ===== INTERFACE =====
    updateDisplay() {
        const minutes = Math.floor(this.timeLeft / 60);
        const seconds = this.timeLeft % 60;
        
        // Atualizar tempo
        this.elements.timerTime.textContent = 
            `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        
        // Atualizar modo
        const modeText = {
            'work': 'TEMPO',
            'break': 'PAUSA'
        };
        this.elements.timerMode.textContent = modeText[this.currentMode];
        
        // Atualizar progresso
        const progress = this.totalTime > 0 ? ((this.totalTime - this.timeLeft) / this.totalTime) * 360 : 0;
        this.elements.timerProgress.style.background = `conic-gradient(
            #eab308 0deg,
            #eab308 ${progress}deg,
            rgba(71, 85, 105, 0.3) ${progress}deg
        )`;
        
        // Atualizar título da página
        document.title = `${this.elements.timerTime.textContent} - ${modeText[this.currentMode]} - Pomodoro Timer`;
    }
    
    updateStats() {
        this.elements.completedPomodoros.textContent = this.completedPomodoros;
        this.elements.totalTime.textContent = this.totalMinutes;
        this.elements.currentStreak.textContent = this.currentStreak;
    }
    
    playSound() {
        try {
            const audioContext = new (window.AudioContext || window.webkitAudioContext)();
            const oscillator = audioContext.createOscillator();
            const gainNode = audioContext.createGain();
            
            oscillator.connect(gainNode);
            gainNode.connect(audioContext.destination);
            
            oscillator.frequency.value = 800;
            oscillator.type = 'sine';
            
            gainNode.gain.setValueAtTime(0, audioContext.currentTime);
            gainNode.gain.linearRampToValueAtTime(0.3, audioContext.currentTime + 0.1);
            gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.5);
            
            oscillator.start(audioContext.currentTime);
            oscillator.stop(audioContext.currentTime + 0.5);
            
            console.log('🔊 Som tocado!');
        } catch (error) {
            console.log('🔇 Áudio não suportado:', error);
        }
    }
}

// ===== INICIALIZAR =====
const pomodoroTimer = new PomodoroTimer();

// Funções de debug globais
window.debugTimer = () => {
    console.log('🐛 Estado do Timer:', {
        isRunning: pomodoroTimer.isRunning,
        isPaused: pomodoroTimer.isPaused,
        currentMode: pomodoroTimer.currentMode,
        timeLeft: pomodoroTimer.timeLeft,
        totalTime: pomodoroTimer.totalTime,
        completedPomodoros: pomodoroTimer.completedPomodoros,
        totalMinutes: pomodoroTimer.totalMinutes,
        currentStreak: pomodoroTimer.currentStreak,
        settings: pomodoroTimer.settings
    });
};

window.forceComplete = () => {
    console.log('🚀 Forçando completar timer...');
    pomodoroTimer.complete();
};
</script>
@endsection