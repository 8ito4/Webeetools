@extends('layouts.app')

@section('title', 'Webhook Tester')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                Webhook Tester
            </h1>
            <p class="mt-4 text-lg text-gray-500">
                Teste e depure seus webhooks em tempo real
            </p>
        </div>

        <div class="bg-white shadow rounded-lg">
            <div class="p-6">
                <!-- URL única gerada -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Sua URL única de teste
                    </label>
                    <div class="flex">
                        <input type="text" readonly id="webhookUrl" class="flex-1 block w-full rounded-l-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ route('tools.webhook.receive', ['token' => $token]) }}">
                        <button onclick="copyToClipboard()" class="inline-flex items-center px-4 py-2 border border-l-0 border-gray-300 rounded-r-md bg-gray-50 text-sm font-medium text-gray-700 hover:bg-gray-100">
                            <i class="far fa-copy mr-2"></i>
                            Copiar
                        </button>
                    </div>
                </div>

                <!-- Requisições recebidas -->
                <div class="mt-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Requisições Recebidas</h3>
                    <div class="bg-gray-50 rounded-lg overflow-hidden">
                        @forelse($requests as $request)
                            <div class="p-4 border-b border-gray-200 last:border-b-0">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $request['method'] === 'GET' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                        {{ $request['method'] }}
                                    </span>
                                    <span class="text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($request['created_at'])->format('d/m/Y H:i:s') }}
                                    </span>
                                </div>
                                <div class="mt-2">
                                    <div class="mb-2">
                                        <h4 class="text-sm font-medium text-gray-700">Headers:</h4>
                                        <pre class="mt-1 text-sm text-gray-600 bg-gray-100 p-2 rounded">{{ json_encode($request['headers'], JSON_PRETTY_PRINT) }}</pre>
                                    </div>
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
                        @empty
                            <div class="p-4 text-center text-gray-500">
                                Nenhuma requisição recebida ainda
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function copyToClipboard() {
    const webhookUrl = document.getElementById('webhookUrl');
    webhookUrl.select();
    document.execCommand('copy');
    
    // Opcional: Mostrar feedback visual
    const button = webhookUrl.nextElementSibling;
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-check mr-2"></i>Copiado!';
    setTimeout(() => {
        button.innerHTML = originalText;
    }, 2000);
}
</script>
@endpush
@endsection 