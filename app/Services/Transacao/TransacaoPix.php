<?php

namespace App\Services\Transacao;

use App\Services\Transacao\interfaces\Transacao;
use App\DTO\Transacao\transacaoDTO;

class TransacaoPix implements Transacao
{
    protected $transacaoDTO;

    public function __construct($transacaoDTO)
    {
        $this->transacaoDTO = $transacaoDTO;
    }

    public function calcularTaxa()
    {
        $taxa = 0;
        $this->transacaoDTO->setTaxa($taxa);

        return $taxa;
    }
}
