<?php

namespace App\Http\Controllers\Refrigerantes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Refrigerantes\MultiplesRefrigerantesDeleteRequest;
use App\Http\Requests\Refrigerantes\RefrigerantesDeleteRequest;
use App\Services\Refrigerantes\RefrigerantesService;
use Illuminate\Http\Request;
use App\Http\Requests\Refrigerantes\RefrigerantesCreateRequest;
use App\Http\Requests\Refrigerantes\RefrigerantesUpdateRequest;

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
    public function getAllRefrigerantess()
    {
        return $this->returnResponseData($this->refrigerantesService->getAllRefrigerantess());
    }

    /**
     * @param Request $request
     * @param int $totalPage
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllRefrigerantessPaginate(Request $request, int $totalPage = 10)
    {
        return $this->returnResponseData(
            $this->refrigerantesService->getAllRefrigerantessPaginate($request->toArray(), $totalPage)
        );
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRefrigerantesById(int $id)
    {
        return $this->returnResponseData($this->refrigerantesService->getRefrigerantesById($id));
    }

    /**
     * @param RefrigerantesCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createRefrigerantes(RefrigerantesCreateRequest $request)
    {
        return $this->returnResponseData($this->refrigerantesService->createRefrigerantes($request->toArray()));
    }

    /**
     * @param RefrigerantesUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateRefrigerantes(RefrigerantesUpdateRequest $request, $id)
    {
        return $this->returnResponseData($this->refrigerantesService->updateRefrigerantes($id, $request->toArray()));
    }

    /**
     * @param RefrigerantesDeleteRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteRefrigerante(RefrigerantesDeleteRequest $request)
    {
        return $this->returnResponseData($this->refrigerantesService->deleteRefrigerante($request->id_refrigerante));
    }

    /**
     * @param MultiplesRefrigerantesDeleteRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteRefrigerantes(MultiplesRefrigerantesDeleteRequest $request)
    {
        return $this->returnResponseData($this->refrigerantesService->deleteRefrigerante($request->id_refrigerante));
    }
}
