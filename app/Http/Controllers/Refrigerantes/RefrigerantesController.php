<?php

namespace App\Http\Controllers\Refrigerantes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Refrigerantes\RefrigerantesMultiplasDelecoesRequest;
use App\Http\Requests\Refrigerantes\RefrigerantesDelecoesRequest;
use App\Services\Refrigerantes\RefrigerantesService;
use Illuminate\Http\Request;
use App\Http\Requests\Refrigerantes\RefrigerantesInsercoesRequest;
use App\Http\Requests\Refrigerantes\RefrigerantesAtualizacoesRequest;

class RefrigerantesController extends Controller
{
    /**
     * @var $refrigerantesService
     */
    private $refrigerantesService;

    /**
     * RefrigerantesController constructor.
     * @param RefrigerantesService $refrigerantesService
     */
    public function __construct(RefrigerantesService $refrigerantesService)
    {
        $this->refrigerantesService = $refrigerantesService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function obterTodosOsRefrigerantes()
    {
        return $this->returnResponseData($this->refrigerantesService->obterTodosOsRefrigerantes());
    }

    /**
     * @param Request $request
     * @param int $totalPaginas
     * @return \Illuminate\Http\JsonResponse
     */
    public function obterTodosOsRefrigerantesEmPaginacao(Request $request, int $totalPaginas = 10)
    {
        return $this->returnResponseData(
            $this->refrigerantesService->obterTodosOsRefrigerantesEmPaginacao($request->toArray(), $totalPaginas)
        );
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function obterRefrigerantePorId(int $id)
    {
        return $this->returnResponseData($this->refrigerantesService->obterRefrigerantePorId($id));
    }

    /**
     * @param RefrigerantesInsercoesRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cadastrarRefrigerante(RefrigerantesInsercoesRequest $request)
    {
        return $this->returnResponseData($this->refrigerantesService->cadastrarRefrigerante($request->toArray()));
    }

    /**
     * @param RefrigerantesAtualizacoesRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function atualizarRefrigerante(RefrigerantesAtualizacoesRequest $request, $id)
    {
        return $this->returnResponseData($this->refrigerantesService->atualizarRefrigerante($id, $request->toArray()));
    }

    /**
     * @param RefrigerantesDelecoesRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function excluirRefrigerante(RefrigerantesDelecoesRequest $request)
    {
        return $this->returnResponseData($this->refrigerantesService->excluirRefrigerante($request->id_refrigerante));
    }

    /**
     * @param RefrigerantesMultiplasDelecoesRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function excluirRefrigerantes(RefrigerantesMultiplasDelecoesRequest $request)
    {
        return $this->returnResponseData($this->refrigerantesService->excluirRefrigerante($request->id_refrigerante));
    }
}
