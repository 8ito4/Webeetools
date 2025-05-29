@extends('layouts.modern')

@section('title', 'Gerador de Currículo - Webeetools')

@section('content')
<div class="tool-container">
    <div class="tool-header">
        <h1 class="tool-title">
            <i class="fas fa-file-pdf" style="color: #ef4444; margin-right: 0.5rem;"></i>
            Gerador de Currículo
        </h1>
        <p class="tool-description">
            Crie currículos profissionais em PDF com nossos templates modernos para qualquer área
        </p>
    </div>

    <div class="tool-content">
        <!-- Template Selection -->
        <div class="template-section">
            <h3 style="color: var(--accent-400); margin-bottom: 1rem;">
                <i class="fas fa-palette"></i> Escolha o Template
            </h3>
            <div class="template-grid">
                <div class="template-card active" data-template="modern">
                    <div class="template-preview">
                        <div class="template-header" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8);"></div>
                        <div class="template-content">
                            <div class="template-line"></div>
                            <div class="template-line short"></div>
                            <div class="template-line"></div>
                        </div>
                    </div>
                    <h4>Moderno</h4>
                    <p>Design clean e profissional</p>
                </div>
                
                <div class="template-card" data-template="classic">
                    <div class="template-preview">
                        <div class="template-header" style="background: #1f2937;"></div>
                        <div class="template-content">
                            <div class="template-line"></div>
                            <div class="template-line short"></div>
                            <div class="template-line"></div>
                        </div>
                    </div>
                    <h4>Clássico</h4>
                    <p>Estilo tradicional e elegante</p>
                </div>
                
                <div class="template-card" data-template="creative">
                    <div class="template-preview">
                        <div class="template-header" style="background: linear-gradient(135deg, #10b981, #047857);"></div>
                        <div class="template-content">
                            <div class="template-line"></div>
                            <div class="template-line short"></div>
                            <div class="template-line"></div>
                        </div>
                    </div>
                    <h4>Criativo</h4>
                    <p>Para áreas criativas e modernas</p>
                </div>
            </div>
        </div>

        <!-- Resume Form -->
        <form id="resumeForm" class="resume-form">
            @csrf
            
            <!-- Personal Information -->
            <div class="form-section">
                <h3 class="section-title">
                    <i class="fas fa-user"></i>
                    Informações Pessoais
                </h3>
                
                <div class="grid grid-cols-2">
                    <div class="form-group">
                        <label class="form-label">Nome Completo *</label>
                        <input type="text" name="fullName" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Cargo/Profissão *</label>
                        <input type="text" name="position" class="form-input" placeholder="Ex: Gerente de Vendas, Analista Financeiro" required>
                    </div>
                </div>
                
                <div class="grid grid-cols-2">
                    <div class="form-group">
                        <label class="form-label">Email *</label>
                        <input type="email" name="email" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Telefone *</label>
                        <input type="tel" name="phone" class="form-input" placeholder="(11) 99999-9999" required>
                    </div>
                </div>
                
                <div class="grid grid-cols-2">
                    <div class="form-group">
                        <label class="form-label">LinkedIn</label>
                        <input type="url" name="linkedin" class="form-input" placeholder="https://linkedin.com/in/seuperfil">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Site/Portfolio</label>
                        <input type="url" name="website" class="form-input" placeholder="https://seusite.com">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Localização</label>
                    <input type="text" name="location" class="form-input" placeholder="São Paulo, SP - Brasil">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Resumo Profissional</label>
                    <textarea name="summary" class="form-textarea" rows="4" placeholder="Descreva brevemente sua experiência, objetivos profissionais e principais qualificações..."></textarea>
                </div>
            </div>

            <!-- Experience -->
            <div class="form-section">
                <h3 class="section-title">
                    <i class="fas fa-briefcase"></i>
                    Experiência Profissional
                </h3>
                
                <div id="experienceContainer">
                    <div class="experience-item">
                        <div class="grid grid-cols-2">
                            <div class="form-group">
                                <label class="form-label">Cargo</label>
                                <input type="text" name="experience[0][position]" class="form-input" placeholder="Ex: Gerente de Projetos">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Empresa</label>
                                <input type="text" name="experience[0][company]" class="form-input" placeholder="Nome da empresa">
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2">
                            <div class="form-group">
                                <label class="form-label">Data Início</label>
                                <input type="month" name="experience[0][startDate]" class="form-input">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Data Fim</label>
                                <input type="month" name="experience[0][endDate]" class="form-input">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="experience[0][current]" class="current-job">
                                    Trabalho atual
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Descrição das Atividades</label>
                            <textarea name="experience[0][description]" class="form-textarea" rows="3" placeholder="Descreva suas principais responsabilidades, conquistas e resultados obtidos..."></textarea>
                        </div>
                        
                        <button type="button" class="remove-item-btn" onclick="removeExperience(this)" style="display: none;">
                            <i class="fas fa-trash"></i> Remover
                        </button>
                    </div>
                </div>
                
                <button type="button" class="add-item-btn" onclick="addExperience()">
                    <i class="fas fa-plus"></i> Adicionar Experiência
                </button>
            </div>

            <!-- Education -->
            <div class="form-section">
                <h3 class="section-title">
                    <i class="fas fa-graduation-cap"></i>
                    Formação Acadêmica
                </h3>
                
                <div id="educationContainer">
                    <div class="education-item">
                        <div class="grid grid-cols-2">
                            <div class="form-group">
                                <label class="form-label">Curso/Graduação</label>
                                <input type="text" name="education[0][degree]" class="form-input" placeholder="Ex: Administração de Empresas">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Instituição</label>
                                <input type="text" name="education[0][institution]" class="form-input" placeholder="Nome da instituição">
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2">
                            <div class="form-group">
                                <label class="form-label">Ano Início</label>
                                <input type="number" name="education[0][startYear]" class="form-input" min="1950" max="2030">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Ano Conclusão</label>
                                <input type="number" name="education[0][endYear]" class="form-input" min="1950" max="2030">
                            </div>
                        </div>
                        
                        <button type="button" class="remove-item-btn" onclick="removeEducation(this)" style="display: none;">
                            <i class="fas fa-trash"></i> Remover
                        </button>
                    </div>
                </div>
                
                <button type="button" class="add-item-btn" onclick="addEducation()">
                    <i class="fas fa-plus"></i> Adicionar Formação
                </button>
            </div>

            <!-- Skills -->
            <div class="form-section">
                <h3 class="section-title">
                    <i class="fas fa-star"></i>
                    Competências e Habilidades
                </h3>
                
                <div class="form-group">
                    <label class="form-label">Habilidades Técnicas</label>
                    <input type="text" name="skills[technical]" class="form-input" placeholder="Ex: Excel Avançado, CRM, SAP, AutoCAD">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Habilidades Interpessoais</label>
                    <input type="text" name="skills[interpersonal]" class="form-input" placeholder="Ex: Liderança, Comunicação, Trabalho em Equipe">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Áreas de Especialização</label>
                    <input type="text" name="skills[specialization]" class="form-input" placeholder="Ex: Gestão de Projetos, Marketing Digital, Vendas">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Certificações</label>
                    <input type="text" name="skills[certifications]" class="form-input" placeholder="Ex: PMP, Google Analytics, Microsoft Office">
                </div>
            </div>

            <!-- Languages -->
            <div class="form-section">
                <h3 class="section-title">
                    <i class="fas fa-language"></i>
                    Idiomas
                </h3>
                
                <div id="languageContainer">
                    <div class="language-item">
                        <div class="grid grid-cols-2">
                            <div class="form-group">
                                <label class="form-label">Idioma</label>
                                <input type="text" name="languages[0][language]" class="form-input" placeholder="Ex: Inglês">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nível</label>
                                <select name="languages[0][level]" class="form-input">
                                    <option value="Básico">Básico</option>
                                    <option value="Intermediário">Intermediário</option>
                                    <option value="Avançado">Avançado</option>
                                    <option value="Fluente">Fluente</option>
                                    <option value="Nativo">Nativo</option>
                                </select>
                            </div>
                        </div>
                        
                        <button type="button" class="remove-item-btn" onclick="removeLanguage(this)" style="display: none;">
                            <i class="fas fa-trash"></i> Remover
                        </button>
                    </div>
                </div>
                
                <button type="button" class="add-item-btn" onclick="addLanguage()">
                    <i class="fas fa-plus"></i> Adicionar Idioma
                </button>
            </div>

            <!-- Additional Information -->
            <div class="form-section">
                <h3 class="section-title">
                    <i class="fas fa-plus-circle"></i>
                    Informações Adicionais
                </h3>
                
                <div class="form-group">
                    <label class="form-label">Cursos e Treinamentos</label>
                    <textarea name="additional[courses]" class="form-textarea" rows="3" placeholder="Liste cursos relevantes, workshops, treinamentos, etc."></textarea>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Projetos e Realizações</label>
                    <textarea name="additional[projects]" class="form-textarea" rows="3" placeholder="Descreva projetos importantes, prêmios, reconhecimentos, etc."></textarea>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Trabalho Voluntário</label>
                    <textarea name="additional[volunteer]" class="form-textarea" rows="2" placeholder="Experiências em trabalho voluntário, ONGs, etc."></textarea>
                </div>
            </div>

            <!-- Generate Button -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary" id="generateBtn">
                    <i class="fas fa-file-pdf"></i>
                    Gerar Currículo PDF
                </button>
                
                <button type="button" class="btn btn-secondary" onclick="fillExample()">
                    <i class="fas fa-magic"></i>
                    Preencher Exemplo
                </button>
                
                <button type="button" class="btn btn-secondary" onclick="clearForm()">
                    <i class="fas fa-undo"></i>
                    Limpar Formulário
                </button>
            </div>
        </form>

        <!-- Loading State -->
        <div id="loadingState" class="loading-state hidden">
            <div class="loading-spinner"></div>
            <p>Gerando seu currículo profissional...</p>
        </div>

        <!-- Success State -->
        <div id="successState" class="success-state hidden">
            <div class="success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h3>Currículo Gerado com Sucesso!</h3>
            <p>Seu currículo profissional foi criado e já deve ter iniciado o download.</p>
            <div class="success-actions">
                <a href="#" id="downloadLink" class="btn btn-primary">
                    <i class="fas fa-download"></i>
                    Baixar Novamente
                </a>
                <button type="button" class="btn btn-success" onclick="generateAnother()">
                    <i class="fas fa-plus"></i>
                    Criar Novo Currículo
                </button>
                <button type="button" class="btn btn-secondary" onclick="resetForm()">
                    <i class="fas fa-edit"></i>
                    Editar Atual
                </button>
            </div>
            
            <!-- Dica melhorada -->
            <div style="margin-top: 2rem; padding: 1.5rem; background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 0.75rem;">
                <h4 style="color: #10b981; font-size: 1rem; margin: 0 0 0.5rem 0; font-weight: 600;">
                    <i class="fas fa-lightbulb" style="margin-right: 0.5rem;"></i>
                    Dicas Profissionais:
                </h4>
                <ul style="color: #10b981; font-size: 0.875rem; margin: 0; padding-left: 1.5rem;">
                    <li>Experimente diferentes templates para sua área</li>
                    <li>Personalize o conteúdo para cada vaga</li>
                    <li>Use palavras-chave relevantes da sua profissão</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
/* Template Selection */
.template-section {
    margin-bottom: 3rem;
    padding-bottom: 2rem;
    border-bottom: 1px solid rgba(71, 85, 105, 0.3);
}

.template-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-top: 1rem;
}

.template-card {
    background: rgba(15, 23, 42, 0.5);
    border: 2px solid rgba(71, 85, 105, 0.3);
    border-radius: 0.75rem;
    padding: 1.5rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.template-card:hover {
    border-color: rgba(234, 179, 8, 0.5);
    transform: translateY(-4px);
}

.template-card.active {
    border-color: var(--accent-400);
    background: rgba(234, 179, 8, 0.1);
}

.template-preview {
    width: 100%;
    height: 120px;
    background: rgba(30, 41, 59, 0.8);
    border-radius: 0.5rem;
    margin-bottom: 1rem;
    overflow: hidden;
}

.template-header {
    height: 30px;
    width: 100%;
}

.template-content {
    padding: 0.75rem;
}

.template-line {
    height: 4px;
    background: rgba(148, 163, 184, 0.5);
    border-radius: 2px;
    margin-bottom: 0.5rem;
}

.template-line.short {
    width: 60%;
}

.template-card h4 {
    color: #f1f5f9;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.template-card p {
    color: #9ca3af;
    font-size: 0.875rem;
}

/* Form Sections */
.form-section {
    margin-bottom: 3rem;
    padding-bottom: 2rem;
    border-bottom: 1px solid rgba(71, 85, 105, 0.3);
}

.form-section:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.section-title {
    color: var(--accent-400);
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

/* Dynamic Items */
.experience-item,
.education-item,
.language-item {
    background: rgba(15, 23, 42, 0.3);
    border: 1px solid rgba(71, 85, 105, 0.3);
    border-radius: 0.75rem;
    padding: 1.5rem;
    margin-bottom: 1rem;
    position: relative;
}

.add-item-btn {
    background: rgba(59, 130, 246, 0.2);
    border: 1px solid rgba(59, 130, 246, 0.3);
    color: #3b82f6;
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    width: 100%;
    justify-content: center;
}

.add-item-btn:hover {
    background: rgba(59, 130, 246, 0.3);
    border-color: rgba(59, 130, 246, 0.5);
    transform: translateY(-2px);
}

.remove-item-btn {
    background: rgba(239, 68, 68, 0.2);
    border: 1px solid rgba(239, 68, 68, 0.3);
    color: #ef4444;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.3s ease;
    position: absolute;
    top: 1rem;
    right: 1rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.remove-item-btn:hover {
    background: rgba(239, 68, 68, 0.3);
    border-color: rgba(239, 68, 68, 0.5);
}

/* Checkbox */
.checkbox-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-top: 0.5rem;
    color: #cbd5e1;
    font-size: 0.875rem;
    cursor: pointer;
}

.checkbox-label input[type="checkbox"] {
    accent-color: var(--accent-400);
}

/* Form Actions */
.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-top: 2rem;
}

/* Success Actions */
.success-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
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

/* Loading State */
.loading-state {
    text-align: center;
    padding: 3rem;
}

.loading-spinner {
    width: 60px;
    height: 60px;
    border: 4px solid rgba(234, 179, 8, 0.2);
    border-top: 4px solid var(--accent-400);
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin: 0 auto 1.5rem;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.loading-state p {
    color: #cbd5e1;
    font-size: 1.125rem;
}

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
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-10px);
    }
    60% {
        transform: translateY(-5px);
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

/* Responsive */
@media (max-width: 768px) {
    .template-grid {
        grid-template-columns: 1fr;
    }
    
    .form-actions,
    .success-actions {
        flex-direction: column;
    }
    
    .remove-item-btn {
        position: static;
        margin-top: 1rem;
        width: fit-content;
    }
}
</style>

<script>
let experienceCount = 1;
let educationCount = 1;
let languageCount = 1;
let selectedTemplate = 'modern';

// Template Selection
document.querySelectorAll('.template-card').forEach(card => {
    card.addEventListener('click', function() {
        document.querySelectorAll('.template-card').forEach(c => c.classList.remove('active'));
        this.classList.add('active');
        selectedTemplate = this.dataset.template;
    });
});

// Add Experience
function addExperience() {
    const container = document.getElementById('experienceContainer');
    const newItem = document.createElement('div');
    newItem.className = 'experience-item';
    newItem.innerHTML = `
        <div class="grid grid-cols-2">
            <div class="form-group">
                <label class="form-label">Cargo</label>
                <input type="text" name="experience[${experienceCount}][position]" class="form-input" placeholder="Ex: Gerente de Projetos">
            </div>
            <div class="form-group">
                <label class="form-label">Empresa</label>
                <input type="text" name="experience[${experienceCount}][company]" class="form-input" placeholder="Nome da empresa">
            </div>
        </div>
        
        <div class="grid grid-cols-2">
            <div class="form-group">
                <label class="form-label">Data Início</label>
                <input type="month" name="experience[${experienceCount}][startDate]" class="form-input">
            </div>
            <div class="form-group">
                <label class="form-label">Data Fim</label>
                <input type="month" name="experience[${experienceCount}][endDate]" class="form-input">
                <label class="checkbox-label">
                    <input type="checkbox" name="experience[${experienceCount}][current]" class="current-job">
                    Trabalho atual
                </label>
            </div>
        </div>
        
        <div class="form-group">
            <label class="form-label">Descrição das Atividades</label>
            <textarea name="experience[${experienceCount}][description]" class="form-textarea" rows="3" placeholder="Descreva suas principais responsabilidades, conquistas e resultados obtidos..."></textarea>
        </div>
        
        <button type="button" class="remove-item-btn" onclick="removeExperience(this)">
            <i class="fas fa-trash"></i> Remover
        </button>
    `;
    
    container.appendChild(newItem);
    experienceCount++;
    updateRemoveButtons('experience');
}

function removeExperience(button) {
    button.parentElement.remove();
    updateRemoveButtons('experience');
}

// Add Education
function addEducation() {
    const container = document.getElementById('educationContainer');
    const newItem = document.createElement('div');
    newItem.className = 'education-item';
    newItem.innerHTML = `
        <div class="grid grid-cols-2">
            <div class="form-group">
                <label class="form-label">Curso/Graduação</label>
                <input type="text" name="education[${educationCount}][degree]" class="form-input" placeholder="Ex: Administração de Empresas">
            </div>
            <div class="form-group">
                <label class="form-label">Instituição</label>
                <input type="text" name="education[${educationCount}][institution]" class="form-input" placeholder="Nome da instituição">
            </div>
        </div>
        
        <div class="grid grid-cols-2">
            <div class="form-group">
                <label class="form-label">Ano Início</label>
                <input type="number" name="education[${educationCount}][startYear]" class="form-input" min="1950" max="2030">
            </div>
            <div class="form-group">
                <label class="form-label">Ano Conclusão</label>
                <input type="number" name="education[${educationCount}][endYear]" class="form-input" min="1950" max="2030">
            </div>
        </div>
        
        <button type="button" class="remove-item-btn" onclick="removeEducation(this)">
            <i class="fas fa-trash"></i> Remover
        </button>
    `;
    
    container.appendChild(newItem);
    educationCount++;
    updateRemoveButtons('education');
}

function removeEducation(button) {
    button.parentElement.remove();
    updateRemoveButtons('education');
}

// Add Language
function addLanguage() {
    const container = document.getElementById('languageContainer');
    const newItem = document.createElement('div');
    newItem.className = 'language-item';
    newItem.innerHTML = `
        <div class="grid grid-cols-2">
            <div class="form-group">
                <label class="form-label">Idioma</label>
                <input type="text" name="languages[${languageCount}][language]" class="form-input" placeholder="Ex: Inglês">
            </div>
            <div class="form-group">
                <label class="form-label">Nível</label>
                <select name="languages[${languageCount}][level]" class="form-input">
                    <option value="Básico">Básico</option>
                    <option value="Intermediário">Intermediário</option>
                    <option value="Avançado">Avançado</option>
                    <option value="Fluente">Fluente</option>
                    <option value="Nativo">Nativo</option>
                </select>
            </div>
        </div>
        
        <button type="button" class="remove-item-btn" onclick="removeLanguage(this)">
            <i class="fas fa-trash"></i> Remover
        </button>
    `;
    
    container.appendChild(newItem);
    languageCount++;
    updateRemoveButtons('language');
}

function removeLanguage(button) {
    button.parentElement.remove();
    updateRemoveButtons('language');
}

// Update Remove Buttons Visibility
function updateRemoveButtons(type) {
    const containers = {
        'experience': 'experienceContainer',
        'education': 'educationContainer',
        'language': 'languageContainer'
    };
    
    const container = document.getElementById(containers[type]);
    const items = container.children;
    
    Array.from(items).forEach((item, index) => {
        const removeBtn = item.querySelector('.remove-item-btn');
        if (removeBtn) {
            removeBtn.style.display = items.length > 1 ? 'flex' : 'none';
        }
    });
}

// Current Job Checkbox Handler
document.addEventListener('change', function(e) {
    if (e.target.classList.contains('current-job')) {
        const endDateInput = e.target.closest('.form-group').querySelector('input[type="month"]');
        if (e.target.checked) {
            endDateInput.disabled = true;
            endDateInput.value = '';
            endDateInput.style.opacity = '0.5';
        } else {
            endDateInput.disabled = false;
            endDateInput.style.opacity = '1';
        }
    }
});

// Form Submission
document.getElementById('resumeForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Garantir que estamos começando do estado correto
    document.getElementById('successState').classList.add('hidden');
    document.getElementById('loadingState').classList.add('hidden');
    
    // Show loading state
    document.querySelector('.tool-content').style.display = 'none';
    document.getElementById('loadingState').classList.remove('hidden');
    
    // Scroll para o topo para mostrar o loading
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
    
    // Usar método direto de form submit que é mais compatível
    downloadWithFormSubmit();
});

// Método de download usando form submit (mais confiável)
function downloadWithFormSubmit() {
    // Criar form temporário para download
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '/tools/resume-generator/generate';
    form.target = '_blank'; // Abrir em nova aba
    form.style.display = 'none';
    
    // Adicionar CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (csrfToken) {
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = csrfToken.getAttribute('content');
        form.appendChild(csrfInput);
        console.log('CSRF Token adicionado:', csrfInput.value);
    } else {
        console.error('CSRF Token não encontrado!');
    }
    
    // Adicionar template
    const templateInput = document.createElement('input');
    templateInput.type = 'hidden';
    templateInput.name = 'template';
    templateInput.value = selectedTemplate;
    form.appendChild(templateInput);
    
    // Adicionar todos os dados do formulário
    const originalForm = document.getElementById('resumeForm');
    const formData = new FormData(originalForm);
    
    console.log('Dados do formulário:');
    for (let [key, value] of formData.entries()) {
        if (key !== 'template' && key !== '_token') { // template e token já foram adicionados
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = key;
            input.value = value;
            form.appendChild(input);
            console.log(key + ':', value);
        }
    }
    
    document.body.appendChild(form);
    
    console.log('Enviando formulário para:', form.action);
    form.submit();
    
    // Remover form após um pequeno delay
    setTimeout(() => {
        if (form.parentNode) {
            document.body.removeChild(form);
        }
    }, 1000);
    
    // SEMPRE mostrar sucesso após um delay menor - não depender do resultado do download
    setTimeout(() => {
        showSuccessState();
    }, 2000); // Reduzido para 2 segundos
}

// Função separada para mostrar o estado de sucesso
function showSuccessState() {
    // Primeiro fazer scroll para o topo
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
    
    // Depois mostrar o success state
    setTimeout(() => {
        document.getElementById('loadingState').classList.add('hidden');
        document.querySelector('.tool-content').style.display = 'block'; // Garantir que o content esteja visível
        document.getElementById('successState').classList.remove('hidden');
        
        // Configurar link de download para repetir o processo
        const downloadLink = document.getElementById('downloadLink');
        downloadLink.href = '#';
        downloadLink.onclick = function(e) {
            e.preventDefault();
            // Mostrar loading novamente
            document.getElementById('successState').classList.add('hidden');
            document.getElementById('loadingState').classList.remove('hidden');
            
            // Executar download novamente
            setTimeout(() => {
                downloadWithFormSubmit();
            }, 500);
            return false;
        };
    }, 300); // Pequeno delay para o scroll completar
}

// Clear Form
function clearForm() {
    if (confirm('Tem certeza que deseja limpar todo o formulário?')) {
        document.getElementById('resumeForm').reset();
        
        // Reset dynamic items
        experienceCount = 1;
        educationCount = 1;
        languageCount = 1;
        
        // Remove extra items
        ['experienceContainer', 'educationContainer', 'languageContainer'].forEach(containerId => {
            const container = document.getElementById(containerId);
            while (container.children.length > 1) {
                container.removeChild(container.lastChild);
            }
        });
        
        // Update remove buttons
        updateRemoveButtons('experience');
        updateRemoveButtons('education');
        updateRemoveButtons('language');
        
        // Reset template selection
        document.querySelectorAll('.template-card').forEach(card => card.classList.remove('active'));
        document.querySelector('[data-template="modern"]').classList.add('active');
        selectedTemplate = 'modern';
    }
}

// Generate Another Resume (starts fresh)
function generateAnother() {
    // Mostrar uma breve confirmação
    if (confirm('Deseja criar um novo currículo? Isso irá limpar todos os dados atuais.')) {
        // Limpar formulário
        document.getElementById('resumeForm').reset();
        
        // Reset dynamic items
        experienceCount = 1;
        educationCount = 1;
        languageCount = 1;
        
        // Remove extra items
        ['experienceContainer', 'educationContainer', 'languageContainer'].forEach(containerId => {
            const container = document.getElementById(containerId);
            while (container.children.length > 1) {
                container.removeChild(container.lastChild);
            }
        });
        
        // Update remove buttons
        updateRemoveButtons('experience');
        updateRemoveButtons('education');
        updateRemoveButtons('language');
        
        // Reset template selection
        document.querySelectorAll('.template-card').forEach(card => card.classList.remove('active'));
        document.querySelector('[data-template="modern"]').classList.add('active');
        selectedTemplate = 'modern';
        
        // Show form again
        document.getElementById('successState').classList.add('hidden');
        document.querySelector('.tool-content').style.display = 'block';
        
        // Scroll to top smoothly
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
        
        // Focus on first input after animation
        setTimeout(() => {
            document.querySelector('input[name="fullName"]').focus();
        }, 800);
        
        // Mostrar mensagem de sucesso
        setTimeout(() => {
            alert('Formulário limpo! Você pode criar um novo currículo.');
        }, 1000);
    }
}

// Reset Form (edit current - just go back to form)
function resetForm() {
    // Esconder success state e mostrar form
    document.getElementById('successState').classList.add('hidden');
    document.querySelector('.tool-content').style.display = 'block';
    
    // Scroll to top smoothly
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
    
    // Focus no primeiro campo após scroll
    setTimeout(() => {
        document.querySelector('input[name="fullName"]').focus();
    }, 500);
}

// Fill Example Data
function fillExample() {
    // Personal Information
    document.querySelector('input[name="fullName"]').value = 'Maria Silva Santos';
    document.querySelector('input[name="position"]').value = 'Gerente de Marketing Digital';
    document.querySelector('input[name="email"]').value = 'maria.santos@email.com';
    document.querySelector('input[name="phone"]').value = '(11) 99999-8888';
    document.querySelector('input[name="linkedin"]').value = 'https://linkedin.com/in/maria-santos';
    document.querySelector('input[name="website"]').value = 'https://mariasantos.com.br';
    document.querySelector('input[name="location"]').value = 'São Paulo, SP - Brasil';
    document.querySelector('textarea[name="summary"]').value = 'Profissional experiente em Marketing Digital com mais de 8 anos de atuação no mercado. Especialista em estratégias de crescimento, gestão de campanhas digitais e análise de dados. Histórico comprovado de aumento de ROI em mais de 150% em campanhas digitais e liderança de equipes multidisciplinares.';
    
    // Experience
    document.querySelector('input[name="experience[0][position]"]').value = 'Gerente de Marketing Digital';
    document.querySelector('input[name="experience[0][company]"]').value = 'TechCorp Brasil';
    document.querySelector('input[name="experience[0][startDate]"]').value = '2020-03';
    document.querySelector('input[name="experience[0][current]"]').checked = true;
    document.querySelector('input[name="experience[0][endDate]"]').disabled = true;
    document.querySelector('input[name="experience[0][endDate]"]').style.opacity = '0.5';
    document.querySelector('textarea[name="experience[0][description]"]').value = 'Responsável pela estratégia completa de marketing digital da empresa. Gerencio equipe de 12 profissionais e orçamento anual de R$ 2,5 milhões. Principais conquistas: aumento de 180% no tráfego orgânico, crescimento de 250% em leads qualificados e redução de 40% no CAC.';
    
    // Education
    document.querySelector('input[name="education[0][degree]"]').value = 'MBA em Marketing Digital';
    document.querySelector('input[name="education[0][institution]"]').value = 'FGV - Fundação Getúlio Vargas';
    document.querySelector('input[name="education[0][startYear]"]').value = '2018';
    document.querySelector('input[name="education[0][endYear]"]').value = '2020';
    
    // Skills
    document.querySelector('input[name="skills[technical]"]').value = 'Google Analytics, Google Ads, Facebook Ads, SEO/SEM, HubSpot, Salesforce, Power BI, Excel Avançado';
    document.querySelector('input[name="skills[interpersonal]"]').value = 'Liderança de Equipes, Comunicação Estratégica, Negociação, Gestão de Projetos, Pensamento Analítico';
    document.querySelector('input[name="skills[specialization]"]').value = 'Marketing Digital, Growth Hacking, Análise de Dados, E-commerce, Automação de Marketing';
    document.querySelector('input[name="skills[certifications]"]').value = 'Google Analytics Certified, Google Ads Certified, HubSpot Content Marketing, Facebook Blueprint';
    
    // Languages
    document.querySelector('input[name="languages[0][language]"]').value = 'Inglês';
    document.querySelector('select[name="languages[0][level]"]').value = 'Fluente';
    
    // Additional Information
    document.querySelector('textarea[name="additional[courses]"]').value = 'Curso de Growth Hacking (Udemy, 2023), Certificação em Data Analytics (Coursera, 2022), Workshop de Liderança Feminina (Endeavor, 2021)';
    document.querySelector('textarea[name="additional[projects]"]').value = 'Projeto de transformação digital que resultou em 300% de aumento nas vendas online. Palestrante em 5 eventos de marketing digital. Mentora de 15 profissionais júnior na área.';
    document.querySelector('textarea[name="additional[volunteer]"]').value = 'Voluntária na ONG Programaria, ensinando marketing digital para mulheres empreendedoras (2019-presente)';
    
    alert('Dados de exemplo preenchidos! Agora você pode gerar o currículo.');
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    updateRemoveButtons('experience');
    updateRemoveButtons('education');
    updateRemoveButtons('language');
});
</script>
@endsection 