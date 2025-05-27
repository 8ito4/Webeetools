@extends('layouts.modern')

@section('title', 'Testador de API - Webeetools')

@section('styles')
.api-input {
    background: rgba(15, 23, 42, 0.8);
    border: 1px solid rgba(71, 85, 105, 0.5);
    border-radius: 0.5rem;
    padding: 0.75rem;
    color: #f1f5f9;
    transition: all 0.3s ease;
    font-family: 'JetBrains Mono', monospace;
}

.api-input:focus {
    outline: none;
    border-color: var(--accent-400);
    box-shadow: 0 0 0 3px rgba(234, 179, 8, 0.1);
}

.api-select {
    background: rgba(15, 23, 42, 0.8);
    border: 1px solid rgba(71, 85, 105, 0.5);
    border-radius: 0.5rem;
    padding: 0.75rem;
    color: #f1f5f9;
    transition: all 0.3s ease;
}

.api-select:focus {
    outline: none;
    border-color: var(--accent-400);
    box-shadow: 0 0 0 3px rgba(234, 179, 8, 0.1);
}

.method-select {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    border-right: none;
    min-width: 100px;
}

.url-input {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    flex: 1;
}

.section-card {
    background: rgba(15, 23, 42, 0.4);
    border: 1px solid rgba(71, 85, 105, 0.3);
    border-radius: 0.75rem;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
}

.section-title {
    color: #e2e8f0;
    font-size: 1.125rem;
    font-weight: 600;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.param-row {
    display: flex;
    gap: 0.75rem;
    margin-bottom: 0.75rem;
    align-items: center;
}

.param-input {
    flex: 1;
}

.remove-btn {
    color: #ef4444;
    cursor: pointer;
    padding: 0.5rem;
    border-radius: 0.25rem;
    transition: all 0.3s ease;
}

.remove-btn:hover {
    background: rgba(239, 68, 68, 0.1);
    transform: scale(1.1);
}

.add-btn {
    color: var(--accent-400);
    cursor: pointer;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    padding: 0.5rem;
    border-radius: 0.25rem;
}

.add-btn:hover {
    background: rgba(234, 179, 8, 0.1);
    transform: translateX(4px);
}

.response-container {
    background: rgba(2, 6, 23, 0.8);
    border: 1px solid rgba(71, 85, 105, 0.5);
    border-radius: 0.5rem;
    padding: 1rem;
    min-height: 300px;
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.875rem;
    color: #d4d4d4;
    overflow: auto;
}

.tab-container {
    border-bottom: 1px solid rgba(71, 85, 105, 0.3);
    margin-bottom: 1rem;
}

.tab-button {
    padding: 0.75rem 1rem;
    color: #9ca3af;
    border-bottom: 2px solid transparent;
    transition: all 0.3s ease;
    cursor: pointer;
    font-weight: 500;
}

.tab-button.active {
    color: var(--accent-400);
    border-bottom-color: var(--accent-400);
}

.tab-button:hover {
    color: #e2e8f0;
}

.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.875rem;
    font-weight: 600;
}

.status-success {
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
    border: 1px solid rgba(16, 185, 129, 0.3);
}

.status-error {
    background: rgba(239, 68, 68, 0.1);
    color: #ef4444;
    border: 1px solid rgba(239, 68, 68, 0.3);
}

.status-warning {
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
    border: 1px solid rgba(245, 158, 11, 0.3);
}

.saved-request-card {
    background: rgba(15, 23, 42, 0.4);
    border: 1px solid rgba(71, 85, 105, 0.3);
    border-radius: 0.5rem;
    padding: 1rem;
    transition: all 0.3s ease;
    cursor: pointer;
}

.saved-request-card:hover {
    border-color: rgba(234, 179, 8, 0.3);
    background: rgba(15, 23, 42, 0.6);
    transform: translateY(-2px);
}

.loading-spinner {
    display: inline-block;
    width: 1rem;
    height: 1rem;
    border: 2px solid rgba(234, 179, 8, 0.3);
    border-radius: 50%;
    border-top-color: var(--accent-400);
    animation: spin 1s ease-in-out infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}
@endsection

@section('content')
<div class="tool-container">
    <div class="tool-header">
        <h1 class="tool-title">
            <i class="fas fa-plug" style="color: var(--accent-400); margin-right: 0.5rem;"></i>
            Testador de API
        </h1>
        <p class="tool-description">
            Teste e depure suas APIs com interface intuitiva
        </p>
    </div>

    <div class="tool-content">
        <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-bottom: 2rem;">
            <button id="saveRequestBtn" class="btn btn-secondary">
                <i class="fas fa-save"></i>
                Salvar Requisição
            </button>
            <button id="loadRequestBtn" class="btn btn-secondary">
                <i class="fas fa-folder-open"></i>
                Carregar Requisição
            </button>
        </div>

        <div class="grid grid-cols-2" style="gap: 2rem;">
            <!-- Request Configuration -->
            <div>
                <div class="section-card">
                    <h2 class="section-title">
                        <i class="fas fa-cog"></i>
                        Configuração da Requisição
                    </h2>
                    
                    <div class="form-group">
                        <label class="form-label">URL</label>
                        <div style="display: flex;">
                            <select id="method" class="api-select method-select">
                                <option value="GET">GET</option>
                                <option value="POST">POST</option>
                                <option value="PUT">PUT</option>
                                <option value="PATCH">PATCH</option>
                                <option value="DELETE">DELETE</option>
                            </select>
                            <input type="url" id="url" placeholder="https://api.exemplo.com/endpoint" class="api-input url-input">
                        </div>
                    </div>

                    <div class="form-group">
                        <h3 class="section-title">
                            <i class="fas fa-tags"></i>
                            Headers
                        </h3>
                        <div id="headers">
                            <div class="param-row">
                                <input type="text" placeholder="Key" class="api-input param-input">
                                <input type="text" placeholder="Value" class="api-input param-input">
                                <button class="remove-btn" title="Remover Header">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <button id="addHeaderBtn" class="add-btn">
                            <i class="fas fa-plus"></i>
                            Adicionar Header
                        </button>
                    </div>

                    <div class="form-group">
                        <h3 class="section-title">
                            <i class="fas fa-search"></i>
                            Query Parameters
                        </h3>
                        <div id="queryParams">
                            <div class="param-row">
                                <input type="text" placeholder="Key" class="api-input param-input">
                                <input type="text" placeholder="Value" class="api-input param-input">
                                <button class="remove-btn" title="Remover Parâmetro">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <button id="addQueryParamBtn" class="add-btn">
                            <i class="fas fa-plus"></i>
                            Adicionar Parâmetro
                        </button>
                    </div>

                    <div class="form-group">
                        <h3 class="section-title">
                            <i class="fas fa-file-alt"></i>
                            Request Body
                        </h3>
                        <div class="form-group">
                            <select id="bodyType" class="api-select">
                                <option value="none">None</option>
                                <option value="form">Form Data</option>
                                <option value="json">JSON</option>
                                <option value="text">Text</option>
                            </select>
                        </div>
                        
                        <div id="bodyContainer">
                            <div id="formBody" class="hidden">
                                <div class="param-row">
                                    <input type="text" placeholder="Key" class="api-input param-input">
                                    <input type="text" placeholder="Value" class="api-input param-input">
                                    <button class="remove-btn" title="Remover Campo">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <button id="addFormFieldBtn" class="add-btn">
                                    <i class="fas fa-plus"></i>
                                    Adicionar Campo
                                </button>
                            </div>

                            <div id="jsonBody" class="hidden">
                                <textarea id="jsonEditor" class="api-input" style="min-height: 200px; width: 100%; resize: vertical;" placeholder='{"key": "value"}'></textarea>
                            </div>

                            <div id="textBody" class="hidden">
                                <textarea id="textEditor" class="api-input" style="min-height: 200px; width: 100%; resize: vertical;" placeholder="Texto do corpo da requisição"></textarea>
                            </div>
                        </div>
                    </div>

                    <button id="sendBtn" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">
                        <i class="fas fa-paper-plane"></i>
                        Enviar Requisição
                    </button>
                </div>
            </div>

            <!-- Response -->
            <div>
                <div class="section-card">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <h2 class="section-title" style="margin-bottom: 0;">
                            <i class="fas fa-clipboard-list"></i>
                            Resposta
                        </h2>
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <span id="responseStatus" class="status-badge"></span>
                            <span id="responseTime" style="color: #9ca3af; font-size: 0.875rem;"></span>
                        </div>
                    </div>

                    <div class="tab-container">
                        <div style="display: flex;">
                            <button class="tab-button active" data-tab="body">Body</button>
                            <button class="tab-button" data-tab="headers">Headers</button>
                        </div>
                    </div>

                    <div id="responseBody" class="response-container">
                        <pre style="margin: 0; white-space: pre-wrap; color: #9ca3af;">Envie uma requisição para ver a resposta...</pre>
                    </div>

                    <div id="responseHeaders" class="response-container hidden">
                        <div style="color: #9ca3af;">Nenhum header de resposta ainda...</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Saved Requests -->
        <div class="section-card" style="margin-top: 2rem;">
            <h2 class="section-title">
                <i class="fas fa-bookmark"></i>
                Requisições Salvas
            </h2>
            <div id="savedRequests" class="grid grid-cols-1" style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1rem;">
                <div style="color: #9ca3af; text-align: center; padding: 2rem;">
                    Nenhuma requisição salva ainda...
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
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

    function addHeader(key = '', value = '') {
        const headerDiv = document.createElement('div');
        headerDiv.className = 'flex items-center space-x-2';
        headerDiv.innerHTML = `\n            <input type=\"text\" placeholder=\"Key\" value=\"${key}\" class=\"form-input flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm\" style=\"border: 1px solid #d1d5db !important; padding-left: 0.5rem !important;\">\n            <input type=\"text\" placeholder=\"Value\" value=\"${value}\" class=\"form-input flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm\" style=\"border: 1px solid #d1d5db !important; padding-left: 0.5rem !important;\">\n            <button type=\"button\" class=\"text-red-600 hover:text-red-900\" title=\"Remover Header\">\n                <svg class=\"w-5 h-5\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">\n                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>\n                </svg>\n            </button>\n        `;
        headersContainer.appendChild(headerDiv);

        const deleteBtn = headerDiv.querySelector('button');
        deleteBtn.addEventListener('click', () => headerDiv.remove());
    }

    function addQueryParam(key = '', value = '') {
        const paramDiv = document.createElement('div');
        paramDiv.className = 'flex items-center space-x-2';
        paramDiv.innerHTML = `\n            <input type=\"text\" placeholder=\"Key\" value=\"${key}\" class=\"form-input flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm\" style=\"border: 1px solid #d1d5db !important; padding-left: 0.5rem !important;\">\n            <input type=\"text\" placeholder=\"Value\" value=\"${value}\" class=\"form-input flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm\" style=\"border: 1px solid #d1d5db !important; padding-left: 0.5rem !important;\">\n            <button type=\"button\" class=\"text-red-600 hover:text-red-900\" title=\"Remover Parâmetro\">\n                <svg class=\"w-5 h-5\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">\n                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>\n                </svg>\n            </button>\n        `;
        queryParamsContainer.appendChild(paramDiv);

        const deleteBtn = paramDiv.querySelector('button');
        deleteBtn.addEventListener('click', () => paramDiv.remove());
    }

    function addFormField(key = '', value = '') {
        const fieldDiv = document.createElement('div');
        fieldDiv.className = 'flex items-center space-x-2';
        fieldDiv.innerHTML = `\n            <input type=\"text\" placeholder=\"Key\" value=\"${key}\" class=\"form-input flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm\" style=\"border: 1px solid #d1d5db !important; padding-left: 0.5rem !important;\">\n            <input type=\"text\" placeholder=\"Value\" value=\"${value}\" class=\"form-input flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm\" style=\"border: 1px solid #d1d5db !important; padding-left: 0.5rem !important;\">\n            <button type=\"button\" class=\"text-red-600 hover:text-red-900\" title=\"Remover Campo\">\n                <svg class=\"w-5 h-5\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">\n                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>\n                </svg>\n            </button>\n        `;
        formBody.insertBefore(fieldDiv, formBody.lastElementChild);

        const deleteBtn = fieldDiv.querySelector('button');
        deleteBtn.addEventListener('click', () => fieldDiv.remove());
    }

    function handleBodyTypeChange() {
        const type = bodyTypeSelect.value;
        formBody.classList.add('hidden');
        jsonBody.classList.add('hidden');
        textBody.classList.add('hidden');

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

    async function sendRequest() {
        const startTime = performance.now();
        const method = methodSelect.value;
        const url = urlInput.value;

        if (!url) {
            alert('Por favor, insira uma URL.');
            return;
        }

        const headers = {};
        headersContainer.querySelectorAll('> div').forEach(div => {
            const [keyInput, valueInput] = div.querySelectorAll('input[type="text"]');
            if (keyInput && valueInput && keyInput.value && valueInput.value) {
                headers[keyInput.value.trim()] = valueInput.value.trim();
            }
        });

        const queryParams = {};
        queryParamsContainer.querySelectorAll('> div').forEach(div => {
            const [keyInput, valueInput] = div.querySelectorAll('input[type="text"]');
            if (keyInput && valueInput && keyInput.value && valueInput.value) {
                queryParams[keyInput.value.trim()] = valueInput.value.trim();
            }
        });

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

        sendBtn.disabled = true;
        sendBtn.textContent = 'Enviando...';

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

    function saveRequest() {
        const method = methodSelect.value;
        const url = urlInput.value;
        
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

    function closeSaveModal() {
        saveRequestModal.classList.add('hidden');
        saveRequestModal.classList.remove('flex');
    }

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

    cancelSaveBtn.addEventListener('click', closeSaveModal);

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

    function loadRequest(id) {
        fetch(`/tools/api-tester/load/${id}`)
            .then(response => response.json())
            .then(data => {
                methodSelect.value = data.method;
                
                urlInput.value = data.url;
                
                headersContainer.innerHTML = '';
                Object.entries(data.headers || {}).forEach(([key, value]) => {
                    addHeader(key, value);
                });
                
                queryParamsContainer.innerHTML = '';
                Object.entries(data.query_params || {}).forEach(([key, value]) => {
                    addQueryParam(key, value);
                });
                
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

    closeLoadBtn.addEventListener('click', () => {
        loadRequestModal.classList.add('hidden');
        loadRequestModal.classList.remove('flex');
    });

    document.querySelectorAll('.tab-button').forEach(button => {
        button.addEventListener('click', () => {
            const tab = button.dataset.tab;
            
            document.querySelectorAll('.tab-button').forEach(btn => {
                btn.classList.remove('border-indigo-500', 'text-indigo-600');
                btn.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
            });
            
            button.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
            button.classList.add('border-indigo-500', 'text-indigo-600');

            responseBody.classList.add('hidden');
            responseHeaders.classList.add('hidden');

            if (tab === 'body') {
                responseBody.classList.remove('hidden');
            } else if (tab === 'headers') {
                responseHeaders.classList.remove('hidden');
            }
        });
    });


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

     addHeader(); // Add one empty header field on load
     addQueryParam(); // Add one empty query param field on load
    handleBodyTypeChange(); // Initialize body section visibility
    loadSavedRequests(); // Load saved requests on page load

     document.querySelector('.tab-button[data-tab="body"]').classList.add('border-indigo-500', 'text-indigo-600');
});
</script>
@endsection 