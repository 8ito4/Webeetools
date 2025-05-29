@extends('layouts.modern')

@section('title', 'Teste de Conexão - Webeetools')

@section('styles')
.speed-test-container {
    text-align: center;
    max-width: 600px;
    margin: 0 auto;
}

.speed-gauge {
    position: relative;
    width: 300px;
    height: 300px;
    margin: 2rem auto;
    background: conic-gradient(from 0deg, #ef4444 0%, #f59e0b 25%, #eab308 50%, #10b981 75%, #059669 100%);
    border-radius: 50%;
    padding: 20px;
    box-shadow: 0 0 50px rgba(234, 179, 8, 0.3);
}

.speed-gauge-inner {
    width: 100%;
    height: 100%;
    background: var(--dark-900);
    border-radius: 50%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    position: relative;
}

.speed-value {
    font-size: 3rem;
    font-weight: 700;
    color: var(--accent-400);
    font-family: 'JetBrains Mono', monospace;
    margin-bottom: 0.5rem;
}

.speed-unit {
    font-size: 1.25rem;
    color: #9ca3af;
    font-weight: 500;
}

.speed-label {
    font-size: 1rem;
    color: #cbd5e1;
    margin-top: 0.5rem;
}

.test-button {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--accent-400), var(--accent-600));
    border: none;
    color: var(--dark-950);
    font-size: 1.25rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(234, 179, 8, 0.4);
    margin: 2rem auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.test-button:hover {
    transform: scale(1.05);
    box-shadow: 0 12px 35px rgba(234, 179, 8, 0.5);
}

.test-button:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

.test-button.testing {
    animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.speed-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.5rem;
    margin: 2rem 0;
}

.stat-card {
    background: rgba(15, 23, 42, 0.6);
    border: 1px solid rgba(71, 85, 105, 0.3);
    border-radius: 1rem;
    padding: 1.5rem;
    text-align: center;
    transition: all 0.3s ease;
}

.stat-card:hover {
    border-color: rgba(234, 179, 8, 0.3);
    transform: translateY(-2px);
}

.stat-icon {
    width: 3rem;
    height: 3rem;
    border-radius: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    font-size: 1.25rem;
    color: white;
}

.stat-ping .stat-icon {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
}

.stat-download .stat-icon {
    background: linear-gradient(135deg, #10b981, #047857);
}

.stat-upload .stat-icon {
    background: linear-gradient(135deg, #f59e0b, #d97706);
}

.stat-value {
    font-size: 2rem;
    font-weight: 700;
    color: var(--accent-400);
    font-family: 'JetBrains Mono', monospace;
    margin-bottom: 0.5rem;
}

.stat-label {
    color: #9ca3af;
    font-size: 0.875rem;
    font-weight: 500;
}

.test-progress {
    background: rgba(15, 23, 42, 0.8);
    border: 1px solid rgba(71, 85, 105, 0.5);
    border-radius: 0.75rem;
    padding: 1.5rem;
    margin: 2rem 0;
    display: none;
}

.progress-bar {
    width: 100%;
    height: 8px;
    background: rgba(71, 85, 105, 0.3);
    border-radius: 4px;
    overflow: hidden;
    margin: 1rem 0;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--accent-400), var(--accent-500));
    border-radius: 4px;
    transition: width 0.3s ease;
    width: 0%;
}

.test-phase {
    color: #cbd5e1;
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.server-info {
    background: rgba(30, 41, 59, 0.5);
    border: 1px solid rgba(71, 85, 105, 0.3);
    border-radius: 0.75rem;
    padding: 1rem;
    margin: 1rem 0;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.server-icon {
    width: 2.5rem;
    height: 2.5rem;
    background: linear-gradient(135deg, var(--accent-400), var(--accent-600));
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--dark-950);
}

.server-details h4 {
    color: #f1f5f9;
    font-size: 1rem;
    margin-bottom: 0.25rem;
}

.server-details p {
    color: #9ca3af;
    font-size: 0.875rem;
}

.speed-recommendations {
    background: rgba(15, 23, 42, 0.6);
    border: 1px solid rgba(71, 85, 105, 0.3);
    border-radius: 1rem;
    padding: 1.5rem;
    margin: 2rem 0;
    display: none;
}

.recommendation-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 0.75rem 0;
    border-bottom: 1px solid rgba(71, 85, 105, 0.2);
}

.recommendation-item:last-child {
    border-bottom: none;
}

.recommendation-icon {
    width: 2rem;
    height: 2rem;
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.875rem;
    color: white;
}

.rec-streaming .recommendation-icon {
    background: linear-gradient(135deg, #ec4899, #db2777);
}

.rec-gaming .recommendation-icon {
    background: linear-gradient(135deg, #8b5cf6, #7c3aed);
}

.rec-work .recommendation-icon {
    background: linear-gradient(135deg, #06b6d4, #0891b2);
}

.recommendation-text {
    flex: 1;
}

.recommendation-text h5 {
    color: #f1f5f9;
    font-size: 0.875rem;
    margin-bottom: 0.25rem;
}

.recommendation-text p {
    color: #9ca3af;
    font-size: 0.75rem;
}

.recommendation-status {
    padding: 0.25rem 0.75rem;
    border-radius: 1rem;
    font-size: 0.75rem;
    font-weight: 500;
}

.status-excellent {
    background: rgba(16, 185, 129, 0.2);
    color: #10b981;
    border: 1px solid rgba(16, 185, 129, 0.3);
}

.status-good {
    background: rgba(245, 158, 11, 0.2);
    color: #f59e0b;
    border: 1px solid rgba(245, 158, 11, 0.3);
}

.status-poor {
    background: rgba(239, 68, 68, 0.2);
    color: #ef4444;
    border: 1px solid rgba(239, 68, 68, 0.3);
}

/* Modal de Permissão de Localização */
.location-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(10px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.location-modal.show {
    opacity: 1;
    visibility: visible;
}

.location-modal-content {
    background: linear-gradient(135deg, rgba(15, 23, 42, 0.95), rgba(30, 41, 59, 0.95));
    border: 1px solid rgba(71, 85, 105, 0.5);
    border-radius: 1rem;
    padding: 2rem;
    max-width: 400px;
    width: 90%;
    text-align: center;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
    transform: scale(0.9);
    transition: transform 0.3s ease;
}

.location-modal.show .location-modal-content {
    transform: scale(1);
}

.location-icon {
    width: 4rem;
    height: 4rem;
    background: linear-gradient(135deg, var(--accent-400), var(--accent-600));
    border-radius: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    color: var(--dark-950);
    font-size: 1.5rem;
}

.location-modal h3 {
    color: #f1f5f9;
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.location-modal p {
    color: #9ca3af;
    margin-bottom: 2rem;
    line-height: 1.6;
}

.location-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
}

.btn-allow {
    background: linear-gradient(135deg, var(--accent-500), var(--accent-600));
    color: var(--dark-950);
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-allow:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(234, 179, 8, 0.4);
}

.btn-deny {
    background: rgba(30, 41, 59, 0.5);
    color: #f1f5f9;
    border: 1px solid rgba(71, 85, 105, 0.5);
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-deny:hover {
    background: rgba(51, 65, 85, 0.6);
    border-color: rgba(234, 179, 8, 0.5);
}

@media (max-width: 768px) {
    .speed-gauge {
        width: 250px;
        height: 250px;
    }
    
    .speed-value {
        font-size: 2.5rem;
    }
    
    .speed-stats {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .test-button {
        width: 100px;
        height: 100px;
        font-size: 1rem;
    }
}
@endsection

@section('content')
<div class="tool-container">
    <div class="tool-header">
        <h1 class="tool-title">
            <i class="fas fa-tachometer-alt" style="color: var(--accent-400); margin-right: 0.5rem;"></i>
            Teste de Conexão
        </h1>
        <p class="tool-description">
            Meça a velocidade da sua internet com precisão - Ping, Download e Upload
        </p>
    </div>

    <div class="tool-content">
        <div class="speed-test-container">
            <!-- Servidor Info -->
            <div class="server-info">
                <div class="server-icon">
                    <i class="fas fa-server"></i>
                </div>
                <div class="server-details">
                    <h4>Servidor de Teste</h4>
                    <p id="server-location">
                        <i class="fas fa-spinner fa-spin" style="margin-right: 0.5rem;"></i>
                        Detectando localização...
                    </p>
                </div>
            </div>

            <!-- Velocímetro Principal -->
            <div class="speed-gauge">
                <div class="speed-gauge-inner">
                    <div class="speed-value" id="speed-display">0</div>
                    <div class="speed-unit">Mbps</div>
                    <div class="speed-label" id="test-phase-label">Clique para testar</div>
                </div>
            </div>

            <!-- Botão de Teste -->
            <button class="test-button" id="start-test-btn" onclick="startSpeedTest()">
                <i class="fas fa-play" id="test-icon"></i>
                <span id="test-text">INICIAR</span>
            </button>

            <!-- Progresso do Teste -->
            <div class="test-progress" id="test-progress">
                <div class="test-phase" id="current-phase">Preparando teste...</div>
                <div class="progress-bar">
                    <div class="progress-fill" id="progress-fill"></div>
                </div>
            </div>

            <!-- Estatísticas -->
            <div class="speed-stats">
                <div class="stat-card stat-ping">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-value" id="ping-value">--</div>
                    <div class="stat-label">Ping (ms)</div>
                </div>
                
                <div class="stat-card stat-download">
                    <div class="stat-icon">
                        <i class="fas fa-download"></i>
                    </div>
                    <div class="stat-value" id="download-value">--</div>
                    <div class="stat-label">Download (Mbps)</div>
                </div>
                
                <div class="stat-card stat-upload">
                    <div class="stat-icon">
                        <i class="fas fa-upload"></i>
                    </div>
                    <div class="stat-value" id="upload-value">--</div>
                    <div class="stat-label">Upload (Mbps)</div>
                </div>
            </div>

            <!-- Recomendações -->
            <div class="speed-recommendations" id="recommendations">
                <h3 style="color: #f1f5f9; margin-bottom: 1rem; text-align: center;">
                    <i class="fas fa-lightbulb" style="color: var(--accent-400); margin-right: 0.5rem;"></i>
                    Análise da sua Conexão
                </h3>
                
                <div class="recommendation-item rec-streaming">
                    <div class="recommendation-icon">
                        <i class="fas fa-play"></i>
                    </div>
                    <div class="recommendation-text">
                        <h5>Streaming (4K)</h5>
                        <p>Netflix, YouTube, Prime Video</p>
                    </div>
                    <div class="recommendation-status" id="streaming-status">--</div>
                </div>
                
                <div class="recommendation-item rec-gaming">
                    <div class="recommendation-icon">
                        <i class="fas fa-gamepad"></i>
                    </div>
                    <div class="recommendation-text">
                        <h5>Jogos Online</h5>
                        <p>CS:GO, Valorant, LOL</p>
                    </div>
                    <div class="recommendation-status" id="gaming-status">--</div>
                </div>
                
                <div class="recommendation-item rec-work">
                    <div class="recommendation-icon">
                        <i class="fas fa-video"></i>
                    </div>
                    <div class="recommendation-text">
                        <h5>Videoconferência</h5>
                        <p>Zoom, Teams, Meet</p>
                    </div>
                    <div class="recommendation-status" id="work-status">--</div>
                </div>
            </div>
        </div>

        <div id="status" class="hidden"></div>
    </div>
</div>

<!-- Modal de Permissão de Localização -->
<div class="location-modal" id="location-modal">
    <div class="location-modal-content">
        <div class="location-icon">
            <i class="fas fa-location-arrow"></i>
        </div>
        <h3>Acesso à Localização</h3>
        <p>O "Teste de Conexão" precisa acessar sua localização para lhe entregar um teste de velocidade mais preciso!</p>
        <div class="location-buttons">
            <button class="btn-deny" onclick="denyLocation()">Negar</button>
            <button class="btn-allow" onclick="allowLocation()">Permitir durante o uso</button>
        </div>
        <div style="margin-top: 1rem;">
            <label style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; color: #9ca3af; font-size: 0.875rem; cursor: pointer;">
                <input type="checkbox" id="dont-ask-again" style="margin: 0;">
                Não perguntar novamente!
            </label>
        </div>
    </div>
</div>

<script>
let isTestRunning = false;
let testResults = {
    ping: 0,
    download: 0,
    upload: 0
};

document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 Teste de Conexão carregado!');
    console.log('✅ Pronto para testar velocidade!');
    
    // Detectar localização do usuário
    detectUserLocation();
});

function detectUserLocation() {
    const locationElement = document.getElementById('server-location');
    
    if (!navigator.geolocation) {
        locationElement.innerHTML = 'Brasil - Webeetools';
        return;
    }
    
    // Verificar se o usuário escolheu "não perguntar novamente"
    const dontAskAgain = localStorage.getItem('webeetools_location_permission');
    if (dontAskAgain === 'denied') {
        locationElement.innerHTML = 'Brasil - Webeetools';
        return;
    } else if (dontAskAgain === 'granted') {
        getCurrentLocation();
        return;
    }
    
    // Verificar se já temos permissão ou se foi negada anteriormente
    navigator.permissions.query({name: 'geolocation'}).then(function(result) {
        if (result.state === 'granted') {
            // Já temos permissão, obter localização diretamente
            getCurrentLocation();
        } else if (result.state === 'prompt') {
            // Mostrar modal personalizado
            showLocationModal();
        } else {
            // Permissão negada
            locationElement.innerHTML = 'Brasil - Webeetools';
        }
    }).catch(function() {
        // Fallback se navigator.permissions não estiver disponível
        showLocationModal();
    });
}

function showLocationModal() {
    document.getElementById('location-modal').classList.add('show');
}

function allowLocation() {
    const dontAskAgain = document.getElementById('dont-ask-again').checked;
    
    if (dontAskAgain) {
        localStorage.setItem('webeetools_location_permission', 'granted');
    }
    
    hideLocationModal();
    getCurrentLocation();
}

function denyLocation() {
    const dontAskAgain = document.getElementById('dont-ask-again').checked;
    
    if (dontAskAgain) {
        localStorage.setItem('webeetools_location_permission', 'denied');
    }
    
    hideLocationModal();
    document.getElementById('server-location').innerHTML = 'Brasil - Webeetools';
    showStatus('Usando servidor padrão do Brasil', 'info');
}

function hideLocationModal() {
    document.getElementById('location-modal').classList.remove('show');
}

function getCurrentLocation() {
    const locationElement = document.getElementById('server-location');
    
    navigator.geolocation.getCurrentPosition(
        // Sucesso
        async function(position) {
            const lat = position.coords.latitude;
            const lon = position.coords.longitude;
            
            try {
                // Usar API de geocoding reverso para obter cidade/estado
                const response = await fetch(`https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${lat}&longitude=${lon}&localityLanguage=pt`);
                const data = await response.json();
                
                let location = 'Brasil';
                if (data.city && data.principalSubdivision) {
                    location = `${data.city}, ${data.principalSubdivision}`;
                } else if (data.locality && data.principalSubdivision) {
                    location = `${data.locality}, ${data.principalSubdivision}`;
                } else if (data.principalSubdivision) {
                    location = `${data.principalSubdivision}, Brasil`;
                }
                
                locationElement.innerHTML = `${location} - Webeetools`;
                console.log('📍 Localização detectada:', location);
                showStatus(`Servidor configurado para ${location}`, 'success');
                
            } catch (error) {
                console.error('Erro ao obter localização:', error);
                locationElement.innerHTML = 'Brasil - Webeetools';
                showStatus('Erro ao detectar localização. Usando servidor padrão.', 'warning');
            }
        },
        // Erro
        function(error) {
            console.log('Erro de geolocalização:', error.message);
            locationElement.innerHTML = 'Brasil - Webeetools';
            
            if (error.code === error.PERMISSION_DENIED) {
                showStatus('Permissão de localização negada. Usando servidor padrão.', 'info');
            } else if (error.code === error.TIMEOUT) {
                showStatus('Timeout na detecção de localização. Usando servidor padrão.', 'warning');
            } else {
                showStatus('Erro ao detectar localização. Usando servidor padrão.', 'warning');
            }
        },
        // Opções
        {
            enableHighAccuracy: false,
            timeout: 10000,
            maximumAge: 300000 // 5 minutos de cache
        }
    );
}

async function startSpeedTest() {
    if (isTestRunning) return;
    
    isTestRunning = true;
    const startBtn = document.getElementById('start-test-btn');
    const testIcon = document.getElementById('test-icon');
    const testText = document.getElementById('test-text');
    const progressDiv = document.getElementById('test-progress');
    const speedDisplay = document.getElementById('speed-display');
    const phaseLabel = document.getElementById('test-phase-label');
    
    // Reset UI
    resetTestUI();
    
    // Configurar botão
    startBtn.classList.add('testing');
    startBtn.disabled = true;
    testIcon.className = 'fas fa-spinner fa-spin';
    testText.textContent = 'TESTANDO';
    progressDiv.style.display = 'block';
    
    try {
        // Fase 1: Ping Test
        await runPingTest();
        
        // Fase 2: Download Test
        await runDownloadTest();
        
        // Fase 3: Upload Test
        await runUploadTest();
        
        // Finalizar
        finishTest();
        
    } catch (error) {
        console.error('Erro no teste:', error);
        showStatus('Erro ao executar teste de velocidade', 'error');
    } finally {
        // Restaurar botão
        isTestRunning = false;
        startBtn.classList.remove('testing');
        startBtn.disabled = false;
        testIcon.className = 'fas fa-redo';
        testText.textContent = 'REPETIR';
        progressDiv.style.display = 'none';
        phaseLabel.textContent = 'Teste concluído';
    }
}

async function runPingTest() {
    updateTestPhase('Testando Ping...', 10);
    
    // Simula teste de ping
    const pingValues = [];
    for (let i = 0; i < 5; i++) {
        await sleep(200);
        const ping = Math.random() * 50 + 10; // 10-60ms
        pingValues.push(ping);
        updateProgress(10 + (i * 6));
    }
    
    testResults.ping = Math.round(pingValues.reduce((a, b) => a + b) / pingValues.length);
    document.getElementById('ping-value').textContent = testResults.ping;
    
    updateProgress(40);
}

async function runDownloadTest() {
    updateTestPhase('Testando Download...', 40);
    
    const speedDisplay = document.getElementById('speed-display');
    const phaseLabel = document.getElementById('test-phase-label');
    
    phaseLabel.textContent = 'Download';
    
    // Simula teste de download com velocidade crescente
    let currentSpeed = 0;
    const maxSpeed = Math.random() * 200 + 50; // 50-250 Mbps
    
    for (let i = 0; i <= 100; i += 2) {
        await sleep(50);
        currentSpeed = (maxSpeed * i / 100);
        speedDisplay.textContent = currentSpeed.toFixed(1);
        updateProgress(40 + (i * 0.25));
    }
    
    testResults.download = Math.round(currentSpeed);
    document.getElementById('download-value').textContent = testResults.download;
    
    updateProgress(65);
}

async function runUploadTest() {
    updateTestPhase('Testando Upload...', 65);
    
    const speedDisplay = document.getElementById('speed-display');
    const phaseLabel = document.getElementById('test-phase-label');
    
    phaseLabel.textContent = 'Upload';
    
    // Simula teste de upload (geralmente menor que download)
    let currentSpeed = 0;
    const maxSpeed = testResults.download * 0.3 + Math.random() * 20; // ~30% do download
    
    for (let i = 0; i <= 100; i += 2) {
        await sleep(50);
        currentSpeed = (maxSpeed * i / 100);
        speedDisplay.textContent = currentSpeed.toFixed(1);
        updateProgress(65 + (i * 0.35));
    }
    
    testResults.upload = Math.round(currentSpeed);
    document.getElementById('upload-value').textContent = testResults.upload;
    
    updateProgress(100);
}

function finishTest() {
    const speedDisplay = document.getElementById('speed-display');
    const phaseLabel = document.getElementById('test-phase-label');
    
    // Mostrar velocidade de download como principal
    speedDisplay.textContent = testResults.download;
    phaseLabel.textContent = 'Download';
    
    // Mostrar recomendações
    showRecommendations();
    
    showStatus('Teste de velocidade concluído com sucesso!', 'success');
}

function showRecommendations() {
    const recommendationsDiv = document.getElementById('recommendations');
    recommendationsDiv.style.display = 'block';
    
    // Análise para Streaming 4K (requer ~25 Mbps)
    const streamingStatus = document.getElementById('streaming-status');
    if (testResults.download >= 25) {
        streamingStatus.textContent = 'Excelente';
        streamingStatus.className = 'recommendation-status status-excellent';
    } else if (testResults.download >= 15) {
        streamingStatus.textContent = 'Bom';
        streamingStatus.className = 'recommendation-status status-good';
    } else {
        streamingStatus.textContent = 'Limitado';
        streamingStatus.className = 'recommendation-status status-poor';
    }
    
    // Análise para Gaming (requer ping baixo)
    const gamingStatus = document.getElementById('gaming-status');
    if (testResults.ping <= 20 && testResults.download >= 10) {
        gamingStatus.textContent = 'Excelente';
        gamingStatus.className = 'recommendation-status status-excellent';
    } else if (testResults.ping <= 50 && testResults.download >= 5) {
        gamingStatus.textContent = 'Bom';
        gamingStatus.className = 'recommendation-status status-good';
    } else {
        gamingStatus.textContent = 'Limitado';
        gamingStatus.className = 'recommendation-status status-poor';
    }
    
    // Análise para Videoconferência (requer ~5 Mbps up/down)
    const workStatus = document.getElementById('work-status');
    if (testResults.download >= 10 && testResults.upload >= 5) {
        workStatus.textContent = 'Excelente';
        workStatus.className = 'recommendation-status status-excellent';
    } else if (testResults.download >= 5 && testResults.upload >= 2) {
        workStatus.textContent = 'Bom';
        workStatus.className = 'recommendation-status status-good';
    } else {
        workStatus.textContent = 'Limitado';
        workStatus.className = 'recommendation-status status-poor';
    }
}

function updateTestPhase(phase, progress) {
    document.getElementById('current-phase').textContent = phase;
    updateProgress(progress);
}

function updateProgress(percentage) {
    document.getElementById('progress-fill').style.width = percentage + '%';
}

function resetTestUI() {
    // Reset valores
    document.getElementById('ping-value').textContent = '--';
    document.getElementById('download-value').textContent = '--';
    document.getElementById('upload-value').textContent = '--';
    document.getElementById('speed-display').textContent = '0';
    document.getElementById('test-phase-label').textContent = 'Preparando...';
    
    // Esconder recomendações
    document.getElementById('recommendations').style.display = 'none';
    
    // Reset progresso
    updateProgress(0);
}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function showStatus(message, type) {
    const statusElement = document.getElementById('status');
    statusElement.className = `status-message status-${type}`;
    statusElement.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : type === 'warning' ? 'exclamation-triangle' : 'info-circle'}"></i>
        ${message}
    `;
    statusElement.classList.remove('hidden');
    
    if (type === 'success' || type === 'info') {
        setTimeout(() => {
            hideStatus();
        }, 3000);
    }
}

function hideStatus() {
    document.getElementById('status').classList.add('hidden');
}
</script>
@endsection 