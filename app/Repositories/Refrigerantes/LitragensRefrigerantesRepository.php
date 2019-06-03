<?php

namespace App\Repositories\Refrigerantes;

use App\LitragensRefrigerantes;
use App\Repositories\Repository;

class LitragensRefrigerantesRepository extends Repository
{
    /**
     * LitragensRefrigerantesRepository constructor.
     * @param LitragensRefrigerantes $model
     */
    public function __construct(LitragensRefrigerantes $model)
    {
        parent::__construct($model);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function obterTodasAsLitragensRefrigerantes()
    {
        return $this->getModel()->all();
    }
}
