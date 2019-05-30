<?php

namespace App\Repositories\Refrigerantes;

use App\Repositories\Repository;
use App\Refrigerantes;

class RefrigerantesRepository extends Repository
{
    /**
     * RefrigerantesRepository constructor.
     * @param Refrigerantes $model
     */
    public function __construct(Refrigerantes $model)
    {
        parent::__construct($model);
    }

    /**
     * @param string $search
     * @return mixed
     */
    public function searchRefrigerantess(string $search)
    {
        $fill = $this->getFillableModel();

        $model = $this->getModel()->where('id', '=', "%{$search}%");
        unset($fill['id']);

        foreach ($fill as $value) {
            $model->orWhere($value, 'like', "%{$search}%");
        }

        return $model;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getRefrigerantesById(int $id)
    {
        return $this->getModel()->find($id);
    }

     /**
     * @param array $data
     * @return mixed
     */
    public function createRefrigerantes(array $data)
    {
        return $this->getModel()->create($data);
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function updateRefrigerantesById($id, array $data)
    {
        return $this->getModel()->where('id', $id)->update($data);
    }
}
