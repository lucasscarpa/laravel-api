<?php

namespace App\DTO;

use Illuminate\Contracts\Validation\Validator;

class ContaDTO extends AbstractDTO implements InterfaceDTO
{
    public float $valor;

    public function __construct(float $valor)
    {
        $this->valor = $valor;
        $this->validate();
    }

    public function rules():array {
        return [
            'valor' => 'required|min:1|max:1000000000'
        ];
    }

    public function messages():array {
        return [
            'valor' => 'Voce precisa definir um valor inicial'
        ];
    }

    public function validator():Validator {
        return validator($this->toArray(), $this->rules(), $this->messages());
    }

    public function validate() {
        return $this->validator()->validate();
    }
}
