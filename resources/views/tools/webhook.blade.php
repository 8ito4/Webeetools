@extends('layouts.app')

@section('title', 'Webhook Tester')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">

        @if(isset($webhook) && $webhook)
            {{-- Conteúdo exibido após a criação do webhook --}}
            <h1 class="text-4xl font-extrabold text-gray-900 mb-4">
                Tudo pronto!
            </h1>

            <p class="mt-2 text-lg text-gray-700 mb-8">
                Seu servidor está pronto! Copie a URL abaixo e insira-a no seu aplicativo como URL base.
            </p>

            <!-- URL única gerada (minimalista) -->
            <div class="mb-8 flex items-center justify-center gap-2">
                <div class="bg-green-50 border border-green-100 rounded-lg px-4 py-3 flex items-center gap-3 flex-grow">
                    <span id="webhookUrl" class="font-mono text-base text-gray-700 break-all truncate">https://{{ $webhook->name }}.webeetools.com/api/webhook/{{ $webhook->token }}</span>
                    <button onclick="copyToClipboard()" class="p-2 rounded hover:bg-green-100 transition" title="Copiar URL">
                        <i class="far fa-copy text-gray-600"></i>
                    </button>
                </div>

                {{-- Botão para excluir/gerar novo webhook --}}
                <form id="delete-webhook-form" action="{{ route('tools.webhook.delete') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <button onclick="event.preventDefault(); document.getElementById('delete-webhook-form').submit();" class="p-3 rounded-lg hover:bg-gray-200 transition flex items-center justify-center" title="Gerar Novo Webhook">
                    <i class="fas fa-sync-alt text-gray-500"></i>
                </button>
            </div>

            {{-- Animação de espera (pulso) e texto --}}
            <div class="flex flex-col items-center justify-center mt-8">
                <div class="relative flex h-5 w-5 mb-4">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-gray-400 opacity-75" style="animation-duration: 3s"></span>
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-gray-400 opacity-75" style="animation-delay: 1.5s; animation-duration: 3s"></span>
                    <span class="relative inline-flex rounded-full h-5 w-5 bg-gray-500"></span>
                </div>
                <p class="text-xl font-semibold text-gray-700">Pronto e esperando!</p>
                <p class="text-gray-600 mt-2">
                    Dispare suas solicitações HTTP ou API.
                </p>
            </div>

            {{-- Lista de requisições individuais --}}
            <div class="mt-12 bg-white shadow rounded-lg text-left overflow-hidden">
                @forelse($requests as $request)
                    <div class="border-b border-gray-200 last:border-b-0" x-data="{ requestOpen: false }">
                        {{-- Header da requisição individual --}}
                        <button @click="requestOpen = !requestOpen" class="w-full flex items-center justify-between p-4 focus:outline-none hover:bg-gray-100 transition">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $request['method'] === 'GET' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ $request['method'] }}
                            </span>
                            <span class="text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($request['created_at'])->format('d/m/Y H:i:s') }}
                            </span>
                            <svg :class="{'transform rotate-180': requestOpen}" class="h-4 w-4 text-gray-500 transition-transform duration-200 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        {{-- Detalhes da requisição individual --}}
                        <div x-show="requestOpen" x-transition class="px-4 pb-4 bg-white">
                            <div class="mt-2">
                                <div class="mb-2">
                                    <h4 class="text-sm font-medium text-gray-700">Headers:</h4>
                                    <pre class="mt-1 text-sm text-gray-600 bg-gray-100 p-2 rounded">{{ json_encode($request['headers'], JSON_PRETTY_PRINT) }}</pre>
                                </div>
                                @if(!empty($request['query_parameters']))
                                <div class="mb-2">
                                    <h4 class="text-sm font-medium text-gray-700">Query Parameters:</h4>
                                    <pre class="mt-1 text-sm text-gray-600 bg-gray-100 p-2 rounded">{{ json_encode($request['query_parameters'], JSON_PRETTY_PRINT) }}</pre>
                                </div>
                                @endif
                                @if(!empty($request['body']))
                                    <div class="mb-2">
                                        <h4 class="text-sm font-medium text-gray-700">Body:</h4>
                                        <pre class="mt-1 text-sm text-gray-600 bg-gray-100 p-2 rounded">{{ json_encode($request['body'], JSON_PRETTY_PRINT) }}</pre>
                                    </div>
                                @endif
                                <div class="text-sm text-gray-500">
                                    IP: {{ $request['ip_address'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-4 text-center text-gray-500">
                        Nenhuma requisição recebida ainda
                    </div>
                @endforelse
            </div>

        @else
            {{-- Conteúdo exibido antes da criação do webhook --}}
            <h1 class="text-3xl font-extrabold text-gray-900 mb-8">
                Inicie um servidor simulado agora!
            </h1>

            <form method="POST" action="{{ route('tools.webhook.create') }}" class="flex flex-col items-center gap-4">
                @csrf
                <div class="flex items-center bg-white rounded-lg shadow overflow-hidden max-w-md">
                    <input type="text" name="project_name" required class="flex-1 px-4 py-3 text-gray-700 leading-tight focus:outline-none" placeholder="Nome do Projeto">
                    <span class="px-4 py-3 bg-gray-100 text-gray-600 font-mono text-sm">.webeetools.com</span>
                </div>
                <p class="text-gray-600 text-sm mt-2 mb-4">
                    Um subdomínio será criado onde você poderá enviar solicitações HTTP ou API.
                </p>
                <button type="submit" class="w-full max-w-xs bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition flex items-center justify-center gap-2">
                    <i class="fas fa-rocket"></i> Criar servidor simulado
                </button>
            </form>
        @endif
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
// Script para limpar a sessão do webhook ao sair da página
window.addEventListener('beforeunload', function() {
    const token = '{{ $webhookToken ?? '' }}';
    const url = '{{ route('tools.webhook.clear-session') }}';
    const data = new URLSearchParams();
    data.append('_token', token);

    fetch(url, {
        method: 'POST',
        body: data,
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        keepalive: true
    });
});

function copyToClipboard() {
    const webhookUrl = document.getElementById('webhookUrl');
    navigator.clipboard.writeText(webhookUrl.textContent);

    const button = webhookUrl.nextElementSibling;
    const originalText = button.innerHTML;
    button.innerHTML = '<i class=\'fas fa-check text-green-600 text-lg\'></i>';
    setTimeout(() => {
        button.innerHTML = originalText;
    }, 2000);
}
</script>
@endpush
@endsection 