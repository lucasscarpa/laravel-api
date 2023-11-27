<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Conta;
use App\Models\Transacao;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransacaoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Teste consultando conta existente
     *
     * @return void
     */
    public function test_consulta_uma_conta_existente()
    {
        $conta = factory(Conta::class)->create(
            [
                'saldo' => 100
            ]
        );

        $response = $this->get("/api/v1/conta?id=$conta->id")->assertOk()->json();

        $this->assertArrayHasKey('conta', $response);
        $this->assertArrayHasKey('saldo', $response['conta']);
        $this->assertArrayHasKey('id', $response['conta']);
    }

    public function test_conta_inexistente()
    {
        $response = $this->get("/api/v1/conta?id=500");
        $response->assertStatus(404);
    }

    /**
     * Teste de criação de conta.
     *
     * @return void
     */
    public function test_cria_uma_nova_conta()
    {
        $response = $this->post("/api/v1/conta", [
            'saldo' => 100
        ])->assertOk()->json();

        $this->assertArrayHasKey('conta', $response);
        $this->assertArrayHasKey('mensagem', $response);
        $this->assertArrayHasKey('saldo', $response['conta']);
        $this->assertArrayHasKey('id', $response['conta']);

        $this->assertDatabaseHas('conta', [
            'id' => $response['conta']['id'],
            'saldo' => 100
        ]);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testTransacaoPix()
    {
        $conta = factory(Conta::class)->create(
            [
                'saldo' => 100
            ]
        );

        $response = $this->post("/api/v1/transacao", [
            'valor' => (float) 10,
            'forma_pagamento' => 'P',
            'conta_id' => $conta->id
        ])->assertOk()->json();

        $this->assertArrayHasKey('conta', $response);
        $this->assertArrayHasKey('mensagem', $response);
        $this->assertArrayHasKey('saldo', $response['conta']);
        $this->assertArrayHasKey('id', $response['conta']);

        $this->assertDatabaseHas('transacao', [
            'valor' => (float) 10.0,
            'forma_pagamento' => 'P',
            'conta_id' => $conta->id,
            'taxa' => 0
        ]);
    }
}
