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
     * @param array $busca
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function buscarRefrigerantes(array $busca = [])
    {
        $fill = $this->getFillableModel();
        unset($fill['id_refrigerante']);

        $model = $this->getModel();

        foreach ($busca as $i => $value) {
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
    public function obterRefrigerantePorId(int $id)
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
    public function cadastrarRefrigerante(array $data)
    {
        return $this->getModel()->create($data);
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function atualizarRefrigerantePorId($id, array $data)
    {
        return $this->getModel()->where('id_refrigerante', $id)->update($data);
    }

    /**
     * @param array $ids
     * @return mixed
     */
    public function excluirPorIds(array $ids)
    {
        return $this->getModel()->whereIn('id_refrigerante', $ids)->delete();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function excluirPorId(int $id)
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
