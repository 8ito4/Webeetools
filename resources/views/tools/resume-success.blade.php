@extends('layouts.modern')

@section('title', 'Currículo Gerado com Sucesso - Webeetools')

@section('content')
<div class="tool-container">
    <div class="success-state">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        
        <h3>Currículo Gerado com Sucesso!</h3>
        <p>Seu currículo profissional foi criado e já deve ter iniciado o download.</p>
        
        <div class="success-actions">
            <a href="{{ route('tools.resume.download', session('resume_filename')) }}" class="btn btn-primary" id="downloadBtn">
                <i class="fas fa-download"></i>
                Baixar Novamente
            </a>
            
            <a href="{{ route('tools.resume.index') }}" class="btn btn-success">
                <i class="fas fa-plus"></i>
                Criar Novo Currículo
            </a>
            
            <a href="{{ route('tools.resume.index') }}" class="btn btn-secondary">
                <i class="fas fa-edit"></i>
                Editar Dados
            </a>
        </div>
        
        <div class="professional-tips">
            <h4><i class="fas fa-lightbulb"></i> Dicas Profissionais:</h4>
            <ul>
                <li>Experimente diferentes templates para sua área</li>
                <li>Personalize o conteúdo para cada vaga</li>
                <li>Use palavras-chave relevantes da sua profissão</li>
                <li>Mantenha o currículo atualizado regularmente</li>
                <li>Revise sempre antes de enviar</li>
            </ul>
        </div>
    </div>
</div>

<script>
// Download automático quando a página carregar
document.addEventListener('DOMContentLoaded', function() {
    @if(session('download_ready'))
        // Fazer download automático
        setTimeout(() => {
            const downloadLink = document.getElementById('downloadBtn');
            if (downloadLink) {
                downloadLink.click();
            }
        }, 500); // Pequeno delay para garantir que a página carregou
    @endif
});
</script>

<style>
/* Success State */
.success-state {
    text-align: center;
    padding: 3rem 1rem;
    min-height: 60vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.success-icon {
    font-size: 4rem;
    color: #10b981;
    margin-bottom: 1.5rem;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
    100% {
        transform: scale(1);
    }
}

.success-state h3 {
    color: #f1f5f9;
    font-size: 1.75rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.success-state p {
    color: #9ca3af;
    margin-bottom: 2rem;
    font-size: 1.125rem;
}

/* Success Actions */
.success-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: 3rem;
}

.btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    font-weight: 600;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 1rem;
}

.btn-primary {
    background: linear-gradient(135deg, var(--accent-400), var(--accent-600));
    color: var(--dark-950);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(234, 179, 8, 0.4);
}

.btn-secondary {
    background: rgba(71, 85, 105, 0.2);
    border: 1px solid rgba(71, 85, 105, 0.3);
    color: #cbd5e1;
}

.btn-secondary:hover {
    background: rgba(71, 85, 105, 0.3);
    border-color: rgba(71, 85, 105, 0.5);
    transform: translateY(-2px);
}

.btn-success {
    background: linear-gradient(135deg, #10b981, #047857);
    color: white;
}

.btn-success:hover {
    background: linear-gradient(135deg, #059669, #065f46);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
}

/* Professional Tips */
.professional-tips {
    background: rgba(15, 23, 42, 0.3);
    border: 1px solid rgba(71, 85, 105, 0.3);
    border-radius: 0.75rem;
    padding: 2rem;
    max-width: 600px;
    text-align: left;
}

.professional-tips h4 {
    color: var(--accent-400);
    font-size: 1.125rem;
    font-weight: 600;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.professional-tips ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.professional-tips li {
    color: #cbd5e1;
    padding: 0.5rem 0;
    padding-left: 1.5rem;
    position: relative;
}

.professional-tips li::before {
    content: "✓";
    position: absolute;
    left: 0;
    color: #10b981;
    font-weight: bold;
}

/* Responsive */
@media (max-width: 768px) {
    .success-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .professional-tips {
        margin: 0 1rem;
    }
}
</style>
@endsection 