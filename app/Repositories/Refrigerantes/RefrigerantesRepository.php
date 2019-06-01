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
     * @param array $search
     * @return mixed
     */
    public function searchRefrigerantes(array $search = [])
    {
        $fill = $this->getFillableModel();
        unset($fill['id_refrigerante']);

        $model = $this->getModel();

        foreach ($search as $i => $value) {
            if (!in_array($i, $fill)) {
                continue;
            }
            $model = $model->where($i, $value);
        }

        return $model->with(['tipoRefrigerante', 'litragemRefrigerante']);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getRefrigerantesById(int $id)
    {
        return $this->getModel()->with(['tipoRefrigerante', 'litragemRefrigerante'])->find($id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getRefrigerantesTrashedById(int $id)
    {
        return $this->getModel()->onlyTrashed()->with(['tipoRefrigerante', 'litragemRefrigerante'])->find($id);
    }

    /**
     * @param array $ids
     * @return mixed
     */
    public function getRefrigerantesTrashedByIds(array $ids)
    {
        return $this->getModel()->onlyTrashed()->whereIn('id_refrigerante', $ids)
            ->with(['tipoRefrigerante', 'litragemRefrigerante'])->get();
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
        return $this->getModel()->where('id_refrigerante', $id)->update($data);
    }

    /**
     * @param array $ids
     * @return mixed
     */
    public function deleteByIds(array $ids)
    {
        return $this->getModel()->whereIn('id_refrigerante', $ids)->delete();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function deleteById(int $id)
    {
        return $this->getModel()->where('id_refrigerante', $id)->delete();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function obterTodosOsRefrigerantes()
    {
        return $this->getModel()->all();
    }
}
