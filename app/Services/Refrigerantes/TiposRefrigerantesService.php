<?php

namespace App\Services\Refrigerantes;

use App\Repositories\Refrigerantes\RefrigerantesRepository;
use App\Repositories\Refrigerantes\TiposRefrigerantesRepository;

class TiposRefrigerantesService
{
    /**
     * @var RefrigerantesRepository
     */
    private $tiposRefrigerantesRepository;

    /**
     * TiposRefrigerantesService constructor.
     * @param TiposRefrigerantesRepository $tiposRefrigerantesRepository
     */
    public function __construct(TiposRefrigerantesRepository $tiposRefrigerantesRepository)
    {
        $this->tiposRefrigerantesRepository = $tiposRefrigerantesRepository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function obterTodosOsTiposDeRefrigerantes()
    {
        return $this->tiposRefrigerantesRepository->obterTodosOsTiposDeRefrigerantes();
    }
}
