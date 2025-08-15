<?php

namespace App\Repositories;

use App\Models\Departement;

class DepartementRepository
{
    public function getAll()
    {
        return Departement::all();
    }

    public function findById($id)
    {
        return Departement::findOrFail($id);
    }

    public function create(array $data)
    {
        return Departement::create($data);
    }

    public function update(Departement $departement, array $data)
    {
        return $departement->update($data);
    }

    public function delete(Departement $departement)
    {
        return $departement->delete();
    }
}
