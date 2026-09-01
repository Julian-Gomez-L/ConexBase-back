<?php

namespace App\Services;

use App\Interfaces\RolInterface;

class RolService
{

    public function __construct(private RolInterface $rolRepository)
    {
    }

    public function list()
    {
        return $this->rolRepository->getAll();
    }

    public function store(array $data)
    {
        return $this->rolRepository->create($data);
    }

    public function show(int $id)
    {
        return $this->rolRepository->getById($id);
    }

    public function update(array $data, int $id)
    {
        return $this->rolRepository->update($data, $id);
    }

    public function destroy(int $id)
    {
        // Asumiendo que tu BaseRepository usa 'delete' para eliminar
        return $this->rolRepository->delete($id);
    }
}