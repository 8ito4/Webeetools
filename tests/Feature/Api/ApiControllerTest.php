<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_gera_link_whatsapp_com_sucesso(): void
    {
        $response = $this->postJson('/api/v1/whatsapp/generate', [
            'phone' => '+5511999999999',
            'message' => 'Olá, teste!',
            'shorten' => true
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'success',
                     'data' => [
                         'original_url',
                         'short_url',
                         'phone',
                         'message'
                     ],
                     'meta' => [
                         'generated_at'
                     ]
                 ])
                 ->assertJson([
                     'success' => true
                 ]);
    }

    public function test_gera_link_whatsapp_falha_validacao(): void
    {
        $response = $this->postJson('/api/v1/whatsapp/generate', [
            'phone' => '123', // Muito curto
            'message' => str_repeat('a', 1001) // Muito longo
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['phone', 'message']);
    }

    public function test_formata_json_com_sucesso(): void
    {
        $jsonData = '{"name":"John","age":30}';
        
        $response = $this->postJson('/api/v1/json/format', [
            'json' => $jsonData,
            'action' => 'format',
            'indent' => 2
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'success',
                     'data' => [
                         'formatted',
                         'size',
                         'lines'
                     ]
                 ])
                 ->assertJson([
                     'success' => true
                 ]);
    }

    public function test_formata_json_invalido_falha(): void
    {
        $response = $this->postJson('/api/v1/json/format', [
            'json' => '{"invalid": json}', // JSON inválido
            'action' => 'format'
        ]);

        $response->assertStatus(422)
                 ->assertJsonFragment([
                     'success' => false
                 ]);
    }

    public function test_gera_senha_com_sucesso(): void
    {
        $response = $this->getJson('/api/v1/password/generate?' . http_build_query([
            'length' => 16,
            'uppercase' => true,
            'lowercase' => true,
            'numbers' => true,
            'symbols' => false
        ]));

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'success',
                     'data' => [
                         'password',
                         'length',
                         'strength',
                         'options'
                     ]
                 ])
                 ->assertJson([
                     'success' => true,
                     'data' => [
                         'length' => 16
                     ]
                 ]);
    }

    public function test_gera_lorem_ipsum_com_sucesso(): void
    {
        $response = $this->getJson('/api/v1/lorem/generate?' . http_build_query([
            'type' => 'paragraphs',
            'count' => 2,
            'start_with_lorem' => true
        ]));

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'success',
                     'data' => [
                         'text',
                         'paragraph_count'
                     ]
                 ])
                 ->assertJson([
                     'success' => true
                 ]);
    }
} 