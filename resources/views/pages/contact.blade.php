@extends('layouts.modern')

@section('content')
<div class="tool-container">
    <div class="tool-header">
        <h1 class="tool-title">Contato</h1>
        <p class="tool-description">Entre em contato conosco</p>
    </div>
    
    <div class="tool-content">
        <div class="contact-section">
            <div class="contact-card">
                <div class="contact-info">
                    <div class="info-header">
                        <i class="fas fa-envelope contact-icon"></i>
                        <h3>E-mail de Contato</h3>
                    </div>
                    
                    <div class="email-display">
                        <span class="email-text">8ito4.contato@gmail.com</span>
                    </div>
                    
                    <div class="response-info">
                        <i class="fas fa-clock"></i>
                        <span>Responderemos em até 24 horas</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.contact-section {
    max-width: 600px;
    margin: 0 auto;
}

.contact-card {
    background: rgba(30, 41, 59, 0.6);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(71, 85, 105, 0.3);
    border-radius: 1rem;
    padding: 2rem;
    transition: all 0.3s ease;
}

.contact-card:hover {
    border-color: rgba(234, 179, 8, 0.4);
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.info-header {
    text-align: center;
    margin-bottom: 2rem;
}

.contact-icon {
    font-size: 3rem;
    color: var(--accent-400);
    margin-bottom: 1rem;
    display: block;
}

.info-header h3 {
    color: white;
    font-size: 1.5rem;
    font-weight: 600;
    margin: 0;
}

.email-display {
    background: rgba(15, 23, 42, 0.6);
    border: 1px solid rgba(71, 85, 105, 0.4);
    border-radius: 0.5rem;
    padding: 1rem;
    margin-bottom: 2rem;
    text-align: center;
}

.email-text {
    color: var(--accent-400);
    font-family: 'JetBrains Mono', monospace;
    font-size: 1.1rem;
    font-weight: 500;
    word-break: break-all;
}

.response-info {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    color: #9ca3af;
    font-size: 0.9rem;
    padding-top: 1rem;
    border-top: 1px solid rgba(71, 85, 105, 0.3);
}

.response-info i {
    color: var(--accent-400);
}

@media (max-width: 640px) {
    .contact-card {
        padding: 1.5rem;
    }
    
    .contact-icon {
        font-size: 2.5rem;
    }
    
    .info-header h3 {
        font-size: 1.25rem;
    }
}
</style>
@endsection 