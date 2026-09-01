<?php

namespace App\Services;

use App\Interfaces\CategoriasInterface;

class CategoriasService
{
    public function __construct(private CategoriasInterface $categoriasRepository)
    {} 

    public function list()
    {
        return $this->categoriasRepository->getAll();
    }

    public function store(array $data)
    {
        return $this->categoriasRepository->create($data);
    }

    public function show(int $id)
    {
        return $this->categoriasRepository->getById($id);
    }

    public function update(array $data, int $id)
    {
        return $this->categoriasRepository->update($data, $id);
    }

    public function destroy(int $id)
    {
        return $this->categoriasRepository->delete($id);
    }
       
}