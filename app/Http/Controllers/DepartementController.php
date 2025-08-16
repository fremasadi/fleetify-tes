<?php

namespace App\Http\Controllers;

use App\DTOs\DepartementDTO;
use App\Http\Requests\Departement\StoreDepartementRequest;
use App\Http\Requests\Departement\UpdateDepartementRequest;
use App\Models\Departement;
use App\Services\DepartementService;

class DepartementController extends Controller
{
    protected DepartementService $service;

    public function __construct(DepartementService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $departements = $this->service->getAllDepartements();
        return view('departements.index', compact('departements'));
    }

    public function create()
    {
        return view('departements.create');
    }

    public function store(StoreDepartementRequest $request)
    {
        $this->service->createDepartement(new DepartementDTO($request->validated()));
        return redirect()->route('departements.index')->with('Berhasil', 'Departement Berhasil Dibuat.');
    }

    public function edit(Departement $departement)
    {
        return view('departements.edit', compact('departement'));
    }

    public function update(UpdateDepartementRequest $request, Departement $departement)
    {
        $this->service->updateDepartement($departement, new DepartementDTO($request->validated()));
        return redirect()->route('departements.index')->with('Berhasil', 'Departement Berhasil Diupdate.');
    }

    public function destroy(Departement $departement)
    {
        $this->service->deleteDepartement($departement);
        return redirect()->route('departements.index')->with('Berhasil', 'Departement Berhasil Dihapus.');
    }
}
