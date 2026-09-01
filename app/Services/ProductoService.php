<?php

namespace App\Services;

use App\Interfaces\ProductosInterface;

class ProductosService
{
    public function __construct(private ProductosInterface $productosRepository)
    {
    }

    public function list()
    {
        return $this->productosRepository->getAll();
    }

    public function store(array $data)
    {
        return $this->productosRepository->create($data);
    }

    public function show(int $id)
    {
        return $this->productosRepository->getById($id);
    }

    public function update(array $data, int $id)
    {
        return $this->productosRepository->update($data, $id);
    }

    public function destroy(int $id)
    
    {
        return $this->productosRepository->delete($id);
    }
       
}