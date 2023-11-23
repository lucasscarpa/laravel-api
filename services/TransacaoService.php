<?php

namespace Services;

use App\Conta;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TransacaoService
{
    public function executa($conta_id, $valor, $forma_pagamento)
    {
        $conta = Conta::find($conta_id);

        if (!$conta) return 'conta nao encontrada';

        $valor = $this->aplicaTaxa($valor, $forma_pagamento);

        if ($conta->saldo < $valor) return 'saldo insuficiente';
    }

    private function aplicaTaxa($valor, $forma_pagamento)
    {
    }
}
