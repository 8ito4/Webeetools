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
                        <a href="{{ route('home') }}" class="text-2xl font-bold text-indigo-600">Webeetools</a>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 text-gray-900 hover:text-indigo-600">Início</a>
                        <div class="relative group">
                            <button class="inline-flex items-center px-1 pt-1 text-gray-900 hover:text-indigo-600">
                                Ferramentas
                                <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div class="absolute hidden group-hover:block w-48 bg-white shadow-lg py-1 rounded-md">
                                <a href="{{ route('tools.webhook') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">Webhook Tester</a>
                                <a href="{{ route('tools.json') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">Conversor JSON</a>
                                <a href="{{ route('tools.password') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">Gerador de Senha</a>
                                <a href="{{ route('tools.base64') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">Codificador Base64</a>
                                <a href="{{ route('tools.qrcode') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">Gerador de QR Code</a>
                                <a href="{{ route('tools.email') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">Validador de Email</a>
                                <a href="{{ route('tools.sha256') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">Criptografia SHA256</a>
                                <a href="{{ route('tools.xml') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">Formatador de XML</a>
                            </div>
                        </div>
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