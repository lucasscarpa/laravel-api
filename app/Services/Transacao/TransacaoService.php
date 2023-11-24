<?php

namespace App\Services\Transacao;

use App\Services\Transacao\TransacaoDebito;
use App\Services\Transacao\TransacaoCredito;
use App\Services\Transacao\TransacaoPix;
use App\DTO\Transacao\InputModel;
use App\Conta;

class TransacaoService
{
    protected $conta;

    public function __construct(Conta $conta)
    {
        $this->conta = $conta;
    }

    public function criarTransacao($forma_pagamento, $valor)
    {
        switch ($forma_pagamento) {
            case 'C':
                return new TransacaoCredito($this->conta, $valor);
            case 'D':
                return new TransacaoDebito($this->conta, $valor);
            case 'P':
                return new TransacaoPix($this->conta, $valor);
            default:
                // Lidar com um tipo de transação desconhecido, se necessário
                return null;
        }
    }
}
