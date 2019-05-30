<?php

namespace App\Http\Controllers\Refrigerantes;

use App\Http\Controllers\Controller;
use App\Services\Refrigerantes\RefrigerantesService;
use Illuminate\Http\Request;
use App\Http\Requests\Refrigerantes\RefrigerantesCreateRequest;
use App\Http\Requests\Refrigerantes\RefrigerantesUpdateRequest;
use App\Http\Requests\Refrigerantes\RefrigerantesStatusRequest;

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
        return $this->returnResponseData($this->refrigerantesService->getAllRefrigerantessPaginate($request->search, $totalPage));
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
     * @param RefrigerantesStatusRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function enableRefrigerantes(RefrigerantesStatusRequest $request)
    {
        return $this->returnResponseData($this->refrigerantesService->enableRefrigerantes($request->id));
    }

    /**
     * @param RefrigerantesStatusRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function disableRefrigerantes(RefrigerantesStatusRequest $request)
    {
        return $this->returnResponseData($this->refrigerantesService->disableRefrigerantes($request->id));
    }
}
