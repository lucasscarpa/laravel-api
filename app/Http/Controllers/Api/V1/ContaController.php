<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DTO\Conta\ContaDTO;
use App\Services\Conta\ContaService;
use App\Http\Resources\ContaResource;
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
        $conta = $this->contaService->getContaById($request->input('id', 0));

        if (!$conta) return response()->json(['Conta não encontrada'], 404);

        return new ContaResource($conta);
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

        $conta = $this->contaService->createConta($ContaDTO);

        return new ContaResource($conta);
    }
}
