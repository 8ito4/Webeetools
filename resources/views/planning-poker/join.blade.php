@extends('layouts.app')

@section('title', 'Entrar na Sala')

@section('content')
<div class="py-12">
    <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-8">
                Entrar na Sala
            </h1>

            <form method="POST" action="{{ route('planning-poker.join') }}" class="space-y-6">
                @csrf
                <input type="hidden" name="code" value="{{ $code }}">
                
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Seu nome</label>
                    <div class="mt-1">
                        <input type="text" name="name" id="name" required 
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            placeholder="Digite seu nome">
                    </div>
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Entrar na Sala
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 