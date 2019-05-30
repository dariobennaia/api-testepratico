<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    public function save(array $data)
    {
        return $this->getModel()->create($data);
    }

    public function getModel()
    {
        return $this->model;
    }

    public function findAll()
    {
        return $this->getModel()->all();
    }

    public function update($id, array $data)
    {
        $updatedModel = $this->getModel()->find($id)->fill($data);
        $updatedModel->save();
        return $updatedModel;
    }

    public function delete($id)
    {
        $deletedModel = $this->findById($id);
        $deletedModel->delete();
        return $deletedModel;
    }

    public function findById($id)
    {
        return $this->getModel()->find($id);
    }

    public function getByQuery($parameter, $operator, $value)
    {
        return $this->getModel()->where($parameter, $operator, $value);
    }

    public function getFillableModel()
    {
        return $this->getModel()->getFillable();
    }
}
