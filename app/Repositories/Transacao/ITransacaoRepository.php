<?php

namespace App\Repositories\Transacao;

use App\DTO\Transacao\TransacaoDTO;

interface ITransacaoRepository
{
    public function find(int $id);
    public function create(TransacaoDTO $transacaoDTO);
    public function update(TransacaoDTO $transacaoDTO);
}
