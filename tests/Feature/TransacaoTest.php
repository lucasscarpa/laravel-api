<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Conta;
use App\Models\Transacao;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransacaoTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Teste de uma transação via Débito
     *
     * @return void
     */
    public function test_realiza_transacao_debito()
    {
        $conta = factory(Conta::class)->create(
            [
                'saldo' => 100
            ]
        );

        $response = $this->post("/api/v1/transacao", [
            'valor' => (float) 10,
            'forma_pagamento' => 'D',
            'conta_id' => $conta->id
        ])->assertOk()->json();

        $this->assertArrayHasKey('conta', $response);
        $this->assertArrayHasKey('message', $response);
        $this->assertArrayHasKey('saldo', $response['conta']);
        $this->assertArrayHasKey('id', $response['conta']);

        $this->assertDatabaseHas('transacao', [
            'valor' => (float) 10.0,
            'forma_pagamento' => 'D',
            'conta_id' => $conta->id,
            'taxa'=> 10 * 0.03
        ]);
    }

    /**
     * Teste de uma transação via Crédito
     *
     * @return void
     */
    public function test_realiza_transacao_credito()
    {
        $conta = factory(Conta::class)->create(
            [
                'saldo' => 100
            ]
        );

        $response = $this->post("/api/v1/transacao", [
            'valor' => (float) 10,
            'forma_pagamento' => 'C',
            'conta_id' => $conta->id
        ])->assertOk()->json();

        $this->assertArrayHasKey('conta', $response);
        $this->assertArrayHasKey('message', $response);
        $this->assertArrayHasKey('saldo', $response['conta']);
        $this->assertArrayHasKey('id', $response['conta']);

        $this->assertDatabaseHas('transacao', [
            'valor' => (float) 10.0,
            'forma_pagamento' => 'C',
            'conta_id' => $conta->id,
            'taxa'=> 10 * 0.05
        ]);
    }

    /**
     * Teste de uma transação via PIX
     *
     * @return void
     */
    public function test_realiza_transacao_pix()
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
        $this->assertArrayHasKey('message', $response);
        $this->assertArrayHasKey('saldo', $response['conta']);
        $this->assertArrayHasKey('id', $response['conta']);
        
        $this->assertDatabaseHas('transacao', [
            'valor' => (float) 10.0,
            'forma_pagamento' => 'P',
            'conta_id' => $conta->id,
            'taxa'=> 0
        ]);
    }
}
