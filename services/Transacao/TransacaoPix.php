<?php

namespace Services\Transacao;

use Services\Transacao\interfaces\Transacao;

class TransacaoPix implements Transacao
{
    protected $valor;

    public function __construct($valor)
    {
        $this->valor = $valor;
    }

    public function calcularTaxa()
    {
        return $this->valor;
    }
}
