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
     * @param string $search
     * @param int $totalPages
     * @return mixed
     */
    public function getAllRefrigerantessPaginate(string $search, int $totalPages = 10)
    {
        return $this->refrigerantesRepository->searchRefrigerantess($search)->paginate($totalPages);
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
     * @param int $id
     * @return mixed
     */
    public function enableRefrigerantes(int $id)
    {
        $this->refrigerantesRepository->updateRefrigerantesById($id, ['flg_active' => true]);
        return $this->refrigerantesRepository->getRefrigerantesById($id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function disableRefrigerantes(int $id)
    {
        $this->refrigerantesRepository->updateRefrigerantesById($id, ['flg_active' => false]);
        return $this->refrigerantesRepository->getRefrigerantesById($id);
    }
}
