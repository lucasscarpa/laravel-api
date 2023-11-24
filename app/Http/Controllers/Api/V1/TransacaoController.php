<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Transacao\TransacaoService;
use App\DTO\Transacao\TransacaoDTO;

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
            $request->input('valor'),
            $request->input('conta_id'),
            $request->input('forma_pagamento')
        );

        $response = $this->transacaoService->executa($TransacaoDTO);

        return response($response);
    }
}
