<?php

namespace App\Repositories\Refrigerantes;

use App\Repositories\Repository;
use App\TiposRefrigerantes;

class TiposRefrigerantesRepository extends Repository
{
    /**
     * TiposRefrigerantesRepository constructor.
     * @param TiposRefrigerantes $model
     */
    public function __construct(TiposRefrigerantes $model)
    {
        parent::__construct($model);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function obterTodosOsTiposDeRefrigerantes()
    {
        return $this->getModel()->all();
    }
}
