<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Services\TransacaoService;

class TransacaoController extends Controller
{
    private $transacaoService;

    public function __construct(TransacaoService $transacaoService)
    {
        $this->transacaoService = $transacaoService;
    }

    public function transacao(Request $request)
    {
        $response = $this->transacaoService->executa($request->input('conta_id'), $request->input('valor'), $request->input('forma_pagamento'));
        return response($response);
    }
}
