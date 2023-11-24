<?php

namespace App\Services\Conta;

use App\DTO\Conta\ContaDTO;

interface IContaService
{
    public function getContaById(int $id);
    public function createConta(ContaDTO $contaDto);
    public function deleteConta(int $id);
}
