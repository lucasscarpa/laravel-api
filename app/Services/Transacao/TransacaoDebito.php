<?php

namespace App\Services\Transacao;

use App\Services\Transacao\interfaces\Transacao;

class TransacaoDebito implements Transacao
{
    protected $transacaoDTO;

    public function __construct($transacaoDTO)
    {
        $this->transacaoDTO = $transacaoDTO;
    }

    public function calcularTaxa()
    {
        $taxa = $this->transacaoDTO->valor * 0.03;
        $this->transacaoDTO->setTaxa($taxa);

        return $taxa;
    }
}
