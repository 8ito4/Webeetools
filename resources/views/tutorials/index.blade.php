@extends('layouts.app')

@section('title', 'Tutoriais - Webeetools')

@section('content')
<div id="vanta-bg" class="fixed inset-0 -z-10"></div>

<div class="relative z-10">
    <div class="container mx-auto px-4 py-8">
        <!-- Cabeçalho -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold mb-4" data-aos="fade-down">
                <i class="fas fa-graduation-cap text-yellow-500 mr-3"></i>
                Tutoriais
            </h1>
            <p class="text-xl text-gray-600" data-aos="fade-down" data-aos-delay="100">
                Aprenda passo a passo com nossos guias detalhados
            </p>
        </div>

        <!-- Filtros -->
        <div class="flex flex-wrap justify-center gap-4 mb-8" data-aos="fade-up">
            <button class="filter-btn active px-4 py-2 rounded-full border-2 border-yellow-500 bg-yellow-500 text-white font-medium transition-all hover:bg-yellow-600" data-filter="all">
                Todos
            </button>
            <button class="filter-btn px-4 py-2 rounded-full border-2 border-gray-300 text-gray-700 font-medium transition-all hover:border-yellow-500 hover:text-yellow-500" data-filter="servidor">
                Servidor Web
            </button>
            <button class="filter-btn px-4 py-2 rounded-full border-2 border-gray-300 text-gray-700 font-medium transition-all hover:border-yellow-500 hover:text-yellow-500" data-filter="programacao">
                Linguagem
            </button>
            <button class="filter-btn px-4 py-2 rounded-full border-2 border-gray-300 text-gray-700 font-medium transition-all hover:border-yellow-500 hover:text-yellow-500" data-filter="framework">
                Framework
            </button>
        </div>

        <!-- Grid de Tutoriais -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="tutorials-grid">
            @foreach($tutorials as $tutorial)
                <div class="tutorial-card group" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}" data-category="{{ strtolower(str_replace(' ', '-', $tutorial['category'])) }}">
                    <a href="{{ route('tutorials.show', $tutorial['slug']) }}">
                        <div class="overflow-hidden shadow-lg sm:rounded-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-2 hover:scale-105" 
                             style="background-color: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px);">
                            
                            <!-- Header do Card -->
                            <div class="relative p-6 pb-4">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-center justify-center w-16 h-16 rounded-xl {{ $tutorial['color'] }} mb-4 group-hover:scale-110 transition-transform duration-300">
                                        <i class="{{ $tutorial['icon'] }} text-2xl text-white"></i>
                                    </div>
                                    <div class="flex flex-col items-end">
                                        <span class="text-xs font-semibold text-gray-500 bg-gray-100 px-2 py-1 rounded-full mb-1">
                                            {{ $tutorial['category'] }}
                                        </span>
                                        <span class="text-xs text-gray-400">{{ $tutorial['duration'] }}</span>
                                    </div>
                                </div>

                                <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-yellow-600 transition-colors duration-300">
                                    {{ $tutorial['title'] }}
                                </h3>
                                
                                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                                    {{ $tutorial['description'] }}
                                </p>

                                <!-- Tags -->
                                <div class="flex flex-wrap gap-2 mb-4">
                                    @foreach($tutorial['tags'] as $tag)
                                        <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-full">
                                            #{{ $tag }}
                                        </span>
                                    @endforeach
                                </div>

                                <!-- Footer do Card -->
                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <div class="flex items-center">
                                        <div class="flex">
                                            @for($i = 1; $i <= 3; $i++)
                                                <i class="fas fa-star text-sm {{ $tutorial['difficulty'] === 'Iniciante' && $i === 1 ? 'text-yellow-400' : ($tutorial['difficulty'] === 'Intermediário' && $i <= 2 ? 'text-yellow-400' : ($tutorial['difficulty'] === 'Avançado' ? 'text-yellow-400' : 'text-gray-300')) }}"></i>
                                            @endfor
                                        </div>
                                        <span class="text-xs text-gray-500 ml-2">{{ $tutorial['difficulty'] }}</span>
                                    </div>
                                    
                                    <div class="flex items-center text-yellow-600 group-hover:text-yellow-700">
                                        <span class="text-sm font-medium mr-2">Ver tutorial</span>
                                        <i class="fas fa-arrow-right text-sm transform group-hover:translate-x-1 transition-transform duration-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Mensagem quando não há resultados -->
        <div id="no-results" class="hidden text-center py-12">
            <i class="fas fa-search text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">Nenhum tutorial encontrado</h3>
            <p class="text-gray-500">Tente ajustar os filtros para encontrar o que procura.</p>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.topology.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar Vanta.js background
        if (typeof VANTA !== 'undefined') {
            VANTA.TOPOLOGY({
                el: "#vanta-bg",
                mouseControls: true,
                touchControls: true,
                gyroControls: false,
                minHeight: 200.00,
                minWidth: 200.00,
                scale: 1.00,
                scaleMobile: 1.00,
                color: 0xfbbf24,
                backgroundColor: 0xf8fafc
            });
        }

        // Sistema de filtros
        const filterBtns = document.querySelectorAll('.filter-btn');
        const tutorialCards = document.querySelectorAll('.tutorial-card');
        const noResults = document.getElementById('no-results');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const filter = this.getAttribute('data-filter');
                
                // Atualizar botões ativos
                filterBtns.forEach(b => {
                    b.classList.remove('active', 'bg-yellow-500', 'text-white');
                    b.classList.add('border-gray-300', 'text-gray-700');
                });
                
                this.classList.add('active', 'bg-yellow-500', 'text-white', 'border-yellow-500');
                this.classList.remove('border-gray-300', 'text-gray-700');

                // Filtrar cards
                let visibleCount = 0;
                tutorialCards.forEach(card => {
                    const category = card.getAttribute('data-category');
                    
                    if (filter === 'all' || category.includes(filter)) {
                        card.style.display = 'block';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Mostrar/esconder mensagem de "nenhum resultado"
                if (visibleCount === 0) {
                    noResults.classList.remove('hidden');
                } else {
                    noResults.classList.add('hidden');
                }
            });
        });
    });
</script>
@endpush
@endsection 