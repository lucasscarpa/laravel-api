<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DTO\Conta\ContaDTO;
use App\Services\Conta\ContaService;
use App\Http\Requests\ConsultaContaRequest;

use App\Models\Conta;

class ContaController extends Controller
{
    private $contaService;

    public function __construct(ContaService $contaService)
    {
        $this->contaService = $contaService;
    }

    /**
     * Busca Conta por ID
     *
     * @param  Request  $request
     * @return ContaDTO
     */
    public function index(ConsultaContaRequest $request)
    {
        $conta = $this->contaService->getContaById($request->input('id', 0));

        if (!$conta) return response()->json(['message' => 'Conta não encontrada'], 404);

        $contaDTO = new ContaDTO(
            $conta->saldo,
            $conta->id
        );

        return response()->json(['conta' => $contaDTO]);
    }

    /**
     * Cria uma nova conta
     *
     * @param  Request  $request
     * @return ContaDTO
     */
    public function create(Request $request)
    {
        $contaDTO = new ContaDTO(
            $request->input('saldo')
        );

        $conta = $this->contaService->createConta($contaDTO);
        $contaDTO->setId($conta->id);

        return response()->json(['message' => 'Conta criada com sucesso', 'conta' => $contaDTO]);
    }
}
