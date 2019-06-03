<?php

namespace App\Http\Controllers\Refrigerantes;

use App\Http\Controllers\Controller;
use App\Services\Refrigerantes\TiposRefrigerantesService;

class TiposRefrigerantesController extends Controller
{
    /**
     * @var TiposRefrigerantesService
     */
    private $tiposRefrigerantesService;

    /**
     * TiposRefrigerantesController constructor.
     * @param TiposRefrigerantesService $tiposRefrigerantesService
     */
    public function __construct(TiposRefrigerantesService $tiposRefrigerantesService)
    {
        $this->tiposRefrigerantesService = $tiposRefrigerantesService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function obterTodosOsRefrigerantes()
    {
        return $this->returnResponseData($this->tiposRefrigerantesService->obterTodosOsTiposDeRefrigerantes());
    }
}
