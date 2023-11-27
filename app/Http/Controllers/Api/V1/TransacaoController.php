<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Transacao\TransacaoService;
use App\DTO\Transacao\TransacaoDTO;
use App\DTO\Conta\ContaDTO;

class TransacaoController extends Controller
{
    private $transacaoService;

    public function __construct(TransacaoService $transacaoService)
    {
        $this->transacaoService = $transacaoService;
    }

    public function transacao(Request $request)
    {
        $TransacaoDTO = new TransacaoDTO(
            $request->input('valor', 0),
            $request->input('conta_id', 0),
            $request->input('forma_pagamento', 'I')
        );

        $conta = $this->transacaoService->processaTransacao($TransacaoDTO);

        $contaDTO = new ContaDTO($conta->saldo, $conta->id);
        return response()->json(['mensagem' => 'Transação realizada com sucesso', 'conta' => $contaDTO]);
    }
}
