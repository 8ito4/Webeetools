<?php

namespace App\Services\Resume;

use Illuminate\Support\Facades\Log;

class ResumeGeneratorService
{
    public function generatePdf(array $data): string
    {
        Log::info('Iniciando geração de currículo', [
            'nome' => $data['personal']['fullName'],
            'template' => $data['template']
        ]);

        if (!class_exists('TCPDF')) {
            throw new \Exception('Biblioteca TCPDF não encontrada. Execute: composer require tecnickcom/tcpdf');
        }

        Log::info('Dados coletados para o PDF', ['template' => $data['template']]);

        $pdf = $this->createResumePDF($data);

        Log::info('PDF gerado com sucesso', [
            'arquivo' => $this->generateFileName($data['personal']['fullName']),
            'tamanho' => strlen($pdf)
        ]);

        return $pdf;
    }

    public function formatExperienceData(array $experience): array
    {
        $formatted = [];
        foreach ($experience as $exp) {
            if (!empty($exp['position']) && !empty($exp['company'])) {
                $formatted[] = [
                    'position' => $exp['position'],
                    'company' => $exp['company'],
                    'startDate' => $exp['startDate'] ?? null,
                    'endDate' => isset($exp['current']) && $exp['current'] ? 'Atual' : ($exp['endDate'] ?? null),
                    'description' => $exp['description'] ?? ''
                ];
            }
        }
        return $formatted;
    }

    public function formatEducationData(array $education): array
    {
        $formatted = [];
        foreach ($education as $edu) {
            if (!empty($edu['degree']) && !empty($edu['institution'])) {
                $formatted[] = [
                    'degree' => $edu['degree'],
                    'institution' => $edu['institution'],
                    'startYear' => $edu['startYear'] ?? null,
                    'endYear' => $edu['endYear'] ?? null
                ];
            }
        }
        return $formatted;
    }

    public function formatLanguagesData(array $languages): array
    {
        $formatted = [];
        foreach ($languages as $lang) {
            if (!empty($lang['language'])) {
                $formatted[] = [
                    'language' => $lang['language'],
                    'level' => $lang['level'] ?? 'Básico'
                ];
            }
        }
        return $formatted;
    }

    public function generateFileName(string $fullName): string
    {
        return 'curriculo_' . str_replace(' ', '_', strtolower($fullName)) . '_' . date('Y-m-d') . '.pdf';
    }

    private function createResumePDF(array $data): string
    {
        $pdf = new \TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        
        $pdf->SetCreator('Webeetools');
        $pdf->SetAuthor($data['personal']['fullName']);
        $pdf->SetTitle('Currículo - ' . $data['personal']['fullName']);
        $pdf->SetSubject('Currículo Profissional');
        
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        
        $pdf->SetMargins(15, 15, 15);
        $pdf->SetAutoPageBreak(true, 15);
        
        $pdf->AddPage();
        
        switch ($data['template']) {
            case 'modern':
                $this->generateModernTemplate($pdf, $data);
                break;
            case 'classic':
                $this->generateClassicTemplate($pdf, $data);
                break;
            case 'creative':
                $this->generateCreativeTemplate($pdf, $data);
                break;
            default:
                $this->generateModernTemplate($pdf, $data);
        }
        
        return $pdf->Output('curriculo.pdf', 'S');
    }

    private function generateModernTemplate($pdf, $data): void
    {
        $primaryColor = [59, 130, 246];
        $accentColor = [29, 78, 216];
        $textColor = [31, 41, 55];
        
        $y = 20;
        
        $pdf->SetFillColor($primaryColor[0], $primaryColor[1], $primaryColor[2]);
        $pdf->Rect(0, 0, 210, 70, 'F');
        
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('helvetica', 'B', 28);
        $pdf->SetXY(20, 20);
        $pdf->Cell(0, 15, $data['personal']['fullName'], 0, 1, 'L');
        
        $pdf->SetFont('helvetica', '', 16);
        $pdf->SetXY(20, 35);
        $pdf->Cell(0, 10, $data['personal']['position'], 0, 1, 'L');
        
        $pdf->SetFont('helvetica', '', 10);
        $pdf->SetXY(20, 50);
        $contactInfo = [];
        if (!empty($data['personal']['email'])) $contactInfo[] = $data['personal']['email'];
        if (!empty($data['personal']['phone'])) $contactInfo[] = $data['personal']['phone'];
        if (!empty($data['personal']['location'])) $contactInfo[] = $data['personal']['location'];
        $pdf->Cell(0, 5, implode(' | ', $contactInfo), 0, 1, 'L');
        
        if (!empty($data['personal']['linkedin']) || !empty($data['personal']['website'])) {
            $pdf->SetXY(20, 58);
            $links = [];
            if (!empty($data['personal']['linkedin'])) $links[] = $data['personal']['linkedin'];
            if (!empty($data['personal']['website'])) $links[] = $data['personal']['website'];
            $pdf->Cell(0, 5, implode(' | ', $links), 0, 1, 'L');
        }
        
        $pdf->SetTextColor($textColor[0], $textColor[1], $textColor[2]);
        $y = 85;
        
        if (!empty($data['personal']['summary'])) {
            $pdf->SetFont('helvetica', 'B', 14);
            $pdf->SetXY(20, $y);
            $pdf->Cell(0, 8, 'RESUMO PROFISSIONAL', 0, 1, 'L');
            $y += 12;
            
            $pdf->SetFont('helvetica', '', 10);
            $pdf->SetXY(20, $y);
            $pdf->MultiCell(170, 5, $data['personal']['summary'], 0, 'J');
            $y = $pdf->GetY() + 8;
        }
        
        if (!empty($data['experience'])) {
            $pdf->SetFont('helvetica', 'B', 14);
            $pdf->SetXY(20, $y);
            $pdf->Cell(0, 8, 'EXPERIÊNCIA PROFISSIONAL', 0, 1, 'L');
            $y += 12;
            
            foreach ($data['experience'] as $exp) {
                $pdf->SetFont('helvetica', 'B', 11);
                $pdf->SetXY(20, $y);
                $pdf->Cell(0, 6, $exp['position'], 0, 1, 'L');
                $y += 6;
                
                $pdf->SetFont('helvetica', '', 10);
                $pdf->SetXY(20, $y);
                $period = '';
                if ($exp['startDate']) $period .= $exp['startDate'];
                if ($exp['endDate']) $period .= ' - ' . $exp['endDate'];
                $pdf->Cell(0, 5, $exp['company'] . ($period ? ' (' . $period . ')' : ''), 0, 1, 'L');
                $y += 6;
                
                if (!empty($exp['description'])) {
                    $pdf->SetXY(20, $y);
                    $pdf->MultiCell(170, 4, $exp['description'], 0, 'L');
                    $y = $pdf->GetY() + 4;
                }
                $y += 3;
            }
        }
        
        if (!empty($data['education'])) {
            $pdf->SetFont('helvetica', 'B', 14);
            $pdf->SetXY(20, $y);
            $pdf->Cell(0, 8, 'FORMAÇÃO ACADÊMICA', 0, 1, 'L');
            $y += 12;
            
            foreach ($data['education'] as $edu) {
                $pdf->SetFont('helvetica', 'B', 11);
                $pdf->SetXY(20, $y);
                $pdf->Cell(0, 6, $edu['degree'], 0, 1, 'L');
                $y += 6;
                
                $pdf->SetFont('helvetica', '', 10);
                $pdf->SetXY(20, $y);
                $period = '';
                if ($edu['startYear']) $period .= $edu['startYear'];
                if ($edu['endYear']) $period .= ' - ' . $edu['endYear'];
                $pdf->Cell(0, 5, $edu['institution'] . ($period ? ' (' . $period . ')' : ''), 0, 1, 'L');
                $y += 8;
            }
        }
        
        if (!empty(array_filter($data['skills']))) {
            $pdf->SetFont('helvetica', 'B', 14);
            $pdf->SetXY(20, $y);
            $pdf->Cell(0, 8, 'COMPETÊNCIAS', 0, 1, 'L');
            $y += 12;
            
            if (!empty($data['skills']['technical'])) {
                $pdf->SetFont('helvetica', 'B', 10);
                $pdf->SetXY(20, $y);
                $pdf->Cell(0, 5, 'Técnicas:', 0, 1, 'L');
                $y += 5;
                $pdf->SetFont('helvetica', '', 10);
                $pdf->SetXY(20, $y);
                $pdf->MultiCell(170, 4, $data['skills']['technical'], 0, 'L');
                $y = $pdf->GetY() + 3;
            }
            
            if (!empty($data['skills']['interpersonal'])) {
                $pdf->SetFont('helvetica', 'B', 10);
                $pdf->SetXY(20, $y);
                $pdf->Cell(0, 5, 'Interpessoais:', 0, 1, 'L');
                $y += 5;
                $pdf->SetFont('helvetica', '', 10);
                $pdf->SetXY(20, $y);
                $pdf->MultiCell(170, 4, $data['skills']['interpersonal'], 0, 'L');
                $y = $pdf->GetY() + 3;
            }
        }
        
        if (!empty($data['languages'])) {
            $pdf->SetFont('helvetica', 'B', 14);
            $pdf->SetXY(20, $y);
            $pdf->Cell(0, 8, 'IDIOMAS', 0, 1, 'L');
            $y += 12;
            
            foreach ($data['languages'] as $lang) {
                $pdf->SetFont('helvetica', '', 10);
                $pdf->SetXY(20, $y);
                $pdf->Cell(0, 5, $lang['language'] . ' - ' . $lang['level'], 0, 1, 'L');
                $y += 5;
            }
        }
    }

    private function generateClassicTemplate($pdf, $data): void
    {
        $pdf->SetFont('helvetica', 'B', 20);
        $pdf->SetXY(20, 20);
        $pdf->Cell(0, 10, $data['personal']['fullName'], 0, 1, 'C');
        
        $pdf->SetFont('helvetica', '', 12);
        $pdf->SetXY(20, 35);
        $pdf->Cell(0, 8, $data['personal']['position'], 0, 1, 'C');
        
        $y = 50;
        $pdf->SetFont('helvetica', '', 10);
        $pdf->SetXY(20, $y);
        $contactInfo = [];
        if (!empty($data['personal']['email'])) $contactInfo[] = $data['personal']['email'];
        if (!empty($data['personal']['phone'])) $contactInfo[] = $data['personal']['phone'];
        if (!empty($data['personal']['location'])) $contactInfo[] = $data['personal']['location'];
        $pdf->Cell(0, 5, implode(' | ', $contactInfo), 0, 1, 'C');
        $y += 15;
        
        if (!empty($data['personal']['summary'])) {
            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->SetXY(20, $y);
            $pdf->Cell(0, 8, 'OBJETIVO', 0, 1, 'L');
            $y += 10;
            
            $pdf->SetFont('helvetica', '', 10);
            $pdf->SetXY(20, $y);
            $pdf->MultiCell(170, 5, $data['personal']['summary'], 0, 'J');
            $y = $pdf->GetY() + 8;
        }
        
        if (!empty($data['experience'])) {
            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->SetXY(20, $y);
            $pdf->Cell(0, 8, 'EXPERIÊNCIA PROFISSIONAL', 0, 1, 'L');
            $y += 10;
            
            foreach ($data['experience'] as $exp) {
                $pdf->SetFont('helvetica', 'B', 10);
                $pdf->SetXY(20, $y);
                $pdf->Cell(0, 6, $exp['position'] . ' - ' . $exp['company'], 0, 1, 'L');
                $y += 6;
                
                $pdf->SetFont('helvetica', '', 9);
                $pdf->SetXY(20, $y);
                $period = '';
                if ($exp['startDate']) $period .= $exp['startDate'];
                if ($exp['endDate']) $period .= ' - ' . $exp['endDate'];
                if ($period) {
                    $pdf->Cell(0, 5, $period, 0, 1, 'L');
                    $y += 5;
                }
                
                if (!empty($exp['description'])) {
                    $pdf->SetXY(20, $y);
                    $pdf->MultiCell(170, 4, $exp['description'], 0, 'L');
                    $y = $pdf->GetY() + 4;
                }
                $y += 3;
            }
        }
        
        if (!empty($data['education'])) {
            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->SetXY(20, $y);
            $pdf->Cell(0, 8, 'FORMAÇÃO', 0, 1, 'L');
            $y += 10;
            
            foreach ($data['education'] as $edu) {
                $pdf->SetFont('helvetica', 'B', 10);
                $pdf->SetXY(20, $y);
                $pdf->Cell(0, 6, $edu['degree'], 0, 1, 'L');
                $y += 6;
                
                $pdf->SetFont('helvetica', '', 9);
                $pdf->SetXY(20, $y);
                $period = '';
                if ($edu['startYear']) $period .= $edu['startYear'];
                if ($edu['endYear']) $period .= ' - ' . $edu['endYear'];
                $pdf->Cell(0, 5, $edu['institution'] . ($period ? ' (' . $period . ')' : ''), 0, 1, 'L');
                $y += 8;
            }
        }
    }

    private function generateCreativeTemplate($pdf, $data): void
    {
        $accentColor = [220, 38, 127];
        $darkColor = [17, 24, 39];
        
        $pdf->SetFillColor($accentColor[0], $accentColor[1], $accentColor[2]);
        $pdf->Rect(0, 0, 60, 297, 'F');
        
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('helvetica', 'B', 18);
        $pdf->SetXY(5, 30);
        $pdf->MultiCell(50, 8, $data['personal']['fullName'], 0, 'C');
        
        $pdf->SetFont('helvetica', '', 12);
        $pdf->SetXY(5, 60);
        $pdf->MultiCell(50, 6, $data['personal']['position'], 0, 'C');
        
        $y = 85;
        $pdf->SetFont('helvetica', '', 8);
        if (!empty($data['personal']['email'])) {
            $pdf->SetXY(5, $y);
            $pdf->MultiCell(50, 4, $data['personal']['email'], 0, 'C');
            $y += 8;
        }
        if (!empty($data['personal']['phone'])) {
            $pdf->SetXY(5, $y);
            $pdf->MultiCell(50, 4, $data['personal']['phone'], 0, 'C');
            $y += 8;
        }
        
        if (!empty($data['languages'])) {
            $y += 10;
            $pdf->SetFont('helvetica', 'B', 10);
            $pdf->SetXY(5, $y);
            $pdf->Cell(50, 6, 'IDIOMAS', 0, 1, 'C');
            $y += 8;
            
            foreach ($data['languages'] as $lang) {
                $pdf->SetFont('helvetica', '', 8);
                $pdf->SetXY(5, $y);
                $pdf->MultiCell(50, 4, $lang['language'] . ' - ' . $lang['level'], 0, 'C');
                $y += 6;
            }
        }
        
        $pdf->SetTextColor($darkColor[0], $darkColor[1], $darkColor[2]);
        $y = 30;
        
        if (!empty($data['personal']['summary'])) {
            $pdf->SetFont('helvetica', 'B', 14);
            $pdf->SetXY(70, $y);
            $pdf->Cell(0, 8, 'PERFIL PROFISSIONAL', 0, 1, 'L');
            $y += 12;
            
            $pdf->SetFont('helvetica', '', 10);
            $pdf->SetXY(70, $y);
            $pdf->MultiCell(120, 5, $data['personal']['summary'], 0, 'J');
            $y = $pdf->GetY() + 8;
        }
        
        if (!empty($data['experience'])) {
            $pdf->SetFont('helvetica', 'B', 14);
            $pdf->SetXY(70, $y);
            $pdf->Cell(0, 8, 'EXPERIÊNCIA', 0, 1, 'L');
            $y += 12;
            
            foreach ($data['experience'] as $exp) {
                $pdf->SetFont('helvetica', 'B', 11);
                $pdf->SetXY(70, $y);
                $pdf->Cell(0, 6, $exp['position'], 0, 1, 'L');
                $y += 6;
                
                $pdf->SetFont('helvetica', '', 10);
                $pdf->SetXY(70, $y);
                $period = '';
                if ($exp['startDate']) $period .= $exp['startDate'];
                if ($exp['endDate']) $period .= ' - ' . $exp['endDate'];
                $pdf->Cell(0, 5, $exp['company'] . ($period ? ' (' . $period . ')' : ''), 0, 1, 'L');
                $y += 6;
                
                if (!empty($exp['description'])) {
                    $pdf->SetXY(70, $y);
                    $pdf->MultiCell(120, 4, $exp['description'], 0, 'L');
                    $y = $pdf->GetY() + 4;
                }
                $y += 3;
            }
        }
        
        if (!empty($data['education'])) {
            $pdf->SetFont('helvetica', 'B', 14);
            $pdf->SetXY(70, $y);
            $pdf->Cell(0, 8, 'EDUCAÇÃO', 0, 1, 'L');
            $y += 12;
            
            foreach ($data['education'] as $edu) {
                $pdf->SetFont('helvetica', 'B', 11);
                $pdf->SetXY(70, $y);
                $pdf->Cell(0, 6, $edu['degree'], 0, 1, 'L');
                $y += 6;
                
                $pdf->SetFont('helvetica', '', 10);
                $pdf->SetXY(70, $y);
                $period = '';
                if ($edu['startYear']) $period .= $edu['startYear'];
                if ($edu['endYear']) $period .= ' - ' . $edu['endYear'];
                $pdf->Cell(0, 5, $edu['institution'] . ($period ? ' (' . $period . ')' : ''), 0, 1, 'L');
                $y += 8;
            }
        }
    }
} 