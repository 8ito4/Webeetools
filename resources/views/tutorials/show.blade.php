@extends('layouts.app')

@section('title', $tutorial['title'] . ' - Tutoriais - Webeetools')

@section('content')
<div id="vanta-bg" class="fixed inset-0 -z-10"></div>

<div class="relative z-10">
    <div class="container mx-auto px-4 py-8">
        
        <!-- Breadcrumb e Voltar -->
        <div class="flex items-center justify-between mb-8" data-aos="fade-down">
            <nav class="flex items-center space-x-2 text-sm">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-yellow-600 transition-colors">Início</a>
                <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                <a href="{{ route('tutorials.index') }}" class="text-gray-500 hover:text-yellow-600 transition-colors">Tutoriais</a>
                <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                <span class="text-gray-900 font-medium">{{ $tutorial['title'] }}</span>
            </nav>
            
            <a href="{{ route('tutorials.index') }}" class="flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Voltar aos Tutoriais
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            <!-- Conteúdo Principal -->
            <div class="lg:col-span-3">
                
                <!-- Header do Tutorial -->
                <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-lg p-8 mb-8" data-aos="fade-up">
                    <div class="flex items-start justify-between mb-6">
                        <div class="flex items-center">
                            <div class="flex items-center justify-center w-16 h-16 rounded-xl {{ $tutorial['color'] }} mr-6">
                                <i class="{{ $tutorial['icon'] }} text-2xl text-white"></i>
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $tutorial['title'] }}</h1>
                                <p class="text-gray-600 text-lg">{{ $tutorial['description'] }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Metadados -->
                    <div class="flex flex-wrap items-center gap-6 text-sm">
                        <div class="flex items-center">
                            <i class="fas fa-layer-group text-gray-400 mr-2"></i>
                            <span class="text-gray-600">{{ $tutorial['category'] }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock text-gray-400 mr-2"></i>
                            <span class="text-gray-600">{{ $tutorial['duration'] }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-signal text-gray-400 mr-2"></i>
                            <span class="text-gray-600">{{ $tutorial['difficulty'] }}</span>
                        </div>
                    </div>
                    
                    <!-- Tags -->
                    <div class="flex flex-wrap gap-2 mt-4">
                        @foreach($tutorial['tags'] as $tag)
                            <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-3 py-1 rounded-full">
                                #{{ $tag }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <!-- Conteúdo do Tutorial -->
                <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-lg p-8" data-aos="fade-up" data-aos-delay="100">
                    @php
                        $content = app(App\Http\Controllers\TutorialController::class)->getTutorialContent($tutorial['slug']);
                    @endphp
                    
                    @if($content)
                        @foreach($content['sections'] as $section)
                            <section class="mb-12">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6 pb-3 border-b-2 border-yellow-500">
                                    {{ $section['title'] }}
                                </h2>
                                
                                @if(isset($section['content']))
                                    <div class="prose prose-lg text-gray-700 mb-6">
                                        {!! nl2br(e($section['content'])) !!}
                                    </div>
                                @endif
                                
                                @if(isset($section['tabs']))
                                    <x-tutorial.tabs :tabs="$section['tabs']" />
                                @endif
                                
                                @if(isset($section['steps']))
                                    <div class="space-y-6">
                                        @foreach($section['steps'] as $step)
                                            <div class="step-item">
                                                <h4 class="text-lg font-semibold text-gray-800 mb-3">
                                                    <span class="inline-flex items-center justify-center w-8 h-8 bg-yellow-500 text-white text-sm font-bold rounded-full mr-3">
                                                        {{ $loop->iteration }}
                                                    </span>
                                                    {{ $step['title'] }}
                                                </h4>
                                                
                                                @if(isset($step['content']))
                                                    <p class="text-gray-600 mb-4 ml-11">{{ $step['content'] }}</p>
                                                @endif
                                                
                                                @if(isset($step['code']))
                                                    <div class="ml-11">
                                                        <x-tutorial.code-block :code="$step['code']" />
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </section>
                        @endforeach
                        
                        <!-- Conclusão -->
                        <div class="bg-green-50 border border-green-200 rounded-lg p-6 mt-8">
                            <div class="flex items-center mb-3">
                                <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                                <h3 class="text-lg font-semibold text-green-800">Parabéns!</h3>
                            </div>
                            <p class="text-green-700">
                                Você concluiu o tutorial "{{ $tutorial['title'] }}". 
                                Continue aprendendo com nossos outros tutoriais!
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                
                <!-- Índice de Navegação -->
                <div class="sticky top-24">
                    <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-lg p-6 mb-6" data-aos="fade-left">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">
                            <i class="fas fa-list-ul text-yellow-500 mr-2"></i>
                            Índice
                        </h3>
                        
                        @if($content)
                            <nav class="space-y-2">
                                @foreach($content['sections'] as $section)
                                    <a href="#section-{{ $loop->index }}" 
                                       class="block py-2 px-3 text-gray-600 hover:text-yellow-600 hover:bg-yellow-50 rounded-md transition-colors scroll-link">
                                        {{ $section['title'] }}
                                    </a>
                                @endforeach
                            </nav>
                        @endif
                    </div>
                    
                    <!-- Progresso -->
                    <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-lg p-6" data-aos="fade-left" data-aos-delay="100">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">
                            <i class="fas fa-chart-line text-yellow-500 mr-2"></i>
                            Progresso
                        </h3>
                        
                        <div class="mb-3">
                            <div class="flex justify-between text-sm text-gray-600 mb-1">
                                <span>Leitura</span>
                                <span id="progress-text">0%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div id="progress-bar" class="bg-yellow-500 h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
                            </div>
                        </div>
                        
                        <div class="text-xs text-gray-500">
                            Role a página para atualizar o progresso
                        </div>
                    </div>
                </div>
            </div>
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

    // Scroll suave para links internos
    document.querySelectorAll('.scroll-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Barra de progresso
    function updateProgress() {
        const windowHeight = window.innerHeight;
        const documentHeight = document.documentElement.scrollHeight - windowHeight;
        const scrolled = window.scrollY;
        const progress = (scrolled / documentHeight) * 100;
        
        const progressBar = document.getElementById('progress-bar');
        const progressText = document.getElementById('progress-text');
        
        if (progressBar && progressText) {
            progressBar.style.width = Math.min(progress, 100) + '%';
            progressText.textContent = Math.round(Math.min(progress, 100)) + '%';
        }
    }

    window.addEventListener('scroll', updateProgress);
    updateProgress(); // Inicializar
});
</script>
@endpush
@endsection 