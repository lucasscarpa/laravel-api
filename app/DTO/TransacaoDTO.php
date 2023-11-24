<?php

namespace App\DTO;

class TransacaoDTO extends AbstractDTO
{
    public float $valor;
    public int $conta_id;
    public string $forma_pagamento;

    public function __construct(float $valor, int $conta_id, string $forma_pagamento)
    {
        $this->valor = $valor;
        $this->conta_id = $conta_id;
        $this->forma_pagamento = $forma_pagamento;
    }
}
