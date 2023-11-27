<?php

namespace App\Services\Conta;

use App\DTO\Conta\ContaDTO;
use App\Repositories\Conta\IContaRepository;
use App\Models\Conta;

class ContaService implements IContaService
{
    private $contaRepository;

    public function __construct(IContaRepository $contaRepository)
    {
        $this->contaRepository = $contaRepository;
    }

    public function getContaById(int $id)
    {
        return $this->contaRepository->find($id);
    }

    public function createConta(ContaDTO $contaDTO)
    {
        return $this->contaRepository->create($contaDTO);
    }

    public function deleteConta(int $id)
    {
        $conta = $this->contaRepository->find($id);
        $conta->delete();
    }
}
