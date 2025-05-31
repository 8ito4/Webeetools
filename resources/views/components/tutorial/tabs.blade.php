@props(['tabs'])

<div class="tabs-container my-6">
    <!-- Headers das abas -->
    <div class="flex border-b border-gray-200 bg-gray-50 rounded-t-lg">
        @foreach($tabs as $key => $tab)
            <button class="tab-button flex items-center px-6 py-3 text-sm font-medium transition-all duration-200 {{ $loop->first ? 'active' : '' }}" 
                    data-tab="{{ $key }}">
                @if($key === 'ubuntu')
                    <i class="fab fa-ubuntu mr-2 text-orange-500"></i>
                @elseif($key === 'windows')
                    <i class="fab fa-windows mr-2 text-blue-500"></i>
                @elseif($key === 'macos')
                    <i class="fab fa-apple mr-2 text-gray-600"></i>
                @endif
                {{ $tab['title'] }}
            </button>
        @endforeach
    </div>

    <!-- Conteúdo das abas -->
    <div class="tab-content bg-white border border-gray-200 border-t-0 rounded-b-lg">
        @foreach($tabs as $key => $tab)
            <div class="tab-pane p-6 {{ !$loop->first ? 'hidden' : '' }}" data-tab-content="{{ $key }}">
                @if(isset($tab['steps']))
                    @foreach($tab['steps'] as $step)
                        <div class="mb-6">
                            <h4 class="text-lg font-semibold text-gray-800 mb-3">
                                <span class="inline-flex items-center justify-center w-6 h-6 bg-yellow-500 text-white text-sm font-bold rounded-full mr-3">
                                    {{ $loop->iteration }}
                                </span>
                                {{ $step['title'] }}
                            </h4>
                            
                            @if(isset($step['content']))
                                <p class="text-gray-600 mb-3">{{ $step['content'] }}</p>
                            @endif
                            
                            @if(isset($step['code']))
                                <x-tutorial.code-block :code="$step['code']" />
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        @endforeach
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sistema de abas
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabPanes = document.querySelectorAll('.tab-pane');

    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');
            
            // Remover estado ativo de todos os botões
            tabButtons.forEach(btn => {
                btn.classList.remove('active', 'bg-white', 'text-yellow-600', 'border-yellow-500');
                btn.classList.add('text-gray-600', 'hover:text-gray-800');
            });
            
            // Ativar botão clicado
            this.classList.add('active', 'bg-white', 'text-yellow-600', 'border-b-2', 'border-yellow-500');
            this.classList.remove('text-gray-600', 'hover:text-gray-800');
            
            // Ocultar todos os painéis
            tabPanes.forEach(pane => {
                pane.classList.add('hidden');
            });
            
            // Mostrar painel correspondente
            const targetPane = document.querySelector(`[data-tab-content="${targetTab}"]`);
            if (targetPane) {
                targetPane.classList.remove('hidden');
            }
        });
    });
});
</script>

<style>
.tab-button {
    @apply text-gray-600 hover:text-gray-800 border-b-2 border-transparent;
}

.tab-button.active {
    @apply bg-white text-yellow-600 border-yellow-500;
}
</style>
@endpush 