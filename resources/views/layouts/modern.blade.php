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

        /* Audio Players Container */
        .audio-players {
            display: flex;
            align-items: center;
            gap: 0.5rem; /* Espaçamento pequeno entre os players */
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

        /* Rain Player - Apenas ícones */
        .rain-player {
            background: transparent;
            border: none;
            padding: 0;
            display: flex;
            align-items: center;
            gap: 0.25rem;
            transition: all 0.2s ease;
        }

        .rain-text {
            font-size: 0.7rem;
            color: #60a5fa;
            font-weight: 400;
            text-transform: none;
        }

        .rain-btn {
            background: transparent;
            border: none;
            color: #60a5fa;
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

        .rain-btn:hover {
            color: #3b82f6;
            background: rgba(59, 130, 246, 0.1);
        }

        .rain-btn i {
            font-size: 0.75rem; /* Ícone um pouco maior */
        }

        /* Container para as gotinhas - do lado direito */
        .rain-container {
            width: 0;
            height: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            transition: width 0.3s ease;
            order: 3; /* Fica por último (direita) */
        }

        /* Animação de gotinhas */
        .rain-drops {
            display: flex;
            align-items: center;
            gap: 1px;
            height: 0.75rem;
        }

        .rain-drops .drop {
            width: 2px;
            height: 4px;
            background: #60a5fa;
            border-radius: 0 0 50% 50%;
            animation: rainDrop 1.5s ease-in-out infinite;
        }

        .rain-drops .drop:nth-child(1) {
            animation-delay: 0s;
        }

        .rain-drops .drop:nth-child(2) {
            animation-delay: 0.3s;
        }

        .rain-drops .drop:nth-child(3) {
            animation-delay: 0.6s;
        }

        @keyframes rainDrop {
            0% {
                opacity: 0;
                transform: translateY(-4px) scale(0.5);
            }
            50% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
            100% {
                opacity: 0;
                transform: translateY(4px) scale(0.5);
            }
        }

        /* Estado Playing - container se expande */
        .rain-player.playing .rain-container {
            width: 16px;
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

        /* Loading dots para rain player */
        .loading-dots {
            display: flex;
            align-items: center;
            gap: 1px;
            height: 0.75rem;
        }

        .loading-dots .dot {
            width: 2px;
            height: 2px;
            background: #60a5fa;
            border-radius: 50%;
            animation: loadingDot 1.4s ease-in-out infinite;
        }

        .loading-dots .dot:nth-child(1) {
            animation-delay: 0s;
        }

        .loading-dots .dot:nth-child(2) {
            animation-delay: 0.2s;
        }

        .loading-dots .dot:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes loadingDot {
            0%, 80%, 100% {
                opacity: 0.3;
                transform: scale(0.8);
            }
            40% {
                opacity: 1;
                transform: scale(1.2);
            }
        }

        /* Estado Loading - container se expande */
        .rain-player.loading .rain-container {
            width: 16px;
        }

        /* Footer */
        .footer {
            background: linear-gradient(135deg, rgba(2, 6, 23, 0.95) 0%, rgba(15, 23, 42, 0.8) 100%);
            backdrop-filter: blur(20px);
            border-top: 1px solid rgba(71, 85, 105, 0.3);
            padding: 3rem 1rem 1.5rem;
            margin-top: 4rem;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin-bottom: 2rem;
            align-items: start;
            justify-items: center;
        }

        .footer-section {
            text-align: left;
            width: 100%;
            max-width: 280px;
        }

        .footer-section h3 {
            color: var(--accent-400);
            font-size: 1.125rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .footer-section p {
            color: #cbd5e1;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .footer-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .footer-links a {
            color: #9ca3af;
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-links a:hover {
            color: var(--accent-400);
            transform: translateX(4px);
        }

        .footer-social {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(30, 41, 59, 0.5);
            border: 1px solid rgba(71, 85, 105, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9ca3af;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-btn:hover {
            background: rgba(234, 179, 8, 0.2);
            border-color: var(--accent-400);
            color: var(--accent-400);
            transform: translateY(-2px);
        }

        .footer-bottom {
            border-top: 1px solid rgba(71, 85, 105, 0.3);
            padding-top: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }

        .footer-bottom-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .footer-bottom-links a {
            color: #9ca3af;
            text-decoration: none;
            font-size: 0.875rem;
            transition: color 0.3s ease;
        }

        .footer-bottom-links a:hover {
            color: var(--accent-400);
        }

        .footer-copyright {
            color: #6b7280;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .footer-logo-icon {
            width: 2rem;
            height: 2rem;
            background: linear-gradient(135deg, var(--accent-400), var(--accent-600));
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--dark-950);
            font-size: 0.875rem;
        }

        .footer-logo-text {
            font-size: 1.25rem;
            font-weight: 700;
        }

        .footer-logo-text .we {
            color: #f1f5f9;
        }

        .footer-logo-text .bee {
            color: var(--accent-400);
        }

        .footer-logo-text .tools {
            color: #f1f5f9;
        }

        @media (max-width: 768px) {
            .footer-grid {
                grid-template-columns: 1fr;
                text-align: center;
                max-width: 100%;
            }
            
            .footer-section {
                text-align: center;
            }
            
            .footer-bottom-links {
                flex-direction: column;
                gap: 1rem;
            }
            
            .footer-social {
                justify-content: center;
            }
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
                <li><a href="/#tools">Ferramentas</a></li>
                <li><a href="/contact">Contato</a></li>
            </ul>
            
            <div class="audio-players">
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
                
                <!-- Rain Player -->
                <div class="rain-player">
                    <button class="rain-btn" id="rainBtn">
                        <i class="fas fa-cloud-rain"></i>
                    </button>
                    <div class="rain-container">
                        <div class="loading-dots">
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                        </div>
                        <div class="rain-drops">
                            <div class="drop"></div>
                            <div class="drop"></div>
                            <div class="drop"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-grid">
                <!-- Sobre o Webeetools -->
                <div class="footer-section">
                    <div class="footer-logo">
                        <div class="footer-logo-icon">
                            <i class="fas fa-tools"></i>
                        </div>
                        <span class="footer-logo-text">
                            <span class="we">We</span><span class="bee">bee</span><span class="tools">tools</span>
                        </span>
                    </div>
                    <p>Sua caixa de ferramentas completa para desenvolvimento web. Todas as ferramentas que você precisa, 100% gratuitas e sem coleta de dados.</p>
                    
                    <!-- Banner Privacidade -->
                    <div style="background: rgba(16, 185, 129, 0.2); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 0.5rem; padding: 0.75rem 1rem; margin: 1rem 0; text-align: center;">
                        <span style="color: #10b981; font-weight: 600; font-size: 0.875rem;">
                            <i class="fas fa-shield-alt" style="margin-right: 0.5rem;"></i>
                            <strong>100% Privado</strong> - Sem coleta de dados
                        </span>
                    </div>
                </div>

                <!-- Ferramentas -->
                <div class="footer-section">
                    <h3>🛠️ Ferramentas</h3>
                    <ul class="footer-links">
                        <li><a href="/tools/json"><i class="fas fa-code"></i> Formatador JSON</a></li>
                        <li><a href="/tools/password"><i class="fas fa-key"></i> Gerador de Senhas</a></li>
                        <li><a href="/tools/whatsapp-link"><i class="fab fa-whatsapp"></i> Link WhatsApp</a></li>
                        <li><a href="/tools/network-tools"><i class="fas fa-tachometer-alt"></i> Teste de Conexão</a></li>
                        <li><a href="/tools/lorem"><i class="fas fa-paragraph"></i> Lorem Ipsum</a></li>
                        <li><a href="/tools/document"><i class="fas fa-file-alt"></i> Gerador CPF/CNPJ</a></li>
                        <li><a href="/tools/resume-generator"><i class="fas fa-file-pdf"></i> Gerador de Currículo</a></li>
                    </ul>
                    
                    <!-- Redes Sociais -->
                    <div class="footer-social">
                        <a href="https://github.com/8ito4" target="_blank" class="social-btn" title="GitHub - Douglas Soares">
                            <i class="fab fa-github"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/douglas-soares-204084235/" target="_blank" class="social-btn" title="LinkedIn - Douglas Soares">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>
                </div>

                <!-- Informações Legais -->
                <div class="footer-section">
                    <h3>⚖️ Legal</h3>
                    <ul class="footer-links">
                        <li><a href="/termos-de-uso"><i class="fas fa-file-contract"></i> Termos de Uso</a></li>
                        <li><a href="/politica-privacidade"><i class="fas fa-shield-alt"></i> Política de Privacidade</a></li>
                        <li><a href="/cookies"><i class="fas fa-cookie-bite"></i> Política de Cookies</a></li>
                        <li><a href="/licensa"><i class="fas fa-balance-scale"></i> Licença</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="footer-bottom-links">
                    <a href="/">Início</a>
                    <a href="/#tools">Ferramentas</a>
                    <a href="/termos-de-uso">Termos de Uso</a>
                    <a href="/politica-privacidade">Política de Privacidade</a>
                    <a href="/contact">Contato</a>
                </div>
                <p class="footer-copyright">
                    © 2024 <strong>Webeetools</strong>. Todos os direitos reservados. 
                    <span style="margin-left: 1rem;">Feito com <i class="fas fa-heart" style="color: #ef4444;"></i> para desenvolvedores</span>
                </p>
            </div>
        </div>
    </footer>

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

        // Smooth Scrolling - Corrigido para lidar com links absolutos
        document.querySelectorAll('a[href*="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                let targetId = '';
                
                // Verificar se é um link absoluto com fragment (/#tools) ou apenas fragment (#tools)
                if (href.includes('/#')) {
                    targetId = '#' + href.split('/#')[1];
                } else if (href.startsWith('#')) {
                    targetId = href;
                } else {
                    return; // Se não é um link com fragment, deixar comportamento padrão
                }
                
                // Se não estivermos na página inicial e o link for absoluto, redirecionar
                if (href.includes('/#') && window.location.pathname !== '/') {
                    window.location.href = href;
                    return;
                }
                
                e.preventDefault();
                
                // Se for o link "Início", rolar para o topo absoluto
                if (targetId === '#home' || href === '/') {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                } else {
                    const target = document.querySelector(targetId);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });

        // Rain Audio Player - STREAMS COM LOADING VISUAL
        let rainAudio = null;
        let isRainPlaying = false;
        let currentRainUrlIndex = 0;
        const rainBtn = document.getElementById('rainBtn');
        const rainIcon = rainBtn.querySelector('i');
        const rainPlayer = document.querySelector('.rain-player');
        const loadingDots = rainPlayer.querySelector('.loading-dots');
        const rainDrops = rainPlayer.querySelector('.rain-drops');

        // URLs de streams REAIS de chuva especializados
        const rainUrls = [
            'https://stream.rcast.net/272984', // NATURE RADIO RAIN - Spa Radiance Rain Shower Ambience
            'https://radiosuitenetwork.torontocast.stream/nature-radio-rain/', // Nature Radio Rain Direct
            'https://stream.rcast.net/247619', // NATURE RADIO RAIN - Rain relax Rainy Weather  
            'https://stream.rcast.net/283464', // NATURE RADIO SLEEP - Pro Sound Effects Library City Rain
            'https://stream.rcast.net/281503', // Ambi Nature Radio - Rain at the Lake House
            'https://maggie.torontocast.com:8108/stream', // Nature Rain Direct Stream
            'http://79.111.14.76:8000/soundnat', // Radio Caprice Nature
            'https://kathy.torontocast.com:3250/stream', // Channel Chill Zen Garden Rainforest
        ];

        rainBtn.addEventListener('click', function() {
            if (isRainPlaying) {
                // Parar chuva
                stopRain();
            } else {
                // Iniciar chuva com feedback imediato
                startRainWithLoading();
            }
        });

        function startRainWithLoading() {
            // 1. FEEDBACK VISUAL IMEDIATO
            rainIcon.className = 'fas fa-cloud'; // Muda ícone imediatamente
            rainPlayer.classList.add('loading'); // Mostra loading dots
            loadingDots.style.display = 'flex';
            rainDrops.style.display = 'none';
            console.log('🌧️ Iniciando busca por streams...');
            
            // 2. TENTAR STREAMS REAIS
            currentRainUrlIndex = 0;
            tryRainStreams();
        }

        function tryRainStreams() {
            if (currentRainUrlIndex >= rainUrls.length) {
                console.log('🎧 Streams falharam, usando gerador...');
                startGeneratedRain();
                return;
            }

            const url = rainUrls[currentRainUrlIndex];
            console.log(`🔄 Tentando stream ${currentRainUrlIndex + 1}/${rainUrls.length}`);
            
            rainAudio = new Audio();
            rainAudio.crossOrigin = 'anonymous';
            rainAudio.volume = 0.25;
            rainAudio.loop = true;
            
            const timeoutId = setTimeout(() => {
                console.log('⏱️ Timeout - próximo...');
                currentRainUrlIndex++;
                tryRainStreams();
            }, 4000);
            
            const onSuccess = () => {
                clearTimeout(timeoutId);
                rainAudio.removeEventListener('canplaythrough', onSuccess);
                rainAudio.removeEventListener('error', onError);
                
                // SUCESSO - TROCAR PARA ANIMAÇÃO DE CHUVA
                showRainAnimation();
                console.log('✅ Stream conectado!');
                
                rainAudio.play().catch(() => {
                    currentRainUrlIndex++;
                    tryRainStreams();
                });
            };
            
            const onError = () => {
                clearTimeout(timeoutId);
                rainAudio.removeEventListener('canplaythrough', onSuccess);
                rainAudio.removeEventListener('error', onError);
                console.log('❌ Erro - próximo...');
                currentRainUrlIndex++;
                tryRainStreams();
            };
            
            rainAudio.addEventListener('canplaythrough', onSuccess);
            rainAudio.addEventListener('error', onError);
            rainAudio.src = url;
            rainAudio.load();
        }

        function startGeneratedRain() {
            try {
                const audioContext = new (window.AudioContext || window.webkitAudioContext)();
                window.rainContext = audioContext;
                
                const masterGain = audioContext.createGain();
                masterGain.gain.value = 0.15;
                masterGain.connect(audioContext.destination);
                
                const noiseNode = audioContext.createScriptProcessor(4096, 1, 1);
                const rainFilter = audioContext.createBiquadFilter();
                
                rainFilter.type = 'lowpass';
                rainFilter.frequency.value = 800;
                rainFilter.Q.value = 0.5;
                
                noiseNode.onaudioprocess = function(e) {
                    const output = e.outputBuffer.getChannelData(0);
                    for (let i = 0; i < output.length; i++) {
                        output[i] = (Math.random() * 2 - 1) * 0.4;
                    }
                };
                
                noiseNode.connect(rainFilter);
                rainFilter.connect(masterGain);
                
                function createRainDrop() {
                    if (window.rainContext && window.rainContext.state === 'running') {
                        const drop = audioContext.createOscillator();
                        const dropGain = audioContext.createGain();
                        const dropFilter = audioContext.createBiquadFilter();
                        
                        dropFilter.type = 'bandpass';
                        dropFilter.frequency.value = 1000 + Math.random() * 2000;
                        dropFilter.Q.value = 2;
                        
                        drop.type = 'sine';
                        drop.frequency.value = 600 + Math.random() * 1000;
                        
                        const now = audioContext.currentTime;
                        dropGain.gain.setValueAtTime(0, now);
                        dropGain.gain.linearRampToValueAtTime(0.05, now + 0.005);
                        dropGain.gain.exponentialRampToValueAtTime(0.001, now + 0.08);
                        
                        drop.connect(dropFilter);
                        dropFilter.connect(dropGain);
                        dropGain.connect(masterGain);
                        
                        drop.start(now);
                        drop.stop(now + 0.08);
                        
                        setTimeout(createRainDrop, 80 + Math.random() * 150);
                    }
                }
                
                createRainDrop();
                showRainAnimation();
                console.log('✅ Gerador iniciado');
                
            } catch (error) {
                console.error('Erro:', error);
                showRainAnimation(); // Pelo menos mostra a animação
            }
        }

        function showRainAnimation() {
            // TROCAR DE LOADING PARA ANIMAÇÃO DE CHUVA
            isRainPlaying = true;
            rainPlayer.classList.remove('loading');
            rainPlayer.classList.add('playing');
            loadingDots.style.display = 'none';
            rainDrops.style.display = 'flex';
        }

        function stopRain() {
            // Parar tudo
            if (rainAudio) {
                rainAudio.pause();
                rainAudio.src = '';
                rainAudio = null;
            }
            
            if (window.rainContext) {
                try {
                    window.rainContext.close();
                } catch (e) {
                    console.log('Context fechado');
                }
                window.rainContext = null;
            }
            
            isRainPlaying = false;
            rainIcon.className = 'fas fa-cloud-rain';
            rainPlayer.classList.remove('loading', 'playing');
            loadingDots.style.display = 'none';
            rainDrops.style.display = 'none';
            console.log('🔇 Chuva parada');
        }

        // Footer Functions
        function reportBug() {
            const subject = encodeURIComponent('🐛 Reportar Bug - Webeetools');
            const body = encodeURIComponent(`
Olá equipe Webeetools,

Encontrei um possível bug e gostaria de reportar:

🔍 **Descrição do Bug:**
[Descreva detalhadamente o problema encontrado]

📱 **Ambiente:**
- Navegador: ${navigator.userAgent}
- URL: ${window.location.href}
- Data/Hora: ${new Date().toLocaleString('pt-BR')}

🔄 **Passos para Reproduzir:**
1. [Primeiro passo]
2. [Segundo passo]
3. [Terceiro passo]

✅ **Comportamento Esperado:**
[O que deveria acontecer]

❌ **Comportamento Atual:**
[O que está acontecendo]

📷 **Screenshots/Evidências:**
[Se possível, anexe capturas de tela]

Obrigado pela atenção!
            `);
            
            window.open(`mailto:contato@webeetools.com?subject=${subject}&body=${body}`, '_blank');
        }

        function requestFeature() {
            const subject = encodeURIComponent('💡 Sugestão de Nova Feature - Webeetools');
            const body = encodeURIComponent(`
Olá equipe Webeetools,

Tenho uma sugestão de nova funcionalidade:

💡 **Nome da Feature:**
[Nome ou título da funcionalidade]

📝 **Descrição Detalhada:**
[Explique detalhadamente como a funcionalidade deveria funcionar]

🎯 **Objetivo/Problema que Resolve:**
[Qual problema esta feature resolveria ou que benefício traria]

👥 **Público-Alvo:**
[Quem se beneficiaria desta funcionalidade]

🔧 **Funcionalidades Esperadas:**
- [Funcionalidade 1]
- [Funcionalidade 2]
- [Funcionalidade 3]

📱 **Plataformas:**
- [ ] Web (Desktop)
- [ ] Web (Mobile)
- [ ] API

🌟 **Prioridade (na sua opinião):**
- [ ] Baixa
- [ ] Média
- [ ] Alta
- [ ] Crítica

💭 **Informações Adicionais:**
[Qualquer informação adicional que possa ser útil]

Obrigado pela consideração!
            `);
            
            window.open(`mailto:contato@webeetools.com?subject=${subject}&body=${body}`, '_blank');
        }

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