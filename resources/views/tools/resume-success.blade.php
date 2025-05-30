@extends('layouts.modern')

@section('title', 'Currículo Gerado com Sucesso - Webeetools')

@section('content')
<div class="tool-container">
    <!-- Success State -->
    <div class="success-state-page">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <h1 class="success-title">Currículo Gerado com Sucesso!</h1>
        <p class="success-description">Seu currículo profissional foi criado e já deve ter iniciado o download.</p>
        
        <div class="success-actions">
            <a href="{{ route('tools.resume.download', ['filename' => session('resume_filename', 'curriculo.pdf')]) }}" class="btn btn-primary">
                <i class="fas fa-download"></i>
                Baixar Novamente
            </a>
            <a href="{{ route('tools.resume.index') }}" class="btn btn-success">
                <i class="fas fa-plus"></i>
                Criar Novo Currículo
            </a>
            <a href="{{ route('tools.resume.index') }}#form" class="btn btn-secondary">
                <i class="fas fa-edit"></i>
                Editar Dados
            </a>
        </div>
        
        <!-- Dicas profissionais -->
        <div class="professional-tips">
            <h4>
                <i class="fas fa-lightbulb"></i>
                Dicas Profissionais:
            </h4>
            <ul>
                <li>Experimente diferentes templates para sua área</li>
                <li>Personalize o conteúdo para cada vaga</li>
                <li>Use palavras-chave relevantes da sua profissão</li>
            </ul>
        </div>
    </div>
</div>

<style>
.success-state-page {
    text-align: center;
    padding: 4rem 2rem;
    max-width: 600px;
    margin: 0 auto;
}

.success-icon {
    font-size: 5rem;
    color: #10b981;
    margin-bottom: 2rem;
    animation: successPulse 2s ease-in-out infinite;
}

@keyframes successPulse {
    0%, 100% {
        transform: scale(1);
        opacity: 1;
    }
    50% {
        transform: scale(1.1);
        opacity: 0.8;
    }
}

.success-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #f1f5f9;
    margin-bottom: 1rem;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.success-description {
    font-size: 1.25rem;
    color: #cbd5e1;
    margin-bottom: 3rem;
    line-height: 1.6;
}

.success-actions {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-bottom: 3rem;
    align-items: center;
}

@media (min-width: 640px) {
    .success-actions {
        flex-direction: row;
        justify-content: center;
    }
}

.professional-tips {
    background: rgba(16, 185, 129, 0.1);
    border: 1px solid rgba(16, 185, 129, 0.3);
    border-radius: 0.75rem;
    padding: 1.5rem;
    text-align: left;
}

.professional-tips h4 {
    color: #10b981;
    font-size: 1rem;
    margin: 0 0 1rem 0;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.professional-tips ul {
    color: #10b981;
    font-size: 0.875rem;
    margin: 0;
    padding-left: 1.5rem;
    line-height: 1.6;
}

.professional-tips li {
    margin-bottom: 0.5rem;
}

.professional-tips li:last-child {
    margin-bottom: 0;
}
</style>
@endsection 