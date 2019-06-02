<?php

namespace App\Http\Controllers\Refrigerantes;

use App\Http\Controllers\Controller;
use App\Services\Refrigerantes\LitragensRefrigerantesService;

class LitragensRefrigerantesController extends Controller
{
    /**
     * @var LitragensRefrigerantesService
     */
    private $litragensRefrigerantesService;

    /**
     * LitragensRefrigerantesController constructor.
     * @param LitragensRefrigerantesService $litragensRefrigerantesService
     */
    public function __construct(LitragensRefrigerantesService $litragensRefrigerantesService)
    {
        $this->litragensRefrigerantesService = $litragensRefrigerantesService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function obterTodasAsLitragensRefrigerantes()
    {
        return $this->returnResponseData($this->litragensRefrigerantesService->obterTodasAsLitragensRefrigerantes());
    }
}
