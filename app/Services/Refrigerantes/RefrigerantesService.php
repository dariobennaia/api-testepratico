<?php

namespace App\Services\Refrigerantes;

use App\Repositories\Refrigerantes\RefrigerantesRepository;

class RefrigerantesService
{
    /**
     * @var $refrigerantesRepository
     */
    private $refrigerantesRepository;

    /**
     * RefrigerantesRepository constructor.
     * @param RefrigerantesRepository $refrigerantesRepository
     */
    public function __construct(RefrigerantesRepository $refrigerantesRepository)
    {
        $this->refrigerantesRepository = $refrigerantesRepository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function getAllRefrigerantess()
    {
        return $this->refrigerantesRepository->getModel()->all();
    }

    /**
     * @param array $search
     * @param int $totalPages
     * @return mixed
     */
    public function getAllRefrigerantessPaginate(array $search = [], int $totalPages = 10)
    {
        return $this->refrigerantesRepository->searchRefrigerantes($search)->paginate($totalPages);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getRefrigerantesById(int $id)
    {
        return $this->refrigerantesRepository->getRefrigerantesById($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function createRefrigerantes(array $data)
    {
        return $this->refrigerantesRepository->createRefrigerantes($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function updateRefrigerantes($id, array $data)
    {
        $this->refrigerantesRepository->updateRefrigerantesById($id, $data);
        return $this->refrigerantesRepository->getRefrigerantesById($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteRefrigerante($id)
    {
        if (is_array($id)) {
            $this->refrigerantesRepository->deleteByIds($id);
            return $this->refrigerantesRepository->getRefrigerantesTrashedByIds($id);
        }

        $this->refrigerantesRepository->delete($id);
        return $this->refrigerantesRepository->getRefrigerantesTrashedById($id);
    }
}
