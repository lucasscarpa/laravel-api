<?php

namespace App\DTO\Conta;

use Illuminate\Contracts\Validation\Validator;
use App\DTO\AbstractDTO;
use App\DTO\InterfaceDTO;

class ContaDTO extends AbstractDTO implements InterfaceDTO
{
    public float $saldo;

    public function __construct(float $saldo, ?int $id = 0)
    {
        $this->saldo = $saldo;
        $this->id = $id;

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

    public function setId($id)
    {
        return $this->id = $id;
    }

    public function setSaldo($saldo)
    {
        return $this->saldo = $saldo;
    }
}
