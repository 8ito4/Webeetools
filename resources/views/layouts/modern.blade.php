<!DOCTYPE html>
<html lang="pt-BR" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Webeetools - Ferramentas Online para Desenvolvedores')</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ctext y='.9em' font-size='90'%3E🛠️%3C/text%3E%3C/svg%3E">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        :root {
            --dark-950: #020617;
            --dark-900: #0f172a;
            --dark-800: #1e293b;
            --dark-700: #334155;
            --dark-600: #475569;
            --accent-300: #fde047;
            --accent-400: #facc15;
            --accent-500: #eab308;
            --accent-600: #ca8a04;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: linear-gradient(135deg, var(--dark-950) 0%, var(--dark-900) 25%, var(--dark-800) 50%, var(--dark-900) 75%, var(--dark-950) 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
            color: #f1f5f9;
            min-height: 100vh;
            overflow-x: hidden;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Particles */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .particle {
            position: absolute;
            width: 2px;
            height: 2px;
            background: var(--accent-400);
            border-radius: 50%;
            animation: particleFloat 20s linear infinite;
        }

        @keyframes particleFloat {
            0% {
                transform: translateY(100vh) translateX(0);
                opacity: 0;
            }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% {
                transform: translateY(-100px) translateX(100px);
                opacity: 0;
            }
        }

        /* Navigation */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 50;
            background: linear-gradient(135deg, rgba(2, 6, 23, 0.8) 0%, rgba(15, 23, 42, 0.6) 100%);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(71, 85, 105, 0.3);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .nav-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 4rem;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: inherit;
        }

        .logo-icon {
            width: 2.5rem;
            height: 2.5rem;
            background: linear-gradient(135deg, var(--accent-400), var(--accent-600));
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--dark-950);
            font-size: 1.125rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(234, 179, 8, 0.3);
        }

        .logo:hover .logo-icon {
            transform: scale(1.1) rotate(12deg);
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .logo-text .we {
            color: #f1f5f9;
        }

        .logo-text .bee {
            color: var(--accent-400);
        }

        .logo-text .tools {
            color: #f1f5f9;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            color: #cbd5e1;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-links a:hover {
            color: var(--accent-400);
            transform: scale(1.05);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--accent-400);
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        /* Lo-fi Player - Ultra Minimal (igual ao index) */
        .lofi-player {
            background: rgba(30, 41, 59, 0.3);
            border-radius: 0.5rem;
            padding: 0.375rem 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
            border: 1px solid rgba(71, 85, 105, 0.1);
            transition: all 0.2s ease;
        }

        .lofi-player:hover {
            background: rgba(30, 41, 59, 0.4);
            border-color: rgba(234, 179, 8, 0.2);
        }

        .lofi-text {
            font-size: 0.7rem;
            color: var(--accent-400);
            font-weight: 400;
            text-transform: none;
        }

        .play-btn {
            background: transparent;
            border: none;
            color: var(--accent-400);
            cursor: pointer;
            transition: all 0.2s ease;
            padding: 0.25rem;
            border-radius: 0.25rem;
            width: 1.5rem;
            height: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .play-btn:hover {
            color: var(--accent-300);
        }

        .play-btn i {
            font-size: 0.5rem;
            margin-left: 1px;
        }

        /* Container para as barrinhas */
        .music-container {
            width: 0;
            height: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            transition: width 0.3s ease;
        }

        /* Animação de barrinhas */
        .music-bars {
            display: flex;
            align-items: center;
            gap: 1px;
            height: 0.75rem;
        }

        .music-bars .bar {
            width: 2px;
            background: var(--accent-400);
            border-radius: 1px;
            animation: musicBar 1s ease-in-out infinite;
        }

        .music-bars .bar:nth-child(1) {
            height: 0.25rem;
            animation-delay: 0s;
        }

        .music-bars .bar:nth-child(2) {
            height: 0.5rem;
            animation-delay: 0.2s;
        }

        .music-bars .bar:nth-child(3) {
            height: 0.375rem;
            animation-delay: 0.4s;
        }

        .music-bars .bar:nth-child(4) {
            height: 0.25rem;
            animation-delay: 0.6s;
        }

        @keyframes musicBar {
            0%, 100% {
                transform: scaleY(0.3);
                opacity: 0.6;
            }
            50% {
                transform: scaleY(1);
                opacity: 1;
            }
        }

        /* Estado Playing - container se expande */
        .lofi-player.playing .music-container {
            width: 20px;
        }

        /* Main Content */
        .main-content {
            padding-top: 4rem;
            min-height: 100vh;
            position: relative;
            z-index: 10;
        }

        /* Tool Container */
        .tool-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        .tool-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .tool-title {
            font-size: clamp(2rem, 5vw, 3rem);
            font-weight: 700;
            margin-bottom: 1rem;
            color: #f1f5f9;
        }

        .tool-description {
            color: #9ca3af;
            font-size: 1.125rem;
            max-width: 48rem;
            margin: 0 auto;
        }

        .tool-content {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.6) 0%, rgba(30, 41, 59, 0.4) 50%, rgba(15, 23, 42, 0.6) 100%);
            background-size: 200% 200%;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(30, 41, 59, 0.5);
            border-radius: 1rem;
            padding: 2rem;
            animation: cardGradientShift 8s ease infinite;
        }

        @keyframes cardGradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            color: #e2e8f0;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .form-input, .form-textarea {
            width: 100%;
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(71, 85, 105, 0.5);
            border-radius: 0.5rem;
            padding: 0.75rem;
            color: #f1f5f9;
            font-family: 'JetBrains Mono', monospace;
            transition: all 0.3s ease;
        }

        .form-input:focus, .form-textarea:focus {
            outline: none;
            border-color: var(--accent-400);
            box-shadow: 0 0 0 3px rgba(234, 179, 8, 0.1);
        }

        .form-textarea {
            resize: vertical;
            min-height: 200px;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 0.875rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent-500), var(--accent-600));
            color: var(--dark-950);
            box-shadow: 0 4px 15px rgba(234, 179, 8, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(234, 179, 8, 0.4);
        }

        .btn-secondary {
            background: rgba(30, 41, 59, 0.5);
            color: #f1f5f9;
            border: 1px solid rgba(71, 85, 105, 0.5);
        }

        .btn-secondary:hover {
            background: rgba(51, 65, 85, 0.6);
            border-color: rgba(234, 179, 8, 0.5);
        }

        /* Grid */
        .grid {
            display: grid;
            gap: 1.5rem;
        }

        .grid-cols-1 {
            grid-template-columns: 1fr;
        }

        .grid-cols-2 {
            grid-template-columns: repeat(2, 1fr);
        }

        @media (max-width: 768px) {
            .grid-cols-2 {
                grid-template-columns: 1fr;
            }
            
            .nav-links {
                display: none;
            }
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--dark-900);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--accent-600);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--accent-500);
        }

        /* Status Messages */
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

        .hidden {
            display: none;
        }

        @yield('styles')
    </style>
</head>
<body>
    <!-- Particles Background -->
    <div class="particles" id="particles"></div>

    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="/" class="logo">
                <div class="logo-icon">
                    <i class="fas fa-tools"></i>
                </div>
                <span class="logo-text">
                    <span class="we">We</span><span class="bee">bee</span><span class="tools">tools</span>
                </span>
            </a>
            
            <ul class="nav-links">
                <li><a href="/">Início</a></li>
                <li><a href="/tools">Ferramentas</a></li>
                <li><a href="/contact">Contato</a></li>
            </ul>
            
            <div class="lofi-player">
                <span class="lofi-text">Lo-fi</span>
                <div class="music-container">
                    <div class="music-bars">
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                    </div>
                </div>
                <button class="play-btn" id="playBtn">
                    <i class="fas fa-play"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <script>
        // Particles Animation
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 30;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 20 + 's';
                particle.style.animationDuration = (Math.random() * 10 + 15) + 's';
                particlesContainer.appendChild(particle);
            }
        }

        // Lo-fi Audio Player
        let audio = null;
        let isPlaying = false;
        const playBtn = document.getElementById('playBtn');
        const playIcon = playBtn.querySelector('i');
        const lofiPlayer = document.querySelector('.lofi-player');

        playBtn.addEventListener('click', function() {
            if (isPlaying && audio) {
                audio.pause();
                isPlaying = false;
                playIcon.className = 'fas fa-play';
                lofiPlayer.classList.remove('playing');
            } else {
                if (!audio) {
                    const audioUrls = [
                        'https://stream.zeno.fm/0r0xa792kwzuv',
                        'https://stream.zeno.fm/f3wvbbqmdg8uv',
                        'https://stream.rcast.net/70643',
                        'https://stream.rcast.net/261654'
                    ];
                    
                    audio = new Audio();
                    audio.loop = true;
                    audio.volume = 0.3;
                    
                    let currentUrlIndex = 0;
                    
                    function tryNextUrl() {
                        if (currentUrlIndex < audioUrls.length) {
                            audio.src = audioUrls[currentUrlIndex];
                            audio.load();
                            
                            audio.play().then(() => {
                                console.log('Áudio iniciado:', audioUrls[currentUrlIndex]);
                                isPlaying = true;
                                playIcon.className = 'fas fa-pause';
                                lofiPlayer.classList.add('playing');
                            }).catch(error => {
                                console.error('Erro:', error);
                                currentUrlIndex++;
                                if (currentUrlIndex < audioUrls.length) {
                                    tryNextUrl();
                                }
                            });
                        }
                    }
                    
                    audio.addEventListener('pause', function() {
                        isPlaying = false;
                        playIcon.className = 'fas fa-play';
                        lofiPlayer.classList.remove('playing');
                    });
                    
                    audio.addEventListener('play', function() {
                        isPlaying = true;
                        playIcon.className = 'fas fa-pause';
                        lofiPlayer.classList.add('playing');
                    });
                    
                    tryNextUrl();
                } else {
                    audio.play().then(() => {
                        isPlaying = true;
                        playIcon.className = 'fas fa-pause';
                        lofiPlayer.classList.add('playing');
                    });
                }
            }
        });

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            createParticles();
        });

        @yield('scripts')
    </script>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <!-- Copy Function Padrão -->
    <script>
        // ===== FUNÇÃO DE COPY PADRÃO PARA TODO O SISTEMA =====
        function copyToClipboard(text, buttonElement = null) {
            // Se não foi passado o texto, tenta pegar do elemento
            if (!text && buttonElement) {
                const targetElement = buttonElement.closest('.copy-container')?.querySelector('.copy-target') ||
                                    buttonElement.parentElement?.querySelector('input, textarea, pre, .result-text') ||
                                    buttonElement.previousElementSibling;
                
                if (targetElement) {
                    text = targetElement.value || targetElement.textContent || targetElement.innerText;
                }
            }
            
            if (!text || text.trim() === '' || text === 'Clique em Gerar' || text === 'Nenhuma resposta ainda...') {
                showCopyNotification('Nenhum conteúdo para copiar', 'warning');
                return;
            }
            
            navigator.clipboard.writeText(text).then(() => {
                showCopyFeedback(buttonElement);
                showCopyNotification('Copiado para a área de transferência!', 'success');
            }).catch((err) => {
                console.error('Erro ao copiar:', err);
                // Fallback para navegadores mais antigos
                try {
                    const textArea = document.createElement('textarea');
                    textArea.value = text;
                    document.body.appendChild(textArea);
                    textArea.select();
                    document.execCommand('copy');
                    document.body.removeChild(textArea);
                    
                    showCopyFeedback(buttonElement);
                    showCopyNotification('Copiado para a área de transferência!', 'success');
                } catch (fallbackErr) {
                    showCopyNotification('Erro ao copiar', 'error');
                }
            });
        }
        
        function showCopyFeedback(buttonElement) {
            if (!buttonElement) return;
            
            const icon = buttonElement.querySelector('i');
            const originalClass = icon ? icon.className : '';
            const originalColor = buttonElement.style.color;
            
            // Adicionar classe de feedback
            buttonElement.classList.add('copied');
            
            // Mudar ícone para check
            if (icon) {
                icon.className = 'fas fa-check';
            }
            
            // Mudar cor para verde
            buttonElement.style.color = '#10b981';
            
            // Restaurar após 2 segundos
            setTimeout(() => {
                buttonElement.classList.remove('copied');
                if (icon) {
                    icon.className = originalClass;
                }
                buttonElement.style.color = originalColor;
            }, 2000);
        }
        
        function showCopyNotification(message, type = 'success') {
            // Remover notificação existente
            const existingNotification = document.querySelector('.copy-notification');
            if (existingNotification) {
                existingNotification.remove();
            }
            
            // Criar nova notificação
            const notification = document.createElement('div');
            notification.className = `copy-notification copy-notification-${type}`;
            notification.innerHTML = `
                <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'warning' ? 'fa-exclamation-triangle' : 'fa-times-circle'}"></i>
                <span>${message}</span>
            `;
            
            // Adicionar estilos
            notification.style.cssText = `
                position: fixed;
                top: 2rem;
                right: 2rem;
                z-index: 10000;
                padding: 1rem 1.5rem;
                border-radius: 0.75rem;
                color: white;
                font-weight: 500;
                display: flex;
                align-items: center;
                gap: 0.5rem;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
                backdrop-filter: blur(10px);
                transform: translateX(100%);
                transition: all 0.3s ease;
                ${type === 'success' ? 'background: rgba(16, 185, 129, 0.9);' : 
                  type === 'warning' ? 'background: rgba(245, 158, 11, 0.9);' : 
                  'background: rgba(239, 68, 68, 0.9);'}
            `;
            
            document.body.appendChild(notification);
            
            // Animar entrada
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 10);
            
            // Remover após 3 segundos
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    if (notification.parentElement) {
                        notification.remove();
                    }
                }, 300);
            }, 3000);
        }
        
        // CSS para o estado copied
        const copyStyles = document.createElement('style');
        copyStyles.textContent = `
            .copy-button.copied {
                background: rgba(16, 185, 129, 0.2) !important;
                border-color: rgba(16, 185, 129, 0.3) !important;
                color: #10b981 !important;
            }
            
            .copy-notification {
                animation: slideInRight 0.3s ease;
            }
            
            @keyframes slideInRight {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
        `;
        document.head.appendChild(copyStyles);
    </script>
</body>
</html> 