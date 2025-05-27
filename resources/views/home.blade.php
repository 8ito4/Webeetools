@extends('layouts.app')

@section('content')
<div id="vanta-bg" class="fixed inset-0 -z-10"></div>

<div class="relative z-10">
    <div class="container mx-auto px-4 py-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold mb-4" data-aos="fade-down" id="webeetools-title">
                <span class="inline-block">W</span>
                <span class="inline-block">e</span>
                <span class="inline-block">b</span>
                <span class="inline-block">e</span>
                <span class="inline-block">e</span>
                <span class="inline-block">T</span>
                <span class="inline-block">o</span>
                <span class="inline-block">o</span>
                <span class="inline-block">l</span>
                <span class="inline-block">s</span>
            </h1>
            <p class="text-xl text-gray-600" data-aos="fade-down" data-aos-delay="100">Sua caixa de ferramentas para desenvolvimento</p>
        </div>

        <script>
            window.addEventListener('load', function() {
                console.log('Window loaded, initializing GSAP animation...');
                try {
                    gsap.registerPlugin(TextPlugin);

                    gsap.from("#webeetools-title span", {
                        duration: 0.5,
                        y: 50,
                        opacity: 0,
                        stagger: 0.1,
                        ease: "back.out(1.7)"
                    });

                    const letters = document.querySelectorAll("#webeetools-title span");
                    letters.forEach(letter => {
                        letter.addEventListener("mouseover", () => {
                            gsap.to(letter, {
                                duration: 0.3,
                                y: -10,
                                scale: 1.2,
                                color: "#f59e0b",
                                ease: "elastic.out(1, 0.3)"
                            });
                        });

                        letter.addEventListener("mouseout", () => {
                            gsap.to(letter, {
                                duration: 0.3,
                                y: 0,
                                scale: 1,
                                color: "#000000",
                                ease: "elastic.out(1, 0.3)"
                            });
                        });
                    });

                    console.log('GSAP animation initialized successfully');
                } catch (error) {
                    console.error('Error initializing GSAP animation:', error);
                }
            });
        </script>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <a href="{{ route('tools.pomodoro') }}" class="group" data-aos="fade-up" data-aos-delay="100">
                <div class="overflow-hidden shadow-sm sm:rounded-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:rotate-1 hover:scale-105" style="background-color: rgba(230, 230, 230, 0.4); backdrop-filter: blur(10px);">
                    <div class="p-6">
                        <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-yellow-100 mb-4 group-hover:bg-yellow-200 transition-colors duration-300">
                            <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">Pomodoro Timer</h2>
                        <p class="text-gray-600">Aumente sua produtividade com o método Pomodoro</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('tools.json') }}" class="group" data-aos="fade-up" data-aos-delay="200">
                <div class="overflow-hidden shadow-sm sm:rounded-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:rotate-1 hover:scale-105" style="background-color: rgba(230, 230, 230, 0.4); backdrop-filter: blur(10px);">
                    <div class="p-6">
                        <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-yellow-100 mb-4 group-hover:bg-yellow-200 transition-colors duration-300">
                            <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">Formatador JSON</h2>
                        <p class="text-gray-600">Formate e valide seus dados JSON facilmente</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('tools.password') }}" class="group" data-aos="fade-up" data-aos-delay="300">
                <div class="overflow-hidden shadow-sm sm:rounded-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:rotate-1 hover:scale-105" style="background-color: rgba(230, 230, 230, 0.4); backdrop-filter: blur(10px);">
                    <div class="p-6">
                        <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-yellow-100 mb-4 group-hover:bg-yellow-200 transition-colors duration-300">
                            <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">Gerador de Senha</h2>
                        <p class="text-gray-600">Crie senhas fortes e seguras com opções personalizáveis</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('tools.api-tester') }}" class="group" data-aos="fade-up" data-aos-delay="400">
                <div class="overflow-hidden shadow-sm sm:rounded-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:rotate-1 hover:scale-105" style="background-color: rgba(230, 230, 230, 0.4); backdrop-filter: blur(10px);">
                    <div class="p-6">
                        <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-yellow-100 mb-4 group-hover:bg-yellow-200 transition-colors duration-300">
                            <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">Testador de API</h2>
                        <p class="text-gray-600">Teste e depure seus endpoints de API facilmente</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('tools.webhook') }}" class="group" data-aos="fade-up" data-aos-delay="500">
                <div class="overflow-hidden shadow-sm sm:rounded-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:rotate-1 hover:scale-105" style="background-color: rgba(230, 230, 230, 0.4); backdrop-filter: blur(10px);">
                    <div class="p-6">
                        <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-yellow-100 mb-4 group-hover:bg-yellow-200 transition-colors duration-300">
                            <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 1.656-.895 3-2 3s-2-1.344-2-3S9 8 10 8s2 1.344 2 3z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11V8m-2 3v3m4-3v3m-2-3h3m-3 0h-3"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v14a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">Testador de Webhook</h2>
                        <p class="text-gray-600">Receba e inspecione requisições de webhook</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('planning-poker.index') }}" class="group" data-aos="fade-up" data-aos-delay="600">
                <div class="overflow-hidden shadow-sm sm:rounded-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:rotate-1 hover:scale-105" style="background-color: rgba(230, 230, 230, 0.4); backdrop-filter: blur(10px);">
                    <div class="p-6">
                        <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-yellow-100 mb-4 group-hover:bg-yellow-200 transition-colors duration-300">
                            <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">Planning Poker</h2>
                        <p class="text-gray-600">Ferramenta colaborativa para estimativa de pontos</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('tools.cellphone') }}" class="group" data-aos="fade-up" data-aos-delay="700">
                <div class="overflow-hidden shadow-sm sm:rounded-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:rotate-1 hover:scale-105" style="background-color: rgba(230, 230, 230, 0.4); backdrop-filter: blur(10px);">
                    <div class="p-6">
                        <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-yellow-100 mb-4 group-hover:bg-yellow-200 transition-colors duration-300">
                            <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12h2m-2 0l-1-1m1 1l-1 1m-3-4v4m0 0l-1 1m1-1l-1-1m-3 4h2m-2 0l-1-1m1 1l-1 1M6 16v2m0 0l-1-1m1 1l-1 1"/>
                                <rect x="3" y="4" width="18" height="16" rx="2" ry="2"></rect>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">Gerador de Número de Celular</h2>
                        <p class="text-gray-600">Gere números de celular válidos para testes</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('tools.document') }}" class="group" data-aos="fade-up" data-aos-delay="800">
                <div class="overflow-hidden shadow-sm sm:rounded-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:rotate-1 hover:scale-105" style="background-color: rgba(230, 230, 230, 0.4); backdrop-filter: blur(10px);">
                    <div class="p-6">
                        <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-yellow-100 mb-4 group-hover:bg-yellow-200 transition-colors duration-300">
                            <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">Gerador de CPF/CNPJ</h2>
                        <p class="text-gray-600">Gere documentos brasileiros válidos para testes</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.birds.min.js"></script>
<script>
console.log('Vanta.js script is running');
VANTA.BIRDS({
    el: "#vanta-bg",
    mouseControls: true,
    touchControls: true,
    gyroControls: false,
    minHeight: 200.00,
    minWidth: 200.00,
    scale: 1.00,
    scaleMobile: 1.00,
    color1: 0xfbbf24,
    color2: 0xf59e0b,
    backgroundColor: 0xffffff,
    birdSize: 1.50,
    speedLimit: 3.00,
    quantity: 4.00,
    separation: 40.00,
    wingSpan: 20.00
})
</script>
@endpush
@endsection 