<?php

namespace App\Services\Transacao;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Services\Transacao\TransacaoDebito;
use App\Services\Transacao\TransacaoCredito;
use App\Repositories\Conta\IContaRepository;
use App\Repositories\Transacao\ITransacaoRepository;
use App\Services\Transacao\TransacaoPix;
use App\DTO\Transacao\TransacaoDTO;
use App\DTO\Conta\ContaDTO;
use App\Models\Conta;

class TransacaoService
{
    protected $contaRepository;
    protected $transacaoRepository;

    public function __construct(
        IContaRepository $contaRepository,
        ITransacaoRepository $transacaoRepository
    )
    {
        $this->contaRepository = $contaRepository;
        $this->transacaoRepository = $transacaoRepository;
    }

    /**
     * Instancia uma transação conforme o tipo.
     * @param none
     * @return object
     */
    public function criaTransacao($transacaoDTO)
    {
        switch ($transacaoDTO->forma_pagamento) {
            case 'C':
                return new TransacaoCredito($transacaoDTO);
            case 'D':
                return new TransacaoDebito($transacaoDTO);
            case 'P':
                return new TransacaoPix($transacaoDTO);
            default:
                throw new NotFoundHttpException('Tipo de transação não suportada');
        }
    }

    /**
     * Realiza o processamento de uma transacao
     * @param TransacaoDTO
     * @return object
     */
    public function processaTransacao(TransacaoDTO $transacaoDTO)
    {
        //Busca a conta para realização da transacao;
        $conta = $this->contaRepository->find($transacaoDTO->conta_id);
        $contaDTO = new ContaDTO($conta->saldo, $conta->id);

        //Cria uma transação para o tipo de pagamento escolhido
        $transacao = $this->criaTransacao($transacaoDTO);

        //Calcula taxa referente ao tipo de pagamento selecionado
        $taxa = $transacao->calcularTaxa();

        //Persiste transação no banco dados
        $this->transacaoRepository->create($transacaoDTO);

        //Realiza o sado restante
        $saldo = $contaDTO->saldo - ($transacaoDTO->valor + $taxa);
        
        //Saldo não pode ser negativo
        if ( $saldo < 0 ) throw new NotFoundHttpException('Saldo insuficiente');

        //Atualiza o saldo da conta
        $contaDTO->setSaldo($saldo);
        $conta = $this->contaRepository->update($contaDTO);
        
        return $contaDTO;
    }
}
