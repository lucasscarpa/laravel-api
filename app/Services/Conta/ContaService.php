<?php

namespace App\Services\Conta;

use App\DTO\ContaDTO;
use App\Conta;

class ContaService
{
    public function criaConta(ContaDTO $contaDTO): Conta
    {
        $conta = new Conta();
        $conta->saldo = $contaDTO->saldo;
        $conta->save();

        return $conta;
    }
}
