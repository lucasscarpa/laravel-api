<?php

namespace App\DTO;

use Illuminate\Contracts\Validation\Validator;

class ContaDTO extends AbstractDTO implements InterfaceDTO
{
    public $saldo;

    public function __construct($saldo)
    {
        $this->saldo = $saldo;
        $this->validate();
    }

    public function rules(): array
    {
        return [
            'saldo' => 'required|numeric|gt:0'
        ];
    }

    public function messages(): array
    {
        return [
            '*required' => 'É obrigatório informar um valor para :attribute',
            'saldo.gt' => 'É obrigatório informar um saldo positivo'

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
}
