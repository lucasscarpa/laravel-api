<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Conta;

class TransacaoTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function transacao_pode_ser_realizada()
    {
        $conta = factory(Conta::class)->create();
    }
}
