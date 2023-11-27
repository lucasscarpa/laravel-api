<?php

namespace App\Repositories\Transacao;

use App\Repositories\Transacao\ITransacaoRepository;
use App\Models\Transacao;
use App\DTO\Transacao\TransacaoDTO;

class TransacaoRepository implements ITransacaoRepository
{
    protected $model;

    public function __construct(Transacao $transacao)
    {
        $this->model = $transacao;
    }

    /**
     * Seleciona a Transacao por ID
     * @param int $id
     * @return object
     */
    public function find(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * Armazena uma transacao realizada
     * @param TransacaoDTO $transacaoDTO
     * @return object
     */
    public function create(TransacaoDTO $transacaoDTO)
    {
        return $this->model->create([
            'valor'             => $transacaoDTO->valor,
            'taxa'              => $transacaoDTO->taxa,
            'conta_id'          => $transacaoDTO->conta_id,
            'forma_pagamento'   => $transacaoDTO->forma_pagamento,

        ]);
    }

    /**
     * Atualiza uma transacao realizada
     * @param TransacaoDTO $transacaoDTO
     * @return object
     */
    public function update(TransacaoDTO $transacaoDTO)
    {
        $transacao = $this->find($transacaoDTO->id);

        $transacao->valor = $transacaoDTO->valor;
        $transacao->conta_id = $transacaoDTO->conta_id;
        $transacao->forma_pagamento = $transacaoDTO->forma_pagamento;
        $transacao->taxa = $transacaoDTO->taxa;
        $transacao->save();

        return $transacao;
    }
}
