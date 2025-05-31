@props(['code', 'language' => 'bash'])

<div class="relative bg-gray-900 rounded-lg p-4 my-4 group">
    <!-- Header com linguagem e botão copiar -->
    <div class="flex justify-between items-center mb-3">
        <span class="text-gray-400 text-xs font-medium uppercase tracking-wide">{{ $language }}</span>
        <button 
            onclick="copyToClipboard(this, '{{ addslashes($code) }}')" 
            class="flex items-center space-x-2 bg-gray-800 hover:bg-gray-700 text-gray-300 hover:text-white px-3 py-1.5 rounded-md text-xs font-medium transition-all duration-200 opacity-70 group-hover:opacity-100"
        >
            <i class="fas fa-copy"></i>
            <span class="copy-text">Copiar</span>
        </button>
    </div>
    
    <!-- Código -->
    <pre class="text-green-400 font-mono text-sm leading-relaxed overflow-x-auto"><code>{{ $code }}</code></pre>
    
    <!-- Decoração -->
    <div class="absolute top-3 left-3 flex space-x-1.5">
        <div class="w-3 h-3 bg-red-500 rounded-full opacity-60"></div>
        <div class="w-3 h-3 bg-yellow-500 rounded-full opacity-60"></div>
        <div class="w-3 h-3 bg-green-500 rounded-full opacity-60"></div>
    </div>
</div>

@push('scripts')
<script>
function copyToClipboard(button, text) {
    navigator.clipboard.writeText(text).then(function() {
        const copyText = button.querySelector('.copy-text');
        const originalText = copyText.textContent;
        
        // Feedback visual
        copyText.textContent = 'Copiado!';
        button.classList.add('bg-green-600', 'text-white');
        button.classList.remove('bg-gray-800', 'text-gray-300');
        
        // Resetar após 2 segundos
        setTimeout(() => {
            copyText.textContent = originalText;
            button.classList.remove('bg-green-600', 'text-white');
            button.classList.add('bg-gray-800', 'text-gray-300');
        }, 2000);
    }).catch(function(err) {
        console.error('Erro ao copiar: ', err);
    });
}
</script>
@endpush 