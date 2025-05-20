<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webeetools - @yield('title')</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body class="min-h-screen flex flex-col bg-gray-50">
    <!-- Scroll Progress Bar -->
    <div id="scroll-progress" class="fixed top-0 left-0 z-50 h-1 bg-yellow-500" style="width: 0%;"></div>

    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-300" id="main-navbar">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center">
                            <img src="/images/logo-bee.png" alt="Logo Bee" class="h-40 w-auto">
                        </a>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8 mt-3">
                        <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 text-gray-900 hover:text-yellow-600 transition-colors duration-200 {{ Request::routeIs('home') ? 'text-yellow-600 border-b-2 border-yellow-600' : '' }}">Início</a>
                        {{-- <a href="{{ route('documentation') }}" class="inline-flex items-center px-1 pt-1 text-gray-900 hover:text-yellow-600 transition-colors duration-200 {{ Request::routeIs('documentation') ? 'text-yellow-600 border-b-2 border-yellow-600' : '' }}">Documentação</a> --}}
                        <a href="{{ route('support') }}" class="inline-flex items-center px-1 pt-1 text-gray-900 hover:text-yellow-600 transition-colors duration-200 {{ Request::routeIs('support') ? 'text-yellow-600 border-b-2 border-yellow-600' : '' }}">Suporte</a>
                         <a href="{{ route('suggestions') }}" class="inline-flex items-center px-1 pt-1 text-gray-900 hover:text-yellow-600 transition-colors duration-200 {{ Request::routeIs('suggestions') ? 'text-yellow-600 border-b-2 border-yellow-600' : '' }}">Sugestões</a>
                         <a href="{{ route('contact') }}" class="inline-flex items-center px-1 pt-1 text-gray-900 hover:text-yellow-600 transition-colors duration-200 {{ Request::routeIs('contact') ? 'text-yellow-600 border-b-2 border-yellow-600' : '' }}">Fale Conosco</a>
                    </div>
                </div>

                <!-- Right side: Search and Auth Links -->
                <div class="flex items-center ml-6">
                     <!-- Search Bar -->
                    <div class="relative mr-4">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fas fa-search text-gray-400"></i>
                        </span>
                        <input type="text" placeholder="Buscar..." class="w-64 py-2 pl-10 pr-4 text-sm text-gray-700 bg-gray-100 rounded-md focus:outline-none focus:bg-white focus:ring-2 focus:ring-yellow-500">
                    </div>
                    
                    <!-- Auth Links -->
                    <div class="flex items-center space-x-4">
                        @guest
                            <a href="{{ route('login') }}" class="text-gray-900 hover:text-yellow-600 transition-colors duration-200">Logar</a>
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-yellow-500 hover:bg-yellow-600 transition-colors duration-200">Criar Conta</a>
                        @endguest

                        {{-- Opcional: Adicionar link para o dashboard/perfil se o usuário estiver logado --}}
                        {{-- @auth
                            <a href="{{ route('dashboard') }}" class="text-gray-900 hover:text-yellow-600 transition-colors duration-200">Dashboard</a>
                        @endauth --}}
                    </div>
                </div>

            </div>
        </div>
    </nav>

    <!-- Conteúdo Principal -->
    <main class="flex-grow pt-24">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow-inner mt-8">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div class="text-gray-500 text-sm">
                    &copy; {{ date('Y') }} Webeetools. Todos os direitos reservados.
                </div>
                <div class="flex space-x-6">
                    <a href="{{ route('terms') }}" class="text-gray-500 hover:text-gray-700 text-sm">Termos de Uso</a>
                    <a href="{{ route('privacy') }}" class="text-gray-500 hover:text-gray-700 text-sm">Política de Privacidade</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('main-navbar');
            if (window.scrollY > 50) { // Ajuste o valor 50 conforme necessário para quando a navbar deve mudar
                navbar.classList.add('bg-white', 'shadow-lg');
            } else {
                navbar.classList.remove('bg-white', 'shadow-lg');
            }
        });
    </script>

    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/TextPlugin.min.js"></script>

    <!-- Canvas Confetti -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.2/dist/confetti.browser.min.js"></script>

    @stack('scripts')

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <script>
        // Script for Scroll Progress Bar
        window.addEventListener('scroll', function() {
            const scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
            const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (scrollTop / scrollHeight) * 100;
            document.getElementById('scroll-progress').style.width = scrolled + '%';
        });
    </script>

</body>
</html> 