<?php

namespace App\Services;

use App\Interfaces\ProduccionInterface;

class ProduccionService
{
    public function __construct(private ProduccionInterface $produccionRepository)
    {
    }

    public function list()
    {
        return $this->produccionRepository->getAll();
    }

    public function store(array $data)
    {
        return $this->produccionRepository->create($data);
    }

    public function show(int $id)
    {
        return $this->produccionRepository->getById($id);
    }

    public function update(array $data, int $id)
    {
        return $this->produccionRepository->update($data, $id);
    }

    public function destroy(int $id)
    {
        return $this->produccionRepository->delete($id);
    }

}