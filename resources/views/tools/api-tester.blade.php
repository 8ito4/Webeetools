@extends('layouts.app')

@section('title', 'API Tester')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">API Tester</h1>
            <p class="mt-2 text-sm text-gray-600">Teste e faça requisições HTTP facilmente</p>
        </div>
        <div class="flex space-x-3">
            <button id="saveRequestBtn" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                </svg>
                Salvar Requisição
            </button>
            <button id="loadRequestBtn" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                </svg>
                Carregar Requisição
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Request Panel -->
        <div class="bg-white rounded-lg shadow-lg p-6 border border-gray-100">
            <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Configuração da Requisição
            </h2>
            <div class="space-y-6">
                <!-- Método e URL -->
                <div>
                    <label for="url" class="block text-sm font-medium text-gray-700 mb-1">URL</label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <select id="method" class="focus:ring-indigo-500 focus:border-indigo-500 flex-none w-24 block rounded-l-md sm:text-sm border-gray-300 bg-gray-50" style="border: 1px solid #d1d5db !important; padding-left: 0.5rem !important;">
                            <option value="GET">GET</option>
                            <option value="POST">POST</option>
                            <option value="PUT">PUT</option>
                            <option value="PATCH">PATCH</option>
                            <option value="DELETE">DELETE</option>
                        </select>
                        <input type="url" id="url" placeholder="https://api.exemplo.com/endpoint" 
                            class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" style="border: 1px solid #d1d5db !important; padding-left: 0.5rem !important;">
                    </div>
                </div>

                <!-- Headers -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        Headers
                    </h3>
                    <div id="headers" class="space-y-2 bg-gray-50 p-3 rounded-lg">
                        <div class="flex space-x-2">
                            <input type="text" placeholder="Key" class="form-input flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" style="border: 1px solid #d1d5db !important; padding-left: 0.5rem !important;">
                            <input type="text" placeholder="Value" class="form-input flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" style="border: 1px solid #d1d5db !important; padding-left: 0.5rem !important;">
                            <button class="text-red-600 hover:text-red-900 transition-colors duration-200" title="Remover Header">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <button id="addHeaderBtn" class="mt-2 text-indigo-600 hover:text-indigo-900 flex items-center text-sm font-medium transition-colors duration-200">
                        <svg class="-ml-1 mr-1 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Adicionar Header
                    </button>
                </div>

                <!-- Query Parameters -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Query Parameters
                    </h3>
                    <div id="queryParams" class="space-y-2 bg-gray-50 p-3 rounded-lg">
                        <div class="flex space-x-2">
                            <input type="text" placeholder="Key" class="form-input flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" style="border: 1px solid #d1d5db !important; padding-left: 0.5rem !important;">
                            <input type="text" placeholder="Value" class="form-input flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" style="border: 1px solid #d1d5db !important; padding-left: 0.5rem !important;">
                            <button class="text-red-600 hover:text-red-900 transition-colors duration-200" title="Remover Parâmetro">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <button id="addQueryParamBtn" class="mt-2 text-indigo-600 hover:text-indigo-900 flex items-center text-sm font-medium transition-colors duration-200">
                        <svg class="-ml-1 mr-1 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Adicionar Parâmetro
                    </button>
                </div>

                <!-- Request Body -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Request Body
                    </h3>
                    <div class="mb-4">
                        <select id="bodyType" class="form-select rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-gray-50" style="border: 1px solid #d1d5db !important; padding-left: 0.5rem !important;">
                            <option value="none">None</option>
                            <option value="form">Form Data</option>
                            <option value="json">JSON</option>
                            <option value="text">Text</option>
                        </select>
                    </div>
                    <div id="bodyContainer" class="bg-gray-50 p-3 rounded-lg">
                        <!-- Form Data -->
                        <div id="formBody" class="space-y-2 hidden">
                            <div class="flex space-x-2">
                                <input type="text" placeholder="Key" class="form-input flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" style="border: 1px solid #d1d5db !important; padding-left: 0.5rem !important;">
                                <input type="text" placeholder="Value" class="form-input flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" style="border: 1px solid #d1d5db !important; padding-left: 0.5rem !important;">
                                <button class="text-red-600 hover:text-red-900 transition-colors duration-200" title="Remover Campo">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                            <button id="addFormFieldBtn" class="mt-2 text-indigo-600 hover:text-indigo-900 flex items-center text-sm font-medium transition-colors duration-200">
                                <svg class="-ml-1 mr-1 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Adicionar Campo
                            </button>
                        </div>

                        <!-- JSON -->
                        <div id="jsonBody" class="hidden">
                            <textarea id="jsonEditor" class="form-textarea w-full h-48 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 font-mono text-sm" style="border: 1px solid #d1d5db !important; padding-left: 0.5rem !important;"></textarea>
                        </div>

                        <!-- Text -->
                        <div id="textBody" class="hidden">
                            <textarea id="textEditor" class="form-textarea w-full h-48 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" style="border: 1px solid #d1d5db !important; padding-left: 0.5rem !important;"></textarea>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                     <button id="sendBtn" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                        <svg class="-ml-1 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                        Enviar Requisição
                    </button>
                </div>
            </div>
        </div>

        <!-- Response Panel -->
        <div class="bg-white rounded-lg shadow-lg p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    Resposta
                </h2>
                <div class="flex items-center space-x-2">
                    <span id="responseStatus" class="px-3 py-1 rounded-full text-sm font-medium"></span>
                    <span id="responseTime" class="text-gray-500 text-sm"></span>
                </div>
            </div>

            <div class="mb-4 border-b border-gray-200">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    <button class="tab-button text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200" data-tab="body">Body</button>
                    <button class="tab-button text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200" data-tab="headers">Headers</button>
                </nav>
            </div>

            <div id="responseBody" class="bg-gray-50 rounded-lg p-4 overflow-x-auto">
                <pre class="text-sm font-mono whitespace-pre-wrap text-gray-800"></pre>
            </div>

            <div id="responseHeaders" class="hidden bg-gray-50 rounded-lg p-4 overflow-x-auto">
                <div class="space-y-2 text-sm text-gray-800"></div>
            </div>
        </div>
    </div>

    <!-- Requisições Salvas -->
    <div class="mt-8 bg-white rounded-lg shadow-lg p-6 border border-gray-100">
        <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
            <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
            </svg>
            Requisições Salvas
        </h2>
        <div id="savedRequests" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- As requisições salvas serão carregadas aqui via JavaScript -->
        </div>
    </div>
</div>

<!-- Save Request Modal -->
<div id="saveRequestModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center px-4 py-6 z-50">
    <div class="relative bg-white rounded-lg p-6 shadow-xl w-full max-w-md">
        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
            </svg>
            Salvar Requisição
        </h3>
        <div class="space-y-4">
            <div>
                <label for="requestName" class="block text-sm font-medium text-gray-700">Nome</label>
                <input type="text" id="requestName" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm" style="border: 1px solid #d1d5db !important; padding-left: 0.5rem !important;">
            </div>
            <div>
                <label for="requestDescription" class="block text-sm font-medium text-gray-700">Descrição (Opcional)</label>
                <textarea id="requestDescription"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm" style="border: 1px solid #d1d5db !important; padding-left: 0.5rem !important;"></textarea>
            </div>
        </div>
        <div class="mt-6 flex justify-end space-x-3">
            <button type="button" id="cancelSaveBtn" class="px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">Cancelar</button>
            <button type="button" id="confirmSaveBtn" class="inline-flex justify-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">Salvar</button>
        </div>
    </div>
</div>

<!-- Load Request Modal -->
<div id="loadRequestModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center px-4 py-6 z-50">
    <div class="relative bg-white rounded-lg p-6 shadow-xl w-full max-w-2xl">
        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
            </svg>
            Carregar Requisição
        </h3>
        <div class="space-y-4">
            <div class="max-h-96 overflow-y-auto border border-gray-200 rounded-md p-2">
                <div id="savedRequestsList" class="space-y-3">
                    <!-- Saved requests will be listed here -->
                </div>
            </div>
        </div>
        <div class="mt-6 flex justify-end">
            <button type="button" id="closeLoadBtn" class="px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">Fechar</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const methodSelect = document.getElementById('method');
    const urlInput = document.getElementById('url');
    const sendBtn = document.getElementById('sendBtn');
    const headersContainer = document.getElementById('headers');
    const addHeaderBtn = document.getElementById('addHeaderBtn');
    const queryParamsContainer = document.getElementById('queryParams');
    const addQueryParamBtn = document.getElementById('addQueryParamBtn');
    const bodyTypeSelect = document.getElementById('bodyType');
    const formBody = document.getElementById('formBody');
    const jsonBody = document.getElementById('jsonBody');
    const textBody = document.getElementById('textBody');
    const jsonEditor = document.getElementById('jsonEditor');
    const textEditor = document.getElementById('textEditor');
    const responseStatus = document.getElementById('responseStatus');
    const responseTime = document.getElementById('responseTime');
    const responseBody = document.getElementById('responseBody');
    const responseHeaders = document.getElementById('responseHeaders');
    const saveRequestBtn = document.getElementById('saveRequestBtn');
    const loadRequestBtn = document.getElementById('loadRequestBtn');
    const saveRequestModal = document.getElementById('saveRequestModal');
    const loadRequestModal = document.getElementById('loadRequestModal');
    const requestName = document.getElementById('requestName');
    const requestDescription = document.getElementById('requestDescription');
    const confirmSaveBtn = document.getElementById('confirmSaveBtn');
    const cancelSaveBtn = document.getElementById('cancelSaveBtn');
    const closeLoadBtn = document.getElementById('closeLoadBtn');
    const savedRequestsList = document.getElementById('savedRequestsList');

    // Add Header
    function addHeader(key = '', value = '') {
        const headerDiv = document.createElement('div');
        headerDiv.className = 'flex items-center space-x-2';
        headerDiv.innerHTML = `\n            <input type=\"text\" placeholder=\"Key\" value=\"${key}\" class=\"form-input flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm\" style=\"border: 1px solid #d1d5db !important; padding-left: 0.5rem !important;\">\n            <input type=\"text\" placeholder=\"Value\" value=\"${value}\" class=\"form-input flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm\" style=\"border: 1px solid #d1d5db !important; padding-left: 0.5rem !important;\">\n            <button type=\"button\" class=\"text-red-600 hover:text-red-900\" title=\"Remover Header\">\n                <svg class=\"w-5 h-5\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">\n                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>\n                </svg>\n            </button>\n        `;
        headersContainer.appendChild(headerDiv);

        const deleteBtn = headerDiv.querySelector('button');
        deleteBtn.addEventListener('click', () => headerDiv.remove());
    }

    // Add Query Parameter
    function addQueryParam(key = '', value = '') {
        const paramDiv = document.createElement('div');
        paramDiv.className = 'flex items-center space-x-2';
        paramDiv.innerHTML = `\n            <input type=\"text\" placeholder=\"Key\" value=\"${key}\" class=\"form-input flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm\" style=\"border: 1px solid #d1d5db !important; padding-left: 0.5rem !important;\">\n            <input type=\"text\" placeholder=\"Value\" value=\"${value}\" class=\"form-input flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm\" style=\"border: 1px solid #d1d5db !important; padding-left: 0.5rem !important;\">\n            <button type=\"button\" class=\"text-red-600 hover:text-red-900\" title=\"Remover Parâmetro\">\n                <svg class=\"w-5 h-5\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">\n                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>\n                </svg>\n            </button>\n        `;
        queryParamsContainer.appendChild(paramDiv);

        const deleteBtn = paramDiv.querySelector('button');
        deleteBtn.addEventListener('click', () => paramDiv.remove());
    }

    // Add Form Field
    function addFormField(key = '', value = '') {
        const fieldDiv = document.createElement('div');
        fieldDiv.className = 'flex items-center space-x-2';
        fieldDiv.innerHTML = `\n            <input type=\"text\" placeholder=\"Key\" value=\"${key}\" class=\"form-input flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm\" style=\"border: 1px solid #d1d5db !important; padding-left: 0.5rem !important;\">\n            <input type=\"text\" placeholder=\"Value\" value=\"${value}\" class=\"form-input flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm\" style=\"border: 1px solid #d1d5db !important; padding-left: 0.5rem !important;\">\n            <button type=\"button\" class=\"text-red-600 hover:text-red-900\" title=\"Remover Campo\">\n                <svg class=\"w-5 h-5\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">\n                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>\n                </svg>\n            </button>\n        `;
        formBody.insertBefore(fieldDiv, formBody.lastElementChild);

        const deleteBtn = fieldDiv.querySelector('button');
        deleteBtn.addEventListener('click', () => fieldDiv.remove());
    }

    // Handle Body Type Change
    function handleBodyTypeChange() {
        const type = bodyTypeSelect.value;
        formBody.classList.add('hidden');
        jsonBody.classList.add('hidden');
        textBody.classList.add('hidden');

        // Clear previous body content when changing type
        formBody.innerHTML = ''; // Clear form fields (except the add button)
        const addFormFieldBtn = document.createElement('button');
        addFormFieldBtn.id = 'addFormFieldBtn';
        addFormFieldBtn.type = 'button';
        addFormFieldBtn.className = 'mt-2 text-indigo-600 hover:text-indigo-900 flex items-center text-sm font-medium';
        addFormFieldBtn.innerHTML = `
            <svg class="-ml-1 mr-1 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Adicionar Campo
        `;
         addFormFieldBtn.addEventListener('click', () => addFormField());
        formBody.appendChild(addFormFieldBtn);
        jsonEditor.value = '';
        textEditor.value = '';

        if (type === 'form') {
            formBody.classList.remove('hidden');
             addFormField(); // Add one empty field by default
        } else if (type === 'json') {
            jsonBody.classList.remove('hidden');
        } else if (type === 'text') {
            textBody.classList.remove('hidden');
        }
    }

    // Send Request
    async function sendRequest() {
        const startTime = performance.now();
        const method = methodSelect.value;
        const url = urlInput.value;

        // Basic URL validation
        if (!url) {
            alert('Por favor, insira uma URL.');
            return;
        }

        // Coletar headers
        const headers = {};
        headersContainer.querySelectorAll('> div').forEach(div => {
            const [keyInput, valueInput] = div.querySelectorAll('input[type="text"]');
            if (keyInput && valueInput && keyInput.value && valueInput.value) {
                headers[keyInput.value.trim()] = valueInput.value.trim();
            }
        });

        // Coletar query parameters
        const queryParams = {};
        queryParamsContainer.querySelectorAll('> div').forEach(div => {
            const [keyInput, valueInput] = div.querySelectorAll('input[type="text"]');
            if (keyInput && valueInput && keyInput.value && valueInput.value) {
                queryParams[keyInput.value.trim()] = valueInput.value.trim();
            }
        });

        // Preparar request body
        let body = null;
        const bodyType = bodyTypeSelect.value;

        if (bodyType === 'form') {
            body = {};
            formBody.querySelectorAll('> div').forEach(div => {
                 const [keyInput, valueInput] = div.querySelectorAll('input[type="text"]');
                 if (keyInput && valueInput && keyInput.value && valueInput.value) {
                    body[keyInput.value.trim()] = valueInput.value.trim();
                }
            });
        } else if (bodyType === 'json') {
            try {
                const jsonValue = jsonEditor.value.trim();
                if (jsonValue) {
                     body = JSON.parse(jsonValue);
                }
            } catch (e) {
                alert('JSON inválido: ' + e.message);
                return;
            }
        } else if (bodyType === 'text') {
            body = textEditor.value;
        }

        // Desabilitar botão de enviar e mostrar feedback (opcional)
        sendBtn.disabled = true;
        sendBtn.textContent = 'Enviando...';

        // Limpar resultados anteriores
        responseStatus.textContent = '';
        responseTime.textContent = '';
        responseBody.querySelector('pre').textContent = '';
        responseHeaders.querySelector('div').innerHTML = '';
        responseStatus.className = 'px-3 py-1 rounded-full text-sm font-medium'; // Reset classes
        document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('border-indigo-500', 'text-indigo-600', 'border-gray-300', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300', 'text-gray-700')); // Reset tab styles
         document.querySelector('.tab-button[data-tab="body"]').classList.add('border-indigo-500', 'text-indigo-600'); // Default to Body tab style
         responseBody.classList.remove('hidden');
         responseHeaders.classList.add('hidden');

        try {
            const response = await fetch('/api/tools/api-tester/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    method,
                    url,
                    headers,
                    queryParams,
                    bodyType,
                    body
                })
            });

            const data = await response.json();
            const endTime = performance.now();

            // Update response UI
            if (data.status) {
                 responseStatus.textContent = `Status: ${data.status}`;
                 responseStatus.className = `px-3 py-1 rounded-full text-sm font-medium ${
                     data.status >= 200 && data.status < 300 ? 'bg-green-100 text-green-800' :
                     data.status >= 400 ? 'bg-red-100 text-red-800' :
                     'bg-yellow-100 text-yellow-800'
                 }`;
             } else if (data.error) {
                  responseStatus.textContent = 'Erro';
                  responseStatus.className = 'px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800';
             }
            
            responseTime.textContent = `${Math.round(endTime - startTime)}ms`;

            // Update response body
            if (data.body) {
                 try {
                     const json = JSON.parse(data.body);
                     responseBody.querySelector('pre').textContent = JSON.stringify(json, null, 2);
                 } catch {
                     responseBody.querySelector('pre').textContent = data.body;
                 }
            } else if (data.error) {
                 responseBody.querySelector('pre').textContent = 'Erro: ' + data.error;
            }
            

            // Update response headers
            if (data.headers) {
                 const headersHtml = Object.entries(data.headers)
                     .map(([key, value]) => `
                         <div class="flex justify-between py-1">
                             <span class="font-medium text-gray-900">${key}:</span>
                             <span class="text-gray-600">${Array.isArray(value) ? value.join(', ') : value}</span>
                         </div>
                     `).join('');
                 responseHeaders.querySelector('div').innerHTML = headersHtml;
             }

        } catch (error) {
            console.error('Error:', error);
            responseStatus.textContent = 'Erro na Requisição';
            responseStatus.className = 'px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800';
            responseBody.querySelector('pre').textContent = 'Ocorreu um erro ao enviar a requisição.' + error;
        } finally {
            sendBtn.disabled = false;
            sendBtn.textContent = 'Enviar Requisição';
        }
    }

    // Save Request
    function saveRequest() {
        // Preencher campos do modal com dados da requisição atual
        const method = methodSelect.value;
        const url = urlInput.value;
        
        // Gerar um nome padrão se a URL existir
        if (url) {
            try {
                 const urlObj = new URL(url);
                 requestName.value = `${method} ${urlObj.pathname}`;
            } catch (e) {
                 requestName.value = `${method} ${url}`;
            }
        } else {
             requestName.value = '';
        }
        requestDescription.value = ''; // Clear description

        saveRequestModal.classList.remove('hidden');
        saveRequestModal.classList.add('flex');
    }

    // Close Save Request Modal
    function closeSaveModal() {
        saveRequestModal.classList.add('hidden');
        saveRequestModal.classList.remove('flex');
    }

    // Confirm Save Request
    confirmSaveBtn.addEventListener('click', async () => {
        const name = requestName.value.trim();
        const description = requestDescription.value.trim();

        if (!name) {
            alert('Por favor, insira um nome para a requisição.');
            return;
        }

        const requestData = {
            name,
            description,
            method: methodSelect.value,
            url: urlInput.value.trim(),
            headers: getHeaders(),
            queryParams: getQueryParams(),
            bodyType: bodyTypeSelect.value,
            body: getBody()
        };

        try {
            const response = await fetch('{{ route("tools.api-tester.save") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(requestData)
            });

            if (response.ok) {
                closeSaveModal();
                loadSavedRequests(); // Recarregar a lista de requisições salvas
                alert('Requisição salva com sucesso!');
            } else {
                 const errorData = await response.json();
                 alert('Erro ao salvar requisição: ' + (errorData.message || response.statusText));
            }
        } catch (error) {
            console.error('Erro ao salvar requisição:', error);
            alert('Ocorreu um erro ao salvar a requisição.');
        }
    });

    // Cancel Save Request
    cancelSaveBtn.addEventListener('click', closeSaveModal);

    // Load saved requests
    function loadSavedRequests() {
        fetch('{{ route('tools.api-tester.list') }}')
            .then(response => response.json())
            .then(data => {
                const savedRequestsList = document.getElementById('savedRequestsList');
                savedRequestsList.innerHTML = '';
                
                data.forEach(request => {
                    const requestElement = document.createElement('div');
                    requestElement.className = 'p-3 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer';
                    requestElement.innerHTML = `
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="font-medium text-gray-900">${request.name}</h4>
                                <p class="text-sm text-gray-500">${request.description || ''}</p>
                            </div>
                            <div class="flex space-x-2">
                                <button class="text-indigo-600 hover:text-indigo-900 load-request" data-id="${request.id}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                </button>
                                <button class="text-red-600 hover:text-red-900 delete-request" data-id="${request.id}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    `;
                    savedRequestsList.appendChild(requestElement);
                });

                // Add event listeners for load and delete buttons
                document.querySelectorAll('.load-request').forEach(button => {
                    button.addEventListener('click', (e) => {
                        e.stopPropagation();
                        const requestId = button.dataset.id;
                        loadRequest(requestId);
                    });
                });

                document.querySelectorAll('.delete-request').forEach(button => {
                    button.addEventListener('click', (e) => {
                        e.stopPropagation();
                        const requestId = button.dataset.id;
                        deleteRequest(requestId);
                    });
                });
            })
            .catch(error => {
                console.error('Error loading saved requests:', error);
                showNotification('Erro ao carregar requisições salvas', 'error');
            });
    }

    // Load a specific request
    function loadRequest(id) {
        fetch(`/tools/api-tester/load/${id}`)
            .then(response => response.json())
            .then(data => {
                // Set method
                methodSelect.value = data.method;
                
                // Set URL
                urlInput.value = data.url;
                
                // Set headers
                headersContainer.innerHTML = '';
                Object.entries(data.headers || {}).forEach(([key, value]) => {
                    addHeader(key, value);
                });
                
                // Set query parameters
                queryParamsContainer.innerHTML = '';
                Object.entries(data.query_params || {}).forEach(([key, value]) => {
                    addQueryParam(key, value);
                });
                
                // Set body
                if (data.body) {
                    bodyTypeSelect.value = data.body_type;
                    updateBodyType();
                    
                    if (data.body_type === 'json') {
                        jsonEditor.value = typeof data.body === 'string' ? data.body : JSON.stringify(data.body, null, 2);
                    } else if (data.body_type === 'text') {
                        textEditor.value = data.body;
                    } else if (data.body_type === 'form') {
                        formBody.innerHTML = '';
                        Object.entries(data.body).forEach(([key, value]) => {
                            addFormField(key, value);
                        });
                    }
                }
                
                loadRequestModal.classList.add('hidden');
                showNotification('Requisição carregada com sucesso', 'success');
            })
            .catch(error => {
                console.error('Error loading request:', error);
                showNotification('Erro ao carregar requisição', 'error');
            });
    }

    // Delete Request
    async function deleteRequest(id) {
        if (!confirm('Tem certeza que deseja excluir esta requisição?')) return;

        try {
            const response = await fetch(`/tools/api-tester/delete/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            if (response.ok) {
                loadSavedRequests(); // Recarregar a lista após exclusão
                alert('Requisição excluída com sucesso!');
            } else {
                 const errorData = await response.json();
                 alert('Erro ao excluir requisição: ' + (errorData.message || response.statusText));
            }
        } catch (error) {
            console.error('Erro ao excluir requisição:', error);
            alert('Ocorreu um erro ao excluir a requisição.');
        }
    }

    // Close Load Request Modal
    closeLoadBtn.addEventListener('click', () => {
        loadRequestModal.classList.add('hidden');
        loadRequestModal.classList.remove('flex');
    });

    // Response tabs functionality
    document.querySelectorAll('.tab-button').forEach(button => {
        button.addEventListener('click', () => {
            const tab = button.dataset.tab;
            
            // Remove active styles from all tabs
            document.querySelectorAll('.tab-button').forEach(btn => {
                btn.classList.remove('border-indigo-500', 'text-indigo-600');
                btn.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
            });
            
            // Add active styles to the clicked tab
            button.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
            button.classList.add('border-indigo-500', 'text-indigo-600');

            // Hide all tab content
            responseBody.classList.add('hidden');
            responseHeaders.classList.add('hidden');

            // Show the content for the clicked tab
            if (tab === 'body') {
                responseBody.classList.remove('hidden');
            } else if (tab === 'headers') {
                responseHeaders.classList.remove('hidden');
            }
        });
    });


    // Funções auxiliares para coletar dados
    function getHeaders() {
        const headers = {};
        headersContainer.querySelectorAll('> div').forEach(div => {
             const [keyInput, valueInput] = div.querySelectorAll('input[type="text"]');
             if (keyInput && valueInput && keyInput.value.trim() && valueInput.value.trim()) {
                 headers[keyInput.value.trim()] = valueInput.value.trim();
             }
         });
         return headers;
    }

    function getQueryParams() {
        const params = {};
        queryParamsContainer.querySelectorAll('> div').forEach(div => {
             const [keyInput, valueInput] = div.querySelectorAll('input[type="text"]');
             if (keyInput && valueInput && keyInput.value.trim() && valueInput.value.trim()) {
                 params[keyInput.value.trim()] = valueInput.value.trim();
             }
         });
         return params;
    }

    function getBody() {
        const bodyType = bodyTypeSelect.value;
        switch(bodyType) {
            case 'form':
                const formData = {};
                formBody.querySelectorAll('> div').forEach(div => {
                    const [keyInput, valueInput] = div.querySelectorAll('input[type="text"]');
                     if (keyInput && valueInput && keyInput.value.trim() && valueInput.value.trim()) {
                         formData[keyInput.value.trim()] = valueInput.value.trim();
                     }
                });
                return formData;
            case 'json':
                try {
                    const jsonValue = jsonEditor.value.trim();
                    return jsonValue ? JSON.parse(jsonValue) : null;
                } catch {
                    return null; // Return null or empty object on invalid JSON?
                }
            case 'text':
                return textEditor.value.trim();
            default:
                return null;
        }
    }

    // Initial setup
     addHeader(); // Add one empty header field on load
     addQueryParam(); // Add one empty query param field on load
    handleBodyTypeChange(); // Initialize body section visibility
    loadSavedRequests(); // Load saved requests on page load

    // Set initial active tab style
     document.querySelector('.tab-button[data-tab="body"]').classList.add('border-indigo-500', 'text-indigo-600');
});
</script>
@endpush
@endsection 