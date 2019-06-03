<?php

namespace App\Services\Refrigerantes;

use App\Repositories\Refrigerantes\LitragensRefrigerantesRepository;
use App\Repositories\Refrigerantes\RefrigerantesRepository;


class LitragensRefrigerantesService
{
    /**
     * @var RefrigerantesRepository
     */
    private $litragensRefrigerantesRepository;

    /**
     * LitragensRefrigerantesService constructor.
     * @param LitragensRefrigerantesRepository $litragensRefrigerantesRepository
     */
    public function __construct(LitragensRefrigerantesRepository $litragensRefrigerantesRepository)
    {
        $this->litragensRefrigerantesRepository = $litragensRefrigerantesRepository;
    }

    /**
     * @return mixed
     */
    public function obterTodasAsLitragensRefrigerantes()
    {
        return $this->litragensRefrigerantesRepository->obterTodasAsLitragensRefrigerantes();
    }
}
