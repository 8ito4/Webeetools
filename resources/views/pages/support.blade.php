@extends('layouts.app')

@section('content')
<div id="vanta-bg" class="fixed inset-0 -z-10"></div>

<div class="relative z-10">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-8 text-center">Suporte</h1>

        <div class="max-w-xl mx-auto bg-white/80 rounded-lg shadow-md overflow-hidden" style="backdrop-filter: blur(10px);">
            <div class="px-6 py-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Entre em Contato</h2>
                <p class="text-gray-700 mb-6">Se você precisar de ajuda ou tiver alguma dúvida, sinta-se à vontade para nos contatar pelos canais abaixo:</p>

                <div class="flex items-center mb-4">
                    <div class="flex-shrink-0 bg-yellow-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-1 13H4a2 2 0 01-2-2V6a2 2 0 012-2h16a2 2 0 012 2v13a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-semibold text-gray-600">Email:</p>
                        <a href="mailto:8ito4.contato@gmail.com" class="text-gray-800 hover:text-yellow-600 transition-colors duration-200">8ito4.contato@gmail.com</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.birds.min.js"></script>
<script>
VANTA.BIRDS({
    el: "#vanta-bg",
    mouseControls: true,
    touchControls: true,
    gyroControls: false,
    minHeight: 200.00,
    minWidth: 200.00,
    scale: 1.00,
    scaleMobile: 1.00,
    color1: 0xfbbf24, // Amarelo claro
    color2: 0xf59e0b, // Amarelo escuro/laranja
    backgroundColor: 0xffffff, // Branco
    birdSize: 1.50,
    speedLimit: 3.00,
    quantity: 4.00,
    separation: 40.00,
    wingSpan: 20.00
})
</script>
@endpush 