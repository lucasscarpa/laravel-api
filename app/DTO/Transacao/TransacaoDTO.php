<?php

namespace App\DTO\Transacao;

use Illuminate\Contracts\Validation\Validator;
use App\DTO\AbstractDTO;
use App\DTO\InterfaceDTO;

class TransacaoDTO extends AbstractDTO implements InterfaceDTO
{
    public $valor;
    public $conta_id;
    public $forma_pagamento;
    public $taxa;

    public function __construct($valor, $conta_id, $forma_pagamento)
    {
        $this->valor = $valor;
        $this->conta_id = $conta_id;
        $this->forma_pagamento = $forma_pagamento;
        $this->validate();
    }

    public function rules(): array
    {
        return [
            'valor'             => 'required|numeric|gt:0',
            'conta_id'          => 'required|numeric|exists:App\Models\Conta,id',
            'forma_pagamento'   => 'required|in:P,D,C'
        ];
    }

    public function messages(): array
    {
        return [
            'conta_id.*' => 'Conta informada é inválida',
            'forma_pagamento.*' => 'Forma de pagamento informada é inválida',
            '*.required' => 'É obrigatório informar um valor para o campo :attribute',
            'valor.*' => 'É obrigatório informar um valor positivo',
        ];
    }

    public function validator(): Validator
    {
        return validator($this->toArray(), $this->rules(), $this->messages());
    }

    public function validate()
    {
        return $this->validator()->validate();
    }

    public function setTaxa($taxa)
    {
        $this->taxa = $taxa;
    }
}
