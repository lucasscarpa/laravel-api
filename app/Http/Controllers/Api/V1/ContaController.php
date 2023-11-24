<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BuscaContaFormRequest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\DTO\ContaDTO;

class ContaController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        if (!$request->input('id')) throw new NotFoundHttpException('Conta inexistente');

        return response()->json(['conta_id' => 12345, 'saldo' => 0.50]);
    }

    public function create(Request $request)
    {
        $dto = new ContaDTO($request->input('valor', -1));
        dd($dto);
    }
}
