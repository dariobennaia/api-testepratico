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
    public function obterTodosOsRefrigerantes()
    {
        return $this->refrigerantesRepository->obterTodosOsRefrigerantes();
    }

    /**
     * @param array $busca
     * @param int $totalPages
     * @return mixed
     */
    public function obterTodosOsRefrigerantesEmPaginacao(array $busca = [], int $totalPaginas = 10)
    {
        return $this->refrigerantesRepository->buscarRefrigerantes($busca)->paginate($totalPaginas);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function obterRefrigerantePorId(int $id)
    {
        return $this->refrigerantesRepository->obterRefrigerantePorId($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function cadastrarRefrigerante(array $data)
    {
        return $this->refrigerantesRepository->cadastrarRefrigerante($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function atualizarRefrigerante($id, array $data)
    {
        $this->refrigerantesRepository->atualizarRefrigerantePorId($id, $data);
        return $this->refrigerantesRepository->obterRefrigerantePorId($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function excluirRefrigerante($id)
    {
        if (is_array($id)) {
            $this->refrigerantesRepository->excluirPorIds($id);
            return $this->refrigerantesRepository->getRefrigerantesTrashedByIds($id);
        }

        $this->refrigerantesRepository->excluirPorId($id);
        return $this->refrigerantesRepository->getRefrigerantesTrashedById($id);
    }
}
