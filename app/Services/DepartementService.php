<?php

namespace App\Services;

use App\Repositories\DepartementRepository;
use App\DTOs\DepartementDTO;
use App\Models\Departement;

class DepartementService
{
    protected DepartementRepository $repository;

    public function __construct(DepartementRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllDepartements()
    {
        return $this->repository->getAll();
    }

    public function createDepartement(DepartementDTO $dto)
    {
        return $this->repository->create($dto->toArray());
    }

    public function updateDepartement(Departement $departement, DepartementDTO $dto)
    {
        return $this->repository->update($departement, $dto->toArray());
    }

    public function deleteDepartement(Departement $departement)
    {
        return $this->repository->delete($departement);
    }
}
