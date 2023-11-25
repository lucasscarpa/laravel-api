<?php

namespace App\Repositories\Conta;

use App\Repositories\Conta\IContaRepository;
use App\Models\Conta;

class ContaRepository implements IContaRepository
{
    protected $model;

    public function __construct(Conta $conta)
    {
        $this->model = $conta;
    }

    /**
     * Seleciona a Conta por ID
     * @param int $id
     * @return object
     */
    public function find(int $id)
    {
        return $this->model->where('id', $id)->first();
    }

    /**
     * Cria uma nova categoria
     * @param array $conta
     * @return object
     */
    public function create(array $conta)
    {
        return $this->model->create($conta);
    }

    /**
     * Deleta uma categoria
     * @param object $conta
     */
    public function delete(object $conta)
    {
        return $conta->delete();
    }

    public function update(object $contaDTO)
    {
        $conta = $this->find($contaDTO->id);
        $conta->saldo = $contaDTO->saldo;
        $conta->save();

        return $conta;
    }
}
