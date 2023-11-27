<?php

namespace App\Repositories\Conta;

use App\DTO\Conta\ContaDTO;

interface IContaRepository
{
    public function find(int $id);
    public function create(ContaDTO $conta);
    public function delete(object $conta);
    public function update(ContaDTO $conta);
}
