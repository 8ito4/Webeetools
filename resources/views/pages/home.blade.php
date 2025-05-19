@extends('layouts.app')

@section('title', 'Início')

@section('content')
    <!-- Hero Section -->
    <div class="bg-indigo-600">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold text-white sm:text-5xl sm:tracking-tight lg:text-6xl">
                    Bem-vindo à Webeetools
                </h1>
                <p class="mt-6 max-w-lg mx-auto text-xl text-indigo-100">
                    Central de ferramentas para desenvolvedores
                </p>
            </div>
        </div>
    </div>

    <!-- Tools Section -->
    <div id="tools" class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Nossas Ferramentas
                </h2>
                <p class="mt-4 text-lg text-gray-500">
                    Escolha entre nossa variedade de ferramentas para desenvolvedores
                </p>
            </div>

            <div class="mt-12 grid gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Webhook Tester -->
                <a href="{{ route('tools.webhook') }}" class="block bg-white overflow-hidden shadow rounded-lg hover:shadow-lg hover:scale-105 transition duration-300">
                    <div class="p-6">
                        <div class="text-3xl text-indigo-600 mb-4">
                            <i class="fas fa-link"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Webhook Tester</h3>
                        <p class="mt-2 text-gray-500">Teste e depure seus webhooks facilmente</p>
                    </div>
                </a>

                <!-- JSON Converter -->
                <a href="{{ route('tools.json') }}" class="block bg-white overflow-hidden shadow rounded-lg hover:shadow-lg hover:scale-105 transition duration-300">
                    <div class="p-6">
                        <div class="text-3xl text-indigo-600 mb-4">
                            <i class="fas fa-code"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Conversor JSON</h3>
                        <p class="mt-2 text-gray-500">Converta e valide seus dados JSON</p>
                    </div>
                </a>

                <!-- Password Generator -->
                <a href="{{ route('tools.password') }}" class="block bg-white overflow-hidden shadow rounded-lg hover:shadow-lg hover:scale-105 transition duration-300">
                    <div class="p-6">
                        <div class="text-3xl text-indigo-600 mb-4">
                            <i class="fas fa-key"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Gerador de Senha</h3>
                        <p class="mt-2 text-gray-500">Crie senhas fortes e seguras</p>
                    </div>
                </a>

                <!-- Pomodoro Timer -->
                <a href="{{ route('tools.pomodoro') }}" class="block bg-white overflow-hidden shadow rounded-lg hover:shadow-lg hover:scale-105 transition duration-300">
                    <div class="p-6">
                        <div class="text-3xl text-indigo-600 mb-4">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Pomodoro</h3>
                        <p class="mt-2 text-gray-500">Aumente sua produtividade com o método Pomodoro</p>
                    </div>
                </a>

                <!-- Cellphone Number Generator -->
                <a href="{{ route('tools.cellphone') }}" class="block bg-white overflow-hidden shadow rounded-lg hover:shadow-lg hover:scale-105 transition duration-300">
                    <div class="p-6">
                        <div class="text-3xl text-indigo-600 mb-4">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Gerador de Número de Celular</h3>
                        <p class="mt-2 text-gray-500">Gere números de celular válidos para testes</p>
                    </div>
                </a>

                <!-- Email Validator -->
                <a href="{{ route('tools.document') }}" class="block bg-white overflow-hidden shadow rounded-lg hover:shadow-lg hover:scale-105 transition duration-300">
                    <div class="p-6">
                        <div class="text-3xl text-indigo-600 mb-4">
                            <i class="fas fa-id-card"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Gerador de CPF/CNPJ</h3>
                        <p class="mt-2 text-gray-500">Gere documentos brasileiros válidos</p>
                    </div>
                </a>

                <!-- Planning Poker -->
                <a href="{{ route('planning-poker.index') }}" class="block bg-white overflow-hidden shadow rounded-lg hover:shadow-lg hover:scale-105 transition duration-300">
                    <div class="p-6">
                        <div class="text-3xl text-indigo-600 mb-4">
                            <i class="fas fa-layer-group"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Planning Poker</h3>
                        <p class="mt-2 text-gray-500">Faça estimativas ágeis em equipe de forma divertida</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- News Section -->
    <div class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-indigo-600 rounded-lg shadow-xl overflow-hidden">
                <div class="px-6 py-8 sm:p-10 sm:pb-6">
                    <div class="flex items-center justify-center">
                        <span class="flex items-center justify-center h-12 w-12 rounded-md bg-white">
                            <i class="fas fa-star text-indigo-600 text-2xl"></i>
                        </span>
                        <h3 class="ml-4 text-xl font-medium text-white">Nova: ferramenta de teste de webhook!</h3>
                    </div>
                    <div class="mt-4 text-center">
                        <p class="text-indigo-100">
                            Experimente nossa mais nova ferramenta para testar e depurar seus webhooks em tempo real.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 