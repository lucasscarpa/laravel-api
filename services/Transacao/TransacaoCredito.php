<?php

namespace Services\Transacao;

use Services\Transacao\interfaces\Transacao;

class TransacaoCredito implements Transacao
{
    protected $valor;

    public function __construct($valor)
    {
        $this->valor = $valor;
    }

    public function calcularTaxa()
    {
        return $this->valor * 0.05;
    }
}
