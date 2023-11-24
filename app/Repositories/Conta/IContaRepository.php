<?php

namespace App\Repositories\Conta;

use App\DTO\Conta\ContaDTO;

interface IContaRepository
{
    public function find(int $id);
    public function create(array $conta);
    public function delete(object $conta);
}
