<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Services\Transacao\TransacaoService;
use App\DTO\Transacao\InputModel;

class TransacaoController extends Controller
{
    private $transacaoService;

    public function __construct(TransacaoService $transacaoService)
    {
        $this->transacaoService = $transacaoService;
    }

    public function transacao(Request $request)
    {
        $transacaoInputModel = new InputModel(
            $request->input('valor'),
            $request->input('conta_id'),
            $request->input('forma_pagamento')
        );

        $response = $this->transacaoService->executa($transacaoInputModel);

        return response($response);
    }
}
