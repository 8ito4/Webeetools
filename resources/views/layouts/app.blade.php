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
</head>
<body class="min-h-screen flex flex-col bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center">
                            <img src="/images/logo-bee.png" alt="Logo Bee" class="h-40 w-auto">
                        </a>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8 mt-3">
                        <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 text-gray-900 hover:text-indigo-600">Início</a>
                        <a href="{{ route('documentation') }}" class="inline-flex items-center px-1 pt-1 text-gray-900 hover:text-indigo-600">Documentação</a>
                        <a href="{{ route('support') }}" class="inline-flex items-center px-1 pt-1 text-gray-900 hover:text-indigo-600">Suporte</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Conteúdo Principal -->
    <main class="flex-grow">
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

    @stack('scripts')
</body>
</html> 