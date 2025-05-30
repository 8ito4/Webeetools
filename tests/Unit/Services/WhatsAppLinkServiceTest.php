<?php

namespace Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use App\Services\Api\WhatsAppLinkService;
use App\Config\WhatsAppConfig;
use App\DTO\WhatsAppLinkData;
use Mockery;

class WhatsAppLinkServiceTest extends TestCase
{
    private WhatsAppLinkService $service;
    private WhatsAppConfig $config;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->config = new WhatsAppConfig(
            baseUrl: 'https://wa.me',
            shortUrlDomain: 'test.link',
            maxMessageLength: 1000,
            maxPhoneLength: 20,
            minPhoneLength: 8
        );
        
        // Mock the service to avoid Facade usage
        $this->service = new class($this->config) extends WhatsAppLinkService {
            protected function logInfo(string $message, array $context = []): void
            {
                // Mock logging - do nothing in tests
            }
        };
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_gera_link_whatsapp_simples(): void
    {
        $data = new WhatsAppLinkData(
            phone: '+5511999999999',
            message: null,
            shorten: false
        );

        $result = $this->service->generateLink($data);

        $this->assertIsArray($result);
        $this->assertEquals('https://wa.me/+5511999999999', $result['original_url']);
        $this->assertEquals('+5511999999999', $result['phone']);
        $this->assertNull($result['short_url']);
        $this->assertNull($result['message']);
    }

    public function test_gera_link_whatsapp_com_mensagem(): void
    {
        $data = new WhatsAppLinkData(
            phone: '11999999999',
            message: 'Olá! Como posso ajudar?',
            shorten: false
        );

        $result = $this->service->generateLink($data);

        $this->assertStringContainsString('?text=', $result['original_url']);
        $this->assertStringContainsString('Ol%C3%A1%21', $result['original_url']); // URL encoded
        $this->assertEquals('Olá! Como posso ajudar?', $result['message']);
    }

    public function test_gera_link_encurtado(): void
    {
        $data = new WhatsAppLinkData(
            phone: '11999999999',
            message: null,
            shorten: true
        );

        $result = $this->service->generateLink($data);

        $this->assertNotNull($result['short_url']);
        $this->assertStringStartsWith('https://test.link/', $result['short_url']);
    }

    public function test_sanitiza_telefone_corretamente(): void
    {
        $data = new WhatsAppLinkData(
            phone: '+55 (11) 99999-9999',
            message: null,
            shorten: false
        );

        $result = $this->service->generateLink($data);

        $this->assertEquals('+5511999999999', $result['phone']);
        $this->assertStringContainsString('+5511999999999', $result['original_url']);
    }
} 