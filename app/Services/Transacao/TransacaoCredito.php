<?php

namespace App\Services\Transacao;

use App\Services\Transacao\interfaces\Transacao;

class TransacaoCredito implements Transacao
{
    protected $transacaoDTO;

    public function __construct($transacaoDTO)
    {
        $this->transacaoDTO = $transacaoDTO;
    }

    public function calcularTaxa()
    {
        $taxa = $this->transacaoDTO->valor * 0.05;
        $this->transacaoDTO->setTaxa($taxa);

        return $taxa;
    }
}
