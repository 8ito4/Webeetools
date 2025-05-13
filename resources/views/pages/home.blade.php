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
                    Central de ferramentas para desenvolvedores modernos
                </p>
                <div class="mt-10">
                    <a href="#tools" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-white hover:bg-indigo-50">
                        Ver Ferramentas
                    </a>
                </div>
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
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-6">
                        <div class="text-3xl text-indigo-600 mb-4">
                            <i class="fas fa-link"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Webhook Tester</h3>
                        <p class="mt-2 text-gray-500">Teste e depure seus webhooks facilmente</p>
                        <a href="{{ route('tools.webhook') }}" class="mt-4 inline-flex items-center text-indigo-600 hover:text-indigo-500">
                            Acessar ferramenta
                            <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- JSON Converter -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-6">
                        <div class="text-3xl text-indigo-600 mb-4">
                            <i class="fas fa-code"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Conversor JSON</h3>
                        <p class="mt-2 text-gray-500">Converta e valide seus dados JSON</p>
                        <a href="{{ route('tools.json') }}" class="mt-4 inline-flex items-center text-indigo-600 hover:text-indigo-500">
                            Acessar ferramenta
                            <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Password Generator -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-6">
                        <div class="text-3xl text-indigo-600 mb-4">
                            <i class="fas fa-key"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Gerador de Senha</h3>
                        <p class="mt-2 text-gray-500">Crie senhas fortes e seguras</p>
                        <a href="{{ route('tools.password') }}" class="mt-4 inline-flex items-center text-indigo-600 hover:text-indigo-500">
                            Acessar ferramenta
                            <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Base64 Encoder -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-6">
                        <div class="text-3xl text-indigo-600 mb-4">
                            <i class="fas fa-file-code"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Codificador Base64</h3>
                        <p class="mt-2 text-gray-500">Codifique e decodifique strings em Base64</p>
                        <a href="{{ route('tools.base64') }}" class="mt-4 inline-flex items-center text-indigo-600 hover:text-indigo-500">
                            Acessar ferramenta
                            <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- QR Code Generator -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-6">
                        <div class="text-3xl text-indigo-600 mb-4">
                            <i class="fas fa-qrcode"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Gerador de QR Code</h3>
                        <p class="mt-2 text-gray-500">Crie QR Codes personalizados</p>
                        <a href="{{ route('tools.qrcode') }}" class="mt-4 inline-flex items-center text-indigo-600 hover:text-indigo-500">
                            Acessar ferramenta
                            <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Email Validator -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-6">
                        <div class="text-3xl text-indigo-600 mb-4">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Validador de Email</h3>
                        <p class="mt-2 text-gray-500">Verifique a validade de endereços de email</p>
                        <a href="{{ route('tools.email') }}" class="mt-4 inline-flex items-center text-indigo-600 hover:text-indigo-500">
                            Acessar ferramenta
                            <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
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