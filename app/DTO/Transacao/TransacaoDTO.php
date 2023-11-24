<?php

namespace App\DTO\Transacao;

use Illuminate\Contracts\Validation\Validator;
use App\DTO\AbstractDTO;
use App\DTO\InterfaceDTO;

class TransacaoDTO extends AbstractDTO implements InterfaceDTO
{
    public float $valor;
    public int $conta_id;
    public string $forma_pagamento;

    public function __construct(float $valor, int $conta_id, string $forma_pagamento)
    {
        $this->valor = $valor;
        $this->conta_id = $conta_id;
        $this->forma_pagamento = $forma_pagamento;
        $this->validate();
    }

    public function rules(): array
    {
        return [
            'valor'             => 'required',
            'conta_id'          => 'required|exists:conta',
            'forma_pagamento'   => 'required|in:P,D,C'
        ];
    }

    public function messages(): array
    {
        return [];
    }

    public function validator(): Validator
    {
        return validator($this->toArray(), $this->rules(), $this->messages());
    }

    public function validate()
    {
        return $this->validator()->validate();
    }
}
