<?php

namespace App\Services\Transacao;

use App\Models\Conta;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\DTO\Transacao\InputModel;


class Transacao
{
    const TAXA_DEBITO = 0.03;
    const TAXA_CREDITO = 0.05;
    const TAXA_PIX = 0;

    public function executa(InputModel $input)
    {
        $conta = Conta::find($input->conta_id);

        if (!$conta) abort(404, 'Conta inválida');

        $valor = $this->aplicaTaxa($input->valor, $input->forma_pagamento);

        if ($conta->saldo < $valor) throw new NotFoundHttpException('Saldo insuficiente');

        $conta->update(['saldo' => $conta->saldo - $valor]);
        return $conta;
    }

    private function aplicaTaxa($valor, $forma_pagamento)
    {
        switch ($forma_pagamento) {
            case 'D':
                $valor += $valor * self::TAXA_DEBITO;
                break;
            case 'C':
                $valor += $valor * self::TAXA_CREDITO;
                break;
            case 'P':
                $valor += $valor * self::TAXA_PIX;
                break;
            default:
                throw new NotFoundHttpException('Tipo de transação inválida');
        }

        return $valor;
    }
}
