<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class TestTcpdf extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:tcpdf';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test TCPDF installation and functionality';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== TESTE COMPLETO DA TCPDF ===');
        
        // 1. Teste básico de classe
        $this->info('1. Testando se TCPDF existe via autoload...');
        $classExists = class_exists('TCPDF');
        $this->info($classExists ? '✅ TCPDF encontrada via autoload' : '❌ TCPDF NÃO encontrada via autoload');
        
        // 2. Teste de arquivo
        $tcpdfPath = base_path('vendor/tecnickcom/tcpdf/tcpdf.php');
        $this->info('2. Testando arquivo TCPDF...');
        $this->info('Path: ' . $tcpdfPath);
        $fileExists = file_exists($tcpdfPath);
        $fileReadable = is_readable($tcpdfPath);
        $this->info($fileExists ? '✅ Arquivo existe' : '❌ Arquivo NÃO existe');
        $this->info($fileReadable ? '✅ Arquivo legível' : '❌ Arquivo NÃO legível');
        
        // 3. Teste de require manual
        if (!$classExists && $fileExists) {
            $this->info('3. Tentando require manual...');
            try {
                require_once $tcpdfPath;
                $classExistsAfterRequire = class_exists('TCPDF');
                $this->info($classExistsAfterRequire ? '✅ TCPDF carregada via require' : '❌ TCPDF NÃO carregada via require');
            } catch (\Throwable $e) {
                $this->error('❌ Erro no require: ' . $e->getMessage());
            }
        }
        
        // 4. Teste de instanciação
        if (class_exists('TCPDF')) {
            $this->info('4. Testando instanciação da TCPDF...');
            try {
                $pdf = new \TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
                $this->info('✅ TCPDF instanciada com sucesso');
                
                // 5. Teste de geração básica
                $this->info('5. Testando geração de PDF...');
                $pdf->AddPage();
                $pdf->SetFont('helvetica', 'B', 16);
                $pdf->Cell(0, 10, 'Teste TCPDF', 0, 1, 'C');
                $pdfContent = $pdf->Output('teste.pdf', 'S');
                $this->info('✅ PDF gerado com sucesso (' . strlen($pdfContent) . ' bytes)');
                
            } catch (\Throwable $e) {
                $this->error('❌ Erro na instanciação/geração: ' . $e->getMessage());
                $this->error('File: ' . $e->getFile());
                $this->error('Line: ' . $e->getLine());
            }
        }
        
        // 6. Informações do ambiente
        $this->info('6. Informações do ambiente:');
        $this->info('PHP Version: ' . PHP_VERSION);
        $this->info('Memory Limit: ' . ini_get('memory_limit'));
        $this->info('Max Execution Time: ' . ini_get('max_execution_time'));
        $this->info('Current Directory: ' . getcwd());
        $this->info('Base Path: ' . base_path());
        
        // 7. Extensões carregadas (relevantes)
        $this->info('7. Extensões PHP relevantes:');
        $relevantExtensions = ['gd', 'mbstring', 'zlib', 'curl', 'openssl'];
        foreach ($relevantExtensions as $ext) {
            $loaded = extension_loaded($ext);
            $this->info($loaded ? "✅ $ext" : "❌ $ext");
        }
        
        $this->info('=== FIM DO TESTE ===');
    }
}
