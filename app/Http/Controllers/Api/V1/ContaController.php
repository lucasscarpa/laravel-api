<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DTO\ContaDTO;
use App\Services\Conta\ContaService;
use App\Http\Requests\NovaContaRequest;

class ContaController extends Controller
{
    private $contaService;

    public function __construct(ContaService $contaService)
    {
        $this->contaService = $contaService;
    }

    public function index(Request $request)
    {
        return response()->json(['conta_id' => 12345, 'saldo' => 0.50]);
    }

    /**
     * Cria uma nova conta
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(Request $request)
    {
        $ContaDTO = new ContaDTO(
            $request->input('saldo')
        );

        $conta = $this->contaService->criaConta($ContaDTO);

        return response()->json(['conta' => $conta]);
    }
}
