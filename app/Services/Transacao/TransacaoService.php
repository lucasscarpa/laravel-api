<?php

namespace App\Services\Transacao;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Services\Transacao\TransacaoDebito;
use App\Services\Transacao\TransacaoCredito;
use App\Repositories\Conta\IContaRepository;
use App\Services\Transacao\TransacaoPix;
use App\DTO\Transacao\TransacaoDTO;
use App\DTO\Conta\ContaDTO;
use App\Models\Conta;

class TransacaoService
{
    protected $transacaoDTO;
    protected $contaRepository;

    public function __construct(IContaRepository $contaRepository)
    {
        $this->contaRepository = $contaRepository;
    }

    public function criarTransacao()
    {
        switch ($this->transacaoDTO->forma_pagamento) {
            case 'C':
                return new TransacaoCredito($this->transacaoDTO->valor);
            case 'D':
                return new TransacaoDebito($this->transacaoDTO->valor);
            case 'P':
                return new TransacaoPix($this->transacaoDTO->valor);
            default:
                return null;
        }
    }

    public function processaTransacao(TransacaoDTO $transacaoDTO)
    {
        $this->transacaoDTO = $transacaoDTO;

        $conta = $this->contaRepository->find($transacaoDTO->conta_id);
        $contaDTO = new ContaDTO($conta->saldo, $conta->id);

        $taxa = $this->criarTransacao()->calcularTaxa();
        $saldo = $contaDTO->saldo - ($transacaoDTO->valor + $taxa);

        if ( $saldo < 0 ) throw new NotFoundHttpException('Saldo insuficiente');

        $contaDTO->setSaldo($saldo);
        $conta = $this->contaRepository->update($contaDTO);
    
        return $contaDTO;
    }
}
